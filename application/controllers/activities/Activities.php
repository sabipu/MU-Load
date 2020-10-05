<?php
class Activities extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('activities_model');
    $this->load->model('metrics_model');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  }

  function index() {
    $data['activities'] = $this->db->get_where("activities")->result();
    $data['metrics'] = $this->db->get_where("metrics")->result();
    $this->load->view('templates/header');
    $this->load->view('activities/activities', $data);
    $this->load->view('templates/footer');
  }

  function create() {
     $data = array(
      'title' => $this->input->get_post('title'),
      'metricsID' => $this->input->get_post('metrics'),
      'created' => date("Y-m-d H:i:s")
    );

    $this->db->insert('activities', $data);
    redirect(base_url('activities'));
  }

  function add() {
    $metrics_title = $this->input->get_post('metrics_title');
    $metrics_notes = $this->input->get_post('metrics_notes');
    $formula_value = $this->input->get_post('formula_value');
    $metrics_code = $this->input->get_post('metrics_code');

    if (isset($_POST['associated_activity'])) {
      $associated_activity =  $this->input->get_post('associated_activity');  
    }else{
      $associated_activity =  "";  
    }

    $data = array(
      'metrics_code' => $metrics_code,
      'metrics_title' => $metrics_title,
      'formula_or_value' => $formula_value,
      'metrics_variable' => "",
      'metrics_note' => $metrics_notes,
      'formula_or_value_output' => ngLoadCalc($formula_value, ""),
      'associated_activity' => $associated_activity,
    );
    $this->db->insert('metrics', $data);
    redirect(base_url('metrics'));
  }

  function edit($eid = null)
  {
    $this->db->where('activitiesID', $eid);
    $data['activity'] = $this->db->get_where("activities")->row();
    $data['metrics'] = $this->db->get_where("metrics")->result();
    $this->load->view('templates/header');
    $this->load->view('activities/edit', $data);
    $this->load->view('templates/footer');
  }

  function update($eid = null)
  {
    $data = array(
      'title' => $this->input->get_post('title'),
      'activitiesCode' => $this->input->get_post('activitiesCode'),
      'metricsID' => $this->input->get_post('metrics')
    );
    $this->db->where('activitiesID', $eid);
    $this->db->update('activities', $data);
    redirect(base_url('activities'));
  }

  function updateMetricsCalc($eid)
  {
    $this->db->where('met_id',$eid);
    $row = $this->db->get_where('metrics')->row();
    $formula_or_value_output = ngLoadCalc($row->formula_or_value, $row->metrics_variable);

    $this->db->set('formula_or_value_output', $formula_or_value_output);
    $this->db->where('met_id',$eid);
    $this->db->update('metrics');
  }

  function delete($eid = null)
  {
    
    // if ($eid == null) {
    //   throw new Exception();
    // }
    $this->db->where("activitiesID", $eid);
    $this->db->delete("activities");
    redirect(base_url('activities'));
  }
}