<?php

class ActivitiesmetricsMeta_model extends CI_Model {

  public $tablename = NULL;

  public $activitiesMetricMmetaID;
  public $activitiesID;
  public $metricsID;
  public $calcMetrics;
  public $created;
  public $modified;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'activitiesmetricsmeta';
  }
}
?>