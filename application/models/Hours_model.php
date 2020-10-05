<?php

class Metrics_model extends CI_Model {

  public $tablename = NULL;

  public $hoursID;
  public $userID;
  public $hours;
  public $created;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'hours';
  }
}
?>