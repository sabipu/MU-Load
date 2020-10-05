<?php

class Dashboard extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->helper('url');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
     $this->load->model('activities_model');
     $this->load->model('users_model');
     $this->load->model('units_model');
     $this->load->model('allocation_model');
  }

  function index() {
    $this->db->where('role !=','none');
    $this->db->where('role !=','admin');
    $this->db->from('users');
    $data['staffs'] = $this->db->count_all_results();

    $this->db->from('units');
    $data['totalUnits'] = $this->db->count_all_results();

    $this->db->from('activities');
    $data['activities'] = $this->db->count_all_results();

    $query = $this->db->query("SELECT first_name, allocated_hour, remaining_hour, (users.allocated_hour - users.remaining_hour) as difference FROM `users` WHERE users.role != 'none' AND users.role != 'admin' ORDER BY difference DESC LIMIT 5");
    $top5Allocation = $query->result();

    $data['t5Users'] = array();
    $data['t5TotalHours'] = array();
    $data['t5AllocatedHours'] = array();

    if (count($top5Allocation) == 5) {
      foreach ($top5Allocation as $key => $value) {
        array_push($data['t5Users'], $value->first_name);
        array_push($data['t5TotalHours'], intval($value->allocated_hour));
        array_push($data['t5AllocatedHours'], intval($value->allocated_hour - $value->remaining_hour));
      }  
    }else{
      $data['t5Users'] = array("Hamid", "Pol", "Peter", "Mike", "Frank");
      $data['t5TotalHours'] = array(1238, 553, 746, 884, 903);
      $data['t5AllocatedHours'] = array(238, 553, 746, 884, 903);      
    }
    
    $data['t5Users'] = json_encode($data['t5Users']);
    $data['t5TotalHours'] = json_encode($data['t5TotalHours']);
    $data['t5AllocatedHours'] = json_encode($data['t5AllocatedHours']);
    
    $this->load->view('templates/header');
    $this->load->view('dashboard', $data);
    $this->load->view('templates/footer');
  }
}