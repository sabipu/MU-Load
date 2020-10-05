<?php

class Metrics extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('loadcalc_helper');
    $this->load->model('metrics_model');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  }

  function index() {
    
    

    $data['metrics'] = $this->db->get_where("metrics")->result();
    $this->load->view('templates/header');
    $this->load->view('metrics/metrics', $data);
    $this->load->view('templates/footer');
  }

  function addMetrics() {
    $data['activities'] = $this->db->get_where("activities")->result();
    $this->load->view('templates/header');
    $this->load->view('metrics/add',$data);
    $this->load->view('templates/footer');
  }

  function add() {
    $metrics_title = $this->input->get_post('metrics_title');
    $metrics_notes = $this->input->get_post('metrics_notes');
    $formula_value = $this->input->get_post('formula_value');
    $metrics_code = $this->input->get_post('metrics_code');

    // if (isset($_POST['associated_activity'])) {
    //   $associated_activity =  $this->input->get_post('associated_activity');  
    // }else{
    //   $associated_activity =  "";  
    // }

    $data = array(
      'metrics_code' => $metrics_code,
      'metrics_title' => $metrics_title,
      'formula_or_value' => $formula_value,
      'metrics_variable' => "",
      'metrics_note' => $metrics_notes,
      'formula_or_value_output' => 'Not Set'
    );
    $this->db->insert('metrics', $data);
    redirect(base_url('metrics'));
  }

  function editMetrics()
  {
    $eid = $_POST['eid'];
    $type = $_POST['type'];
    $result = "";

    if ($type == "Edit") {
      $this->db->where('met_id',$eid);
      $data = $this->db->get_where('metrics')->row();
      $loadVar = ngLoadVarCount($data->formula_or_value);
      $metrics_variable = ngExplode($data->metrics_variable);
      for ($i=0; $i < count($loadVar); $i++) { 
        $thisValue = "";
        if (@isset($metrics_variable[$i])) {
          $thisValue = $metrics_variable[$i];
        }
        $result .= "<span class='variable-title'>Value of ".$loadVar[$i]."</span><input type='text' name='metrics_variable[]' value='".$thisValue."'></input>";  
      }
    }else if ($type == "Save"){
      $data = $_POST['data'];
      $metrics_variable = "";
      foreach ($data as $key => $value) {
        $metrics_variable .= $value . ",";
      }
      $metrics_variable = rtrim($metrics_variable, ",");

      $this->db->set('metrics_variable', $metrics_variable);
      $this->db->where('met_id',$eid);
      $this->db->update('metrics');

      $this->updateMetricsCalc($eid);

      $this->db->where('met_id',$eid);
      $row = $this->db->get_where('metrics')->row();
      
      $resultAll = array(
        'variables' => $row->metrics_variable,
        'totalHours' => $row->formula_or_value_output
      );
      $result = json_encode($resultAll);
    }
    echo $result;
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

  function delMetrics()
  {
    $eid = $_POST['eid'];
    $this->db->where("met_id", $eid);
    $this->db->delete("metrics");
  }
}