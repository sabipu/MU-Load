<?php

class Register extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url_helper');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  } 

  function index() {
    $this->load->model('units_model');

    $data['units'] = $this->db->get_where('units')->result();

    $this->load->view('templates/header');
    $this->load->view('user/register', $data);
    $this->load->view('templates/footer');
  }

  function deleteUser() {
    $this->load->model('users_model');
    $userId = $this->input->post('userId');

    if($this->users_model->findUnitWithUserId($userId)) {
      $this->db->delete('users', array('user_id' => $userId));
    }
  }

  function updateUser() {
    $this->load->model('users_model');

    $user_id = $this->input->get_post('id');
    $name = $this->input->get_post('name');
    $email = $this->input->get_post('email');
    $hours = $this->input->get_post('hours');

    if($this->users_model->findUnitWithUserId($user_id)) {
      $data = array(
        'name' => $name,
        'email' => $email,
        'allocated_hour' => $hours
      );
      $this->db->where('user_id', $user_id);
      $this->db->update('users', $data);
    }
  }

  function updateStatus() {
    $this->load->model('users_model');

    $user_id = $this->input->get_post('id');
    $status = $this->input->get_post('status');

    if($this->users_model->findUnitWithUserId($user_id)) {
      $data = array(
        'status' => $status
      );
      $this->db->where('user_id', $user_id);
      $this->db->update('users', $data);
    }
  }

  function add() {
    $this->load->model('users_model');
    $this->load->model('settings_model');
    $this->load->model('coursepref_model');
    $fname = $this->input->get_post('fname');
    $mname = $this->input->get_post('mname');
    $lname = $this->input->get_post('lname');
    $role = $this->input->get_post('user_role');
    $email = $this->input->get_post('email');
    $hour_allocation = $this->input->get_post('hours');
    $preferred_units = $this->input->get_post('preferred');
    $password = $this->input->get_post('password');

    if($hour_allocation !== '') {
      $hour = ($hour_allocation / 100) * $this->settings_model->totalTeacingHour()->value;
    } else {
      $hour = '1';
    }

    if($password == '') {
      $password = md5(date('Y-m-d H:i:s'));
    }

    if(!$this->users_model->findUserWithEmail($email)) {
      $data = array(
        'username' => $email,
        'role' => $role,
        'name' => $fname." ".$mname." ".$lname,
        'first_name' => $fname,
        'middle_name' => $mname,
        'last_name' => $lname,
        'email' => $email,
        'created' => date('Y-m-d H:i:s'),
        'status' => 'active',
        'allocated_hour' => $hour,
        'remaining_hour' => $hour,
        'password' => md5($password)
      );
      $this->db->insert('users', $data);
    }
    if(isset($preferred_units)) {
      foreach ($preferred_units as $preferred_unit) {
        $prefermeta = array(
          'userID' => $this->users_model->findUserWithEmail($email)->user_id,
          'unitID' => $preferred_unit,
          'created' => date('Y-m-d H:i:s'),
          'modified' => date('Y-m-d H:i:s')
        );
        $this->db->insert('coursepref', $prefermeta);
      }
      echo 'User added successfully.';
    } else {
      echo 'User already exists';
    }
  }

  function activateAccount() {
    echo 'Activating your account';
    $vars = array();

    $this->load->model('users_model');
    $status_hash = $this->uri->segment(3);
    $user_id = $this->uri->segment(2);

    $check = $this->users_model->checkUserStatus($user_id, $status_hash);

    if($check) {
      $data = array(
        'status_hash' => NULL,
        'status' => 'active'
      );
      $this->db->update('users', $data, array('user_id' => $user_id));

      $vars['login_message'] = 'Account has been activated';

      echo '<br />';
      echo 'Account activated! You can find your password in your email. Please reset your password to be safe.';
      redirect('login', $vars);
    } else {
      echo 'Looks like your account is already active' . '<br/>';
      echo 'Please go to login page.';
    }
  }

  function manageStaff() {
    $this->load->model('users_model');


    $data['users'] = $this->db->get_where('users')->result();

    $this->load->view('templates/header');
    $this->load->view('user/manage', $data);
    $this->load->view('templates/footer');
  }
}


