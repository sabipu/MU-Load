<?php
class Allocation extends CI_Controller {
  public function __construct() {
    parent::__construct();

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }

    $this->load->helper('loadcalc');
    $this->load->model('users_model');
    $this->load->model('units_model');
    $this->load->model('settings_model');
    $this->load->model('unitactivitiesmeta_model');
    $this->load->model('allocation_model');
    $this->load->model('allocationactlect_model');
    $this->load->model('allocationofferings_model');

  }

  function index() {
    $this->load->model('users_model');
    $this->load->model('units_model');
    $this->load->view('templates/header');

    $data['users'] = $this->db->get_where('users', array('status' => 'active'))->result();
    $data['units'] = $this->db->get_where('units')->result();

    $data['budgets'] = array(
      'lastYear' => $this->ngBudgetCalc((date("Y")-1)),
      'currentYear' => $this->ngBudgetCalc((date("Y"))),
      'nextYear' => $this->ngBudgetCalc((date("Y")+1))
    );
    $this->load->view('allocation/allocation', $data);
    $this->load->view('templates/footer');
  }

  function add() {
    $this->load->model('users_model');
    $this->load->model('units_model');

    $user_id = $this->input->get_post('user');
    $unit_id = $this->input->get_post('unit');

    $check = $this->units_model->checkIfUnitIsAssigned($unit_id);

    if(!$check) {
      $updatedData = array(
        'assigned_to' => $user_id,
        'assigned_on' => date('Y-m-d H:i:s'),
        'assigned_date_modified' => date('Y-m-d H:i:s'),
        'status' => 'assigned',
      );

      $this->db->where('unit_id', $unit_id);
      $this->db->update('units', $updatedData);

      echo 'Allocation added';

    } else {
      echo 'Allocation exists';
    }
  }

  function allocate($year = null) {
    $year = $year == null ? date("Y") : $year;
    $data['year'] = $year;
    
    $query1 = $this->db->query("SELECT * FROM `allocation` LEFT JOIN units ON allocation.unitID = units.unit_id WHERE year = " . $year);
    $data['allAllocations']= $query1->result();
    
    $data['allAllocationsOfferings']= $this->db->get('allocationofferings')->result();

    $query2 = $this->db->query("SELECT * FROM `allocationactlect` INNER JOIN activities ON allocationactlect.activitiesID = activities.activitiesID INNER JOIN users ON allocationactlect.userID = users.user_id ");
    $data['allActUsers']= $query2->result();
    $this->db->where('gsetting_code', "Offerings");
    $offerings_string = $this->db->get_where('settings')->row();
    $data["offeringsAll"] = explode(",", $offerings_string->value);

    $this->load->view('templates/header');
    $this->load->view('allocation/allocate',$data);
    $this->load->view('templates/footer');
  }

  function allocateNew($year = null)
  {
    $year = $year == null ? date("Y") : $year;
    $data['year'] = $year;
    $data["units"]= $this->db->get_where('units')->result();

    $this->db->where('gsetting_code', "Offerings");
    $data["offerings_string"] = $this->db->get_where('settings')->row();
    $data["offerings"] = explode(",", $data["offerings_string"]->value);
    
    $this->load->view('templates/header');
    $this->load->view('allocation/allocateAdd', $data);
    $this->load->view('templates/footer');
  }

  function allocateEdit($year = null, $eid = null)
  {
    if ($year == null || $eid == null ) {
      redirect('allocation');
    }
    $data['year'] = $year;
    $query1 = $this->db->query("SELECT * FROM `allocation` LEFT JOIN units ON allocation.unitID = units.unit_id WHERE year = " . $year . " AND allocation.allocationID = " . $eid);
    $data['thisAllocations']= $query1->row();
    
    
    $this->db->where('allocationID', $eid);
    $data['thisAllocationsOfferings']= $this->db->get('allocationofferings')->result();

    
    $query2 = $this->db->query("SELECT * FROM `allocationactlect` INNER JOIN activities ON allocationactlect.activitiesID = activities.activitiesID INNER JOIN users ON allocationactlect.userID = users.user_id WHERE allocationactlect.allocationID = ".$eid);
    $data['thisActUsers']= $query2->result();

    $data['allUsers'] = $this->getUserByPref($data['thisAllocations']->unitID);

    $this->db->where('gsetting_code', "Offerings");
    $offerings_string = $this->db->get_where('settings')->row();
    $data["offeringsAll"] = explode(",", $offerings_string->value);

    $this->load->view('templates/header');
    $this->load->view('allocation/allocateEdit', $data);
    $this->load->view('templates/footer');
  }

  function allocateFindActivities()
  {
    $uID = $_POST['uID'];
    $filter = "PREF";
    if (isset($_POST['filter'])) {
      $filter = $_POST['filter'];
    }

    $query = $this->db->query("SELECT * FROM `unitactivitiesmeta` 
                                LEFT JOIN `activities` ON unitactivitiesmeta.activitiesID = activities.activitiesID 
                                LEFT JOIN metrics ON metrics.met_id = activities.metricsID 
                                WHERE unitactivitiesmeta.unitID =" . $uID);
    $allocationUnitActivities = $query->result();
    if ($filter == "PREF") {
      $preferedUsers = $this->getUserByPref($uID);
    }else{
     $preferedUsers = $this->getUsersByHours($uID); 
    }
    
    $response = "<tr>";
    $counter = array();
    foreach ($allocationUnitActivities as $activity) {
      $response .= "<th>".$activity->title." <input type='hidden' name='activities[]' value='".$activity->activitiesID."'><input type='hidden' name='workload[]' value='".$activity->formula_or_value_output."'></th>";
      array_push($counter, $activity->activitiesID);
    }

    $response.="</tr><tr>";

    for ($i=0; $i < count($allocationUnitActivities) ; $i++) { 
      $response .= "<td>";
        foreach ($preferedUsers as $key => $user) {
          $response .= "<label class='custom-check'><input type='checkbox' data-hour='".$user->remaining_hour."' data-pref='".$key."' data-actID='".$i."' name='users".$counter[$i]."[]' value='".$user->user_id."'><span class='custom-input'></span><span class='custom-label'>".$user->name."<em class='hours'>".$user->remaining_hour."</em></span></label>";
        }
      $response .= "</td>";
    }
    $response .= "</tr>";

    $result = array(
      'filter' => $filter,
      'response' => $response
    );
    echo json_encode($result);
  }


  function getUserByPref($uID)
  {
    $this->db->where('user_id!=', 1);
    $this->db->where('role!=', 'admin');
    $query = $this->db->query("SELECT * FROM `coursepref` LEFT JOIN `users` ON coursepref.userID = users.user_id WHERE `unitID` = ".$uID. " ORDER BY name");
    $result = $query->result();
    $allUID = array();
    foreach ($result as $row) {
      array_push($allUID, $row->userID);
    }


    $result2 = array();
    $this->db->where('user_id!=', 1);
    $this->db->where('role!=', 'admin');
    if (count($allUID) > 0) {
      $this->db->where_not_in('user_id', $allUID);
    }
    $this->db->order_by('name', 'ASC');
    $queryRest = $this->db->get('users');
    $result2 = $queryRest->result();
    
    $fullresult = array_merge($result, $result2); 
    
    return $fullresult;
  }

  function getUsersByHours($uID)
  {
    $this->db->where('user_id!=', 1);
    $this->db->where('role!=', 'admin');
    $this->db->order_by('user_id', 'ASC');
    $query = $this->db->query("SELECT * FROM `coursepref` LEFT JOIN `users` ON coursepref.userID = users.user_id WHERE `unitID` = ".$uID . " ORDER BY remaining_hour");
    $result = $query->result();
    $allUID = array();
    foreach ($result as $row) {
      array_push($allUID, $row->userID);
    }


    $result2 = array();
    $this->db->where('user_id!=', 1);
    $this->db->where('role!=', 'admin');
    if (count($allUID) > 0) {
      $this->db->where_not_in('user_id', $allUID);
    }
    $this->db->order_by('remaining_hour', 'ASC');
    $queryRest = $this->db->get('users');
    $result2 = $queryRest->result();  
    
    
    $fullresult = array_merge($result, $result2); 
    
    return $fullresult;
  }


  function allocateCreate($eid = null)
  {
    $offerings = $_POST['offerings'];
    $activities = $_POST['activities'];
    $workload = $_POST['workload'];
    $year=$_POST['year'];

    $lecturers = array();
    foreach ($activities as $key => $activity) {
      $lecturers[$activity] = isset($_POST['users'.$activity]) ? $_POST['users'.$activity] : array();
    }

    $data = array(
      'unitID' => $_POST['unitID'],
      'year' => $_POST['year'],
      'created' => date('Y-m-d H:i:s')
    );
    $this->db->insert('allocation', $data);
    $eid = $this->db->insert_id();

    if (count($offerings)) {
      $data = array();
      foreach ($offerings as $offering) {
        $unitOfferings = array(
                  'allocationID' => $eid,
                  'offerings'  => $offering,
                  'created' => date('Y-m-d H:i:s')
        );
        array_push($data, $unitOfferings);
      }
      $this->db->insert_batch('allocationofferings', $data);  
    }

    if (count($activities)) {
      $data = array();
      foreach ($activities as $key => $act) {
        $actID = intval($act);
        if (isset($lecturers[$actID]) && count($lecturers[$actID])) {
          foreach ($lecturers[$actID] as $lect) {
            $actLect = array(
                  'allocationID' => intval($eid),
                  'activitiesID'  => intval($actID),
                  'userID'  => intval($lect),
                  'workLoad'  => intval($workload[$key]),
                  'created' => date('Y-m-d H:i:s')
            );
            array_push($data, $actLect);
          }  
        }else{
          $actLect = array(
                  'allocationID' => intval($eid),
                  'activitiesID'  => intval($actID),
                  'userID'  => 1,
                  'workLoad' => intval($workload[$key]),
                  'created' => date('Y-m-d H:i:s')
            );
            array_push($data, $actLect);
        }
      }
      $this->db->insert_batch('allocationactlect', $data);  
    }


    //UPDATE USER TABLE -> remaining hour
    $queryRemainingHours = $this->db->query("SELECT * FROM `allocationactlect` 
    LEFT JOIN users ON allocationactlect.userID = users.user_id 
    WHERE role != 'none' OR role != 'admin' AND allocationactlect.allocationID = " . intval($eid));
    $newAllocationActLect = $queryRemainingHours->result();

    $updateUserHr = array();
    foreach ($newAllocationActLect as $NAAL) {
      $data4rHours = array(
                'user_id'=> $NAAL->userID,
                'remaining_hour' => intval($NAAL->remaining_hour - $NAAL->workLoad)
              );
      array_push($updateUserHr, $data4rHours);
    }
    if (count($updateUserHr)) {
      $this->db->update_batch('users', $updateUserHr, 'user_id');    
    }
    redirect(base_url('allocation/allocate/'.$year));
  }

  
  function allocateupdate($eid = null)
  {
    $offerings = $_POST['offerings'];
    $activities = $_POST['activities'];
    $workload = $_POST['workload'];
    $year=$_POST['year'];

    $lecturers = array();
    foreach ($activities as $key => $activity) {
      $lecturers[$activity] = isset($_POST['users'.$activity]) ? $_POST['users'.$activity] : array();
    }
    
    $data = array(
      'modified' => date('Y-m-d H:i:s')
    );
    $this->db->where('allocationID', $eid);
    $this->db->update('allocation', $data);


    $this->db->where('allocationID', $eid);
    $this->db->delete('allocationofferings');

    if (count($offerings)) {
      $data = array();
      foreach ($offerings as $offering) {
        $unitOfferings = array(
                  'allocationID' => $eid,
                  'offerings'  => $offering,
                  'created' => date('Y-m-d H:i:s')
        );
        array_push($data, $unitOfferings);
      }

      $this->db->insert_batch('allocationofferings', $data);  
    }
    
    //REVERT WORKLOAD REDUCTION || Add the reduced amount
    $queryRemainingHours = $this->db->query("SELECT * FROM `allocationactlect` 
    LEFT JOIN users ON allocationactlect.userID = users.user_id 
    WHERE role != 'none' OR role != 'admin' AND allocationactlect.allocationID = " . intval($eid));
    $newAllocationActLect = $queryRemainingHours->result();

    $updateUserHr = array();
    foreach ($newAllocationActLect as $NAAL) {
      $data4rHours = array(
                'user_id'=> $NAAL->userID,
                'remaining_hour' => intval($NAAL->remaining_hour + $NAAL->workLoad)
              );
      array_push($updateUserHr, $data4rHours);
    }
    if (count($updateUserHr)) {
      $this->db->update_batch('users', $updateUserHr, 'user_id');    
    }

    //Remove the old allocationactlect
    $this->db->where('allocationID', $eid);
    $this->db->delete('allocationactlect');

    if (count($activities)) {
      $data = array();
      foreach ($activities as $key => $act) {
        $actID = intval($act);
        if (isset($lecturers[$actID]) && count($lecturers[$actID])) {
          foreach ($lecturers[$actID] as $lect) {
            $actLect = array(
                  'allocationID' => intval($eid),
                  'activitiesID'  => intval($actID),
                  'userID'  => intval($lect),
                  'workLoad'  => intval($workload[$key]),
                  'created' => date('Y-m-d H:i:s')
            );
            array_push($data, $actLect);
          }  
        }else{
          $actLect = array(
                  'allocationID' => intval($eid),
                  'activitiesID'  => intval($actID),
                  'userID'  => 1,
                  'workLoad' => intval($workload[$key]),
                  'created' => date('Y-m-d H:i:s')
            );
            array_push($data, $actLect);
        }
      }
      $this->db->insert_batch('allocationactlect', $data);  


      //WORKLOAD REDUCTION || reduce the remaining hour amount
      $queryRemainingHours = $this->db->query("SELECT * FROM `allocationactlect` 
      LEFT JOIN users ON allocationactlect.userID = users.user_id 
      WHERE role != 'none' OR role != 'admin' AND allocationactlect.allocationID = " . intval($eid));
      $newAllocationActLect = $queryRemainingHours->result();

      $updateUserHr = array();
      foreach ($newAllocationActLect as $NAAL) {
        $data4rHours = array(
                  'user_id'=> $NAAL->userID,
                  'remaining_hour' => intval($NAAL->remaining_hour - $NAAL->workLoad)
                );
        array_push($updateUserHr, $data4rHours);
      }
      if (count($updateUserHr)) {
        $this->db->update_batch('users', $updateUserHr, 'user_id');    
      }
    }
    redirect(base_url('allocation/allocate/'.$year));
  }

  function allocateDelete($year = null, $eid = null){
    $year = $year == null ? date("Y") : $year;

    $this->db->where('allocationID',$eid);
    $userAndLoad = $this->db->get('allocationactlect')->result();

    $userIDs = array();
    foreach ($userAndLoad as $UAL) {
      array_push($userIDs, $UAL->userID);
    }

    $this->db->where_in('user_id', $userIDs);
    $allUsers = $this->db->get('users')->result();
    
    $data = array();
    foreach ($allUsers as $key => $user) {
      $userData = array(
                  'user_id'  => intval($user->user_id),
                  'remaining_hour'  => intval($user->remaining_hour + $userAndLoad[$key]->workLoad)
            );
      array_push($data, $userData);
    }

    try {
      // Update workload from allocationactlect to users. //add up the allocated hours
      $this->db->update_batch('users', $data, 'user_id');

      // REMOVE match allocationID = eid from allocationactlect
      $this->db->where('allocationID', $eid);
      $this->db->delete('allocationactlect');

      // REMOVE match allocationID = eid from allocationofferings
      $this->db->where('allocationID', $eid);
      $this->db->delete('allocationofferings');

      // REMOVE eid from allocation
      $this->db->where('allocationID', $eid);
      $this->db->delete('allocation');  

      redirect(base_url('allocation/allocate/'.$year));
    } catch (Exception $e) {
      redirect(base_url('error'));
    }
  }


  function ngBudgetCalc($year = null)
  {
    if ($year != null) {
      try {
        $this->db->select('*');
        $this->db->from('allocation');
        $this->db->join('allocationactlect', 'allocation.allocationID = allocationactlect.allocationID');
        $this->db->where('year', $year);
        $this->db->where('allocationactlect.userID', 1);
        $casualCount = @$this->db->count_all_results();
        $casualCount = $casualCount == null ? 1 : $casualCount;

        $this->db->where('gsetting_code', 'casual_hourly');
        $casualBudgetRate = @$this->db->get('settings')->row()->value;
        $casualBudgetRate = $casualBudgetRate == null ? 1: $casualBudgetRate;

        $this->db->where('gsetting_code', 'casual_'.$year);
        $casualBudgetThisYear = @$this->db->get('settings')->row()->value;
        if ($casualBudgetThisYear == null) {
          return array(0,0);
        }else{
          return array($casualBudgetThisYear, (100-ngReturnFloat((($casualCount * $casualBudgetRate)/$casualBudgetThisYear)*100)));   
        }
        
      } catch (Exception $e) {
        return "N/A";
      }
      
    }else{
      return "N/A";  
    }
  }
}