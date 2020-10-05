<?php

class Metrics_model extends CI_Model {

  public $tablename = NULL;

  public $metrics_code;
  public $metrics_title;
  public $formula_or_value;
  public $metrics_variable;
  public $metrics_note;
  public $formula_or_value_output;
  public $associated_activity;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'metrics';
  }
}
?>
