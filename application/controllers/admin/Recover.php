<?php

class Recover extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url_helper');
  }

  function index() {
    $vars = array();

    $this->load->model('users_model');
    $recovery_hash = $this->uri->segment(3);
    $user_id = $this->uri->segment(2);

    $vars['recovery_hash'] = $recovery_hash;
    $vars['user_id'] = $user_id;

    $check = $this->users_model->hasHashExpired($user_id, $recovery_hash);

    if($check === 'true') {
      $this->load->view('admin/recover', $vars);
      $password = $this->input->get_post('password');

      if($password) {
        $data = array(
          'password' => $password,
        );
        $this->db->update('users', $data, array('user_id' => $user_id, 'recovery_hash' => $recovery_hash));
        $this->db->update('users', array('recovery_hash' => NULL, 'recovery_date' => NULL), array('user_id' => $user_id));
        echo 'Password changed';
      }
    } elseif($check === 'incorrect') {
      echo 'Incorrect Link';
    } else {
      echo 'Link expired';
    }
  }
}


