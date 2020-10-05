<?php

class Metrics_model extends CI_Model {

  public $tablename = NULL;

  public $budgetallocID;
  public $hoursID;
  public $activityID;
  public $totalBudget;
  public $created;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'budgetalloc';
  }
}
?>