<?php

class Allocationofferings_model extends CI_Model {

  public $tablename = NULL;

  public $allocationOfferingsID;
  public $allocationID;
  public $offerings;
  public $created;
  public $modified;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'allocationofferings';
  }
}
?>