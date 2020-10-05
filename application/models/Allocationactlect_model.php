<?php

class Allocationactlect_model extends CI_Model {

  public $tablename = NULL;

  public $allocationActLectID;
  public $allocationID;
  public $activitiesID;
  public $userID;
  public $created;
  public $modified;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'allocationactlect';
  }
}
?>