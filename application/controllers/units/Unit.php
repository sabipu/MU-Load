<?php

class Unit extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url_helper');
  }

  function index() {
    $this->load->model('units_model');
    $this->load->model('activities_model');
    $this->load->model('unitactivitiesmeta_model');

    $data['units'] = $this->db->get_where('units')->result();
    $data['activities'] = $this->db->get_where('activities')->result();
    $data['unitactivitiesmeta'] = $this->db->get_where('unitactivitiesmeta')->result();
    $query = $this->db->query("SELECT * FROM activities LEFT JOIN metrics ON activities.metricsID = metrics.met_id");
    $data['activities_metrics_meta'] = $query->result();
    
    $this->load->view('templates/header');
    $this->load->view('unit/unit', $data);
    $this->load->view('templates/footer');
  }

  function unitAdd() {
    $this->load->model('activities_model');
    $data['activities'] = $this->db->get_where('activities')->result();

    $this->load->view('templates/header');
    $this->load->view('unit/add', $data);
    $this->load->view('templates/footer');
  }

  function deleteUnit() {
    $this->load->model('units_model');
    $unitId = $this->input->post('unitId');

    if($this->units_model->findUnitWithUnitId($unitId)) {
      $this->db->delete('units', array('unit_id' => $unitId));
    }
  }

  function updateUnit() {
    $this->load->model('units_model');

    $unit_id = $this->input->get_post('id');
    $unit_code = $this->input->get_post('unit_code');
    $unit_name = $this->input->get_post('unit_name');
    $unit_activities = $this->input->get_post('unit_activities');

    if(isset($unit_activities)) {
      $activities = array();

      foreach ($unit_activities as $activity) {
        array_push($activities, $activity);
      }
      $activities = implode(",", $activities);
    }

    if($this->units_model->findUnitWithUnitId($unit_id)) {
      $data = array(
        'unit_code' => $unit_code,
        'unit_name' => $unit_name,
        'activities' => $activities,
        'activities_modified' => date('Y-m-d H:i:s')
      );
      $this->db->where('unit_id', $unit_id);
      $this->db->update('units', $data);
    }
  }

  function add() {
    // var_dump($_POST);
    // die();
    $this->load->model('units_model');
    $this->load->model('unitactivitiesmeta_model');

    $unit_code = $this->input->get_post('unit_code');
    $unit_name = $this->input->get_post('unit_name');
    $unit_activities = $this->input->get_post('activity');

    

    $check = $this->units_model->findUnitWithUnitCode($unit_code);
    if(!$check) {
      $data_unit = array(
              'unit_name' => $unit_name,
              'unit_code' => $unit_code,
      );
      $this->db->insert('units', $data_unit);
      $eid = $this->db->insert_id();


      $data = array();
      foreach ($unit_activities as $item) {
        $activities = array(
                  'unitID' => $eid,
                  'activitiesID'  => $item,
                  'created' => date('Y-m-d H:i:s')
        );
        array_push($data, $activities);
      }

      $this->db->insert_batch('unitactivitiesmeta', $data);
      // echo "DONE";
      redirect(base_url('unit'));
    }else {
      echo 'Unit already exists.';
    }
    // $this->db->insert('unit');
    // $eid = $this->db->insert_id();

    // var_dump($unit_activities);
    // if(isset($unit_activities)) {
    //   $activities = array();

    //   foreach ($unit_activities as $activity) {
    //     array_push($activities, $activity);
    //   }
    //   $activities = implode(",", $activities);
    // }
    // $data = array();
    // foreach ($unit_activities as $item) {
    //   $activities = array(
    //             'unitID' => $eid,
    //             'activities'  => $item,
    //             'created' => date('Y-m-d H:i:s')
    //   );
    //   array_push($data, $activities);
    // }
    // var_dump($activities);
    // var_dump($data);
    // die();
    // $check = $this->units_model->findUnitWithUnitCode($unit_code);
    // if(!$check) {
      // $data = array();
      // foreach ($unit_activities as $item) {
      //   $activities = array(
      //             'unit_name' => $unit_name,
      //             'unit_code' => $unit_code,
      //             'activities'  => $item
      //   );
      //   array_push($data, $activities);
      // }
      // $data = array(
      //   'unit_code' => $unit_code,
      //   'unit_name' => $unit_name,
      //   'activities' => $activities,
      //   'activities_modified' => date('Y-m-d H:i:s')
      // );
      // $this->db->insert_batch('units', $data);
      // echo "DONE";
    // } else {
    //   echo 'Unit already exists.';
    // }
  }
}