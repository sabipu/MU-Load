<?php

class Activities_model extends CI_Model {

  public $tablename = NULL;

  public $activitiesID;
  public $title;
  public $activitiesCode;
  public $metricsID;
  public $created;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'activities';
  }
}
?>