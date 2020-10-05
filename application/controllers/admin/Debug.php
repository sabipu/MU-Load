<?php

class Debug extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
    $this->load->database();
  }

  function index($type = null, $pass = null) {
    echo "This is Admin Debug panel.<br>";
    echo "Call  function <b>DIRECTLY</b> from CONTROLLER.<br>";
    // echo "<b>ALWAYS DELETE</b> after you are done  with function.<br>";


    if ($type === 'RESET' && $pass === 'IRESETDB') {
      $this->resetData();
    }

    echo "<h1>SCRIPT RUN COMPLETE!!</h1>";
  }

  function workloadfill()
  {
    $query = $this->db->query("SELECT * FROM `allocationactlect` INNER JOIN activities ON activities.activitiesID = allocationactlect.activitiesID INNER JOIN metrics ON activities.metricsID = metrics.met_id ");
    $rows= $query->result();
    
    foreach ($rows as $row) {
      $wl = is_numeric($row->formula_or_value_output) ? $row->formula_or_value_output : 0;
      $this->db->set('workLoad', $wl);
      $this->db->where('allocationActLectID', $row->allocationActLectID);
      $this->db->update('allocationactlect');
      echo "Updated: ". $row->allocationActLectID." with " . $wl . "<br>";
    }

    // var_dump($rows);
    // die();
  }

  function resetData(){
    
    $this->db->where('role!=','none');
    $this->db->where('role!=','admin');
    $allUsers = $this->db->get('users')->result();
    $data = array();
    foreach ($allUsers as $key => $user) {
      $userData = array(
                'user_id'  => intval($user->user_id),
                'remaining_hour'  => intval($user->allocated_hour)
          );
          array_push($data, $userData);
    }
    $this->db->update_batch('users', $data, 'user_id');
    echo "<h1>User table RESET complete. ".count($data)." records modified.</h1>";
    $this->db->truncate('allocationactlect');
    echo "<h1>Allocationactlect table RESET complete. </h1>";
    $this->db->truncate('allocationofferings');
    echo "<h1>Allocationofferings table RESET complete. </h1>";
    $this->db->truncate('allocation');
    echo "<h1>Allocation table RESET complete. </h1>";
  }

}