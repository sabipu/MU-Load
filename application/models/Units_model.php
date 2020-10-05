<?php

class Units_model extends CI_Model {

  public $tablename = NULL;

  public $unit_id;
  public $unit_name;
  public $unit_code;
  public $activities;
  public $activities_modified;


  public function __construct() {
    $this->load->database();
    $this->tablename = 'units';
  }

  function findUnitWithUnitCode($unit_code = NULL) {
    $array['unit_code'] = $unit_code;
    return $this->db->get_where('units', $array)->row();
  }

  function findUnitWithUnitId($unit_id = NULL) {
    $array['unit_id'] = $unit_id;
    return $this->db->get_where('units', $array)->row();
  }
}
?>
