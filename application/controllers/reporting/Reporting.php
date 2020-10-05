<?php

class Reporting extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url_helper');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
    // $this->load->library('fpdf/fpdf');
    $this->load->helper('url_helper');
    $this->load->helper('loadcalc_helper');
    $this->load->model('users_model');
    $this->load->model('units_model');
    $this->load->model('allocation_model');
    $this->load->model('settings_model');
    $this->load->model('activities_model');
    $this->load->model('unitactivitiesmeta_model');
    $this->load->model('allocationactlect_model');
    $this->load->model('allocationofferings_model');
  }

  function index($year = null) 
  {
    $year = $year == null? date('Y') : $year;
    $data['year'] = $year;

    
    //total staff
    $this->db->where('role!=','none');
    $this->db->where('role!=','admin');
    $this->db->from('users');
    $data['staffs'] = $this->db->count_all_results();
    //total units
    $this->db->from('units');
    $data['totalUnits'] = $this->db->count_all_results();
    //allocation summary

    $this->db->where('year',($year-1));
    $this->db->from('allocation');
    $data['lastYearAllocations'] = $this->db->count_all_results();

    $this->db->where('year',$year);
    $this->db->from('allocation');
    $data['thisYearAllocations'] = $this->db->count_all_results();

    $this->db->from('allocation');
    $data['totalAllocations'] = $this->db->count_all_results();

    
    $queryYearlyHours = $this->db->query("SELECT sum(workLoad) as TotalWorkLoad FROM `allocation` 
                    LEFT JOIN allocationactlect ON allocation.allocationID = allocationactlect.allocationID 
                    WHERE year = ".$year);
    $data['yearlyHours']= $queryYearlyHours->row();
    $data['yearlyHours']= $data['yearlyHours']->TotalWorkLoad;
    
    //activities summary
    $this->db->from('activities');
    $data['totalAllocations'] = $this->db->count_all_results();

    //metrics
    // $this->db->from('metrics');
    // $data['totalMetrics'] = $this->db->count_all_results();   

    //metrics in use
    // $this->db->distinct('metricsID');
    // $this->db->from('activities');
    // $data['metricsInUse'] = $this->db->count_all_results(); 

    $data['budgets'] = array(
      'lastYear' => $this->ngBudgetCalc($year-1),
      'currentYear' => $this->ngBudgetCalc($year),
      'nextYear' => $this->ngBudgetCalc($year+1)
    );

    $this->load->view('templates/header');
    $this->load->view('reporting/reporting', $data);
    $this->load->view('templates/footer');
  }
  // function 
  function allocations($year = null)
  {
    $year = $year == null ? date("Y") : $year;
    $data['year'] = $year;
    
    $query1 = $this->db->query("SELECT * FROM `allocation` LEFT JOIN units ON allocation.unitID = units.unit_id WHERE year = " . $year);
    $data['allAllocations']= $query1->result();
    
    $data['allAllocationsOfferings']= $this->db->get('allocationofferings')->result();

    $query2 = $this->db->query("SELECT * FROM `allocationactlect` INNER JOIN activities ON allocationactlect.activitiesID = activities.activitiesID INNER JOIN users ON allocationactlect.userID = users.user_id ");
    $data['allActUsers']= $query2->result();
    
    $this->load->view('templates/header');
    $this->load->view('reporting/report_allocation', $data);
    $this->load->view('templates/footer');
  }
  function staffs($year = null)
  {
    $year = $year == null ? date("Y") : $year;
    $data['year'] = $year;
    $this->db->where("role!=", "admin");
    $this->db->where("role!=", "none");
    $this->db->order_by("role", "ASC");
    $data['allUsers'] = $this->db->get('users')->result();

    $query2 = $this->db->query("SELECT * FROM `allocationactlect` 
    LEFT JOIN activities ON allocationactlect.activitiesID = activities.activitiesID 
    LEFT JOIN allocation ON allocation.allocationID = allocationactlect.allocationID 
    LEFT JOIN users ON users.user_id = allocationactlect.userID 
    LEFT JOIN units ON units.unit_id = allocation.unitID
    WHERE role != 'none' OR role != 'admin'");
    $data['allActUsers']= $query2->result();

    $query3 = $this->db->query("SELECT * FROM `allocationofferings` LEFT JOIN allocationactlect ON allocationactlect.allocationID = allocationofferings.allocationID");
    $data['allAllocationsOfferings']= $query3->result();
    
    $this->load->view('templates/header');
    $this->load->view('reporting/report_staff', $data);
    $this->load->view('templates/footer');
  }

  function units($year = null)
  {
    $year = $year == null ? date("Y") : $year;
    $data['year'] = $year;
    $this->db->order_by("unit_code", "ASC");
    $data['allUnits'] = $this->db->get('units')->result();

    $query2 = $this->db->query("SELECT * FROM `allocationactlect` LEFT JOIN activities ON allocationactlect.activitiesID = activities.activitiesID LEFT JOIN allocation ON allocation.allocationID = allocationactlect.allocationID LEFT JOIN units ON allocation.unitID = units.unit_id LEFT JOIN users On users.user_id = allocationactlect.userID ");
    $data['allActUsers']= $query2->result();

    $query3 = $this->db->query("SELECT * FROM `allocation` LEFT JOIN units ON units.unit_id = allocation.unitID LEFT JOIN allocationofferings ON allocationofferings.allocationID = allocation.allocationID ");
    $data['allAllocationsOfferings']= $query3->result();
    

    $this->load->view('templates/header');
    $this->load->view('reporting/report_unit', $data);
    $this->load->view('templates/footer');
  }

  function budgets($year = null)
  {
    $year = $year == null ? date("Y") : $year;
    $data['year'] = $year;

    $this->db->where('gsetting_code', 'casual_hourly');
    $casualBudgetRate = $this->db->get('settings')->row()->value;
    $data['casualBudgetRate'] = $casualBudgetRate == null ? 1: $casualBudgetRate;

    $this->db->where('gsetting_code', 'casual_'.$year);
    $data['casualBudgetThisYear'] = @$this->db->get('settings')->row()->value;


    $query2 = $this->db->query("SELECT * FROM `allocationactlect` LEFT JOIN allocation ON allocation.allocationID = allocationactlect.allocationID LEFT JOIN units ON units.unit_id = allocation.unitID LEFT JOIN activities ON activities.activitiesID = allocationactlect.activitiesID LEFT JOIN users ON users.user_id = allocationactlect.userID WHERE role = 'none' OR role = 'casualstaff' ORDER BY unit_code");
    $data['allActUsers']= $query2->result();

    $data['casualCount'] = count($data['allActUsers']);
    $data['casualHrCount'] = 0;
    foreach ($data['allActUsers'] as $item) {
      $data['casualHrCount'] = $data['casualHrCount'] + $item->workLoad;
    }
    $data['totalCasualCost'] = ngReturnFloat($data['casualHrCount'] * $data['casualBudgetRate']);

    $data['casualBudgetPercentage'] = ngReturnFloat(100- ($data['totalCasualCost'] / $data['casualBudgetThisYear']) * 100);

    $query3 = $this->db->query("SELECT * FROM `allocation` LEFT JOIN units ON units.unit_id = allocation.unitID LEFT JOIN allocationofferings ON allocationofferings.allocationID = allocation.allocationID ");
    $data['allAllocationsOfferings']= $query3->result();
    
    $this->load->view('templates/header');
    $this->load->view('reporting/report_budget', $data);
    $this->load->view('templates/footer');
  }





  function ngBudgetCalc($year = null)
  {
    if ($year != null) {
      try {
        $this->db->select('sum(workLoad) AS totalWorkLoad');
        $this->db->from('allocation');
        $this->db->join('allocationactlect', 'allocationactlect.allocationID = allocation.allocationID');
        $this->db->join('users', 'users.user_id = allocationactlect.userID', 'left');
        $this->db->where('allocation.year', $year);
        $this->db->where('users.role =', 'none');
        $this->db->or_where('users.role =', 'casualstaff');
        $totalCasualWorkLoadHr = $this->db->get()->row();
        $totalCasualWorkLoadHr = $totalCasualWorkLoadHr->totalWorkLoad == null ? 0 : $totalCasualWorkLoadHr->totalWorkLoad;

        $this->db->where('gsetting_code', 'casual_hourly');
        $casualBudgetRate = @$this->db->get('settings')->row()->value;
        $casualBudgetRate = $casualBudgetRate == null ? 1: $casualBudgetRate;

        $this->db->where('gsetting_code', 'casual_'.$year);
        $casualBudgetThisYear = @$this->db->get('settings')->row()->value;
        if ($casualBudgetThisYear == null) {
          return array(0,0);
        }else{
          return array($casualBudgetThisYear, ngReturnFloat((($totalCasualWorkLoadHr * $casualBudgetRate))));   
        }
        
      } catch (Exception $e) {
        return "N/A";
      }
      
    }else{
      return "N/A";  
    }
    
  }


}