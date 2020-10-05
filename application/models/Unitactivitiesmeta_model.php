<?php

class Unitactivitiesmeta_model extends CI_Model {

  public $tablename = NULL;

  public $unitactivitiesmetaID;
  public $unitID;
  public $activitiesID;
  public $created;
  public $modified;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'unitactivitiesmeta';
  }
}
?>