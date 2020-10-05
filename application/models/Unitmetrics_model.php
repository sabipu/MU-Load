<?php

class Metrics_model extends CI_Model {

  public $tablename = NULL;

  public $unitMetricsID;
  public $unitID;
  public $metricsID;
  public $calcMetrics;
  public $created;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'unitmetrics';
  }
}
?>