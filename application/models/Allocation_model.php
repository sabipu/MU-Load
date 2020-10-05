<?php

class Allocation_model extends CI_Model {

  public $tablename = NULL;

  public $allocationID;
  public $unitID;
  public $courseType;
  public $lecturers;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'allocation';
  }
}
?>