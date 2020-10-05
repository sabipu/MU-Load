<?php

class Settings_model extends CI_Model {

  public $tablename = NULL;

  public $settings_id;
  public $title;
  public $value;
  public $additional;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'settings';
  }

  function findSettingWithId($setting_id = NULL) {
    $array['settings_id'] = $setting_id;
    return $this->db->get_where('settings', $array)->row();
  }

  function totalTeacingHour() {
    $array['gsetting_code'] = 'total_teaching';
    return $this->db->get_where('settings', $array)->row();
  }
}
?>
