<?php

class Coursepref_model extends CI_Model {

  public $tablename = NULL;

  public $courseprefID;
  public $unitID;
  public $courseTypeID;
  public $created;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'coursepref';
  }
}
?>