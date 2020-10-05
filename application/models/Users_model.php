<?php

class Users_model extends CI_Model {

  public $tablename = NULL;

  public $user_id;
  public $role = "academicstaff";
  public $name;
  public $first_name;
  public $middle_name;
  public $last_name;
  public $email;
  public $username;
  public $created;
  public $status;
  public $allocated_hour;
  public $remaining_hour;
  public $password;

  public function __construct() {
    $this->load->database();
    $this->tablename = 'users';
  }

  function validate() {
    $array['username'] = $this->input->post('username');
    $array['password'] = md5($this->input->post('password'));
    // $array['password'] = $this->input->post('password');

    return $this->db->get_where('users', $array)->row();
  }

  function findUserWithEmail($email = NULL, $status = NULL) {
    $array['email'] = $email;
    if($status != NULL) {
      $array['status'] = $status;
    }

    return $this->db->get_where('users', $array)->row();
  }

  function findUnitWithUserId($user_id = NULL) {
    $array['user_id'] = $user_id;
    return $this->db->get_where('users', $array)->row();
  }

  function hasHashExpired($user_id = NULL, $hash = NULL) {
    $max_time = 24 * 60 * 60;
    $isValid = 'false';

    $array['user_id'] = $user_id;
    $array['recovery_hash'] = $hash;

    $user = $this->db->get_where('users', $array)->row();

    if(isset($user)) {
      $recovery_date = strtotime($user->recovery_date);
      $today = strtotime(date('Y-m-d H:i:s'));

      $elapsed_time = $today - $recovery_date;

      if($elapsed_time <= $max_time) {
        $isValid = 'true';
      }
    } else {
      $isValid = 'incorrect';
    }

    return $isValid;
  }

  function checkUserStatus($user_id = NULL, $hash = NULL) {
    $array['user_id'] = $user_id;
    $array['status_hash'] = $hash;

    return $this->db->get_where('users', $array)->row();
  }
}

?>
