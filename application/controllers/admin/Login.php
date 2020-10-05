<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once '../BaseController.php';

class Login extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url_helper');

    $this->stylesheet('/assets/main.css');

    if($this->session->userdata('admin')) {
      redirect('dashboard');
    }
  }

  function index() {
    // echo $login_message;
    // $this->load->view('templates/header');
    $this->load->view('admin/login');
    // $this->load->view('templates/footer');
  }

  function verify() {
    // bipu 1234
    $this->load->model('users_model');
    $check = $this->users_model->validate();
    if($check) {
      $this->session->set_userdata('admin', '1');
      redirect('dashboard');
    } else {
      redirect('login');
    }
  }
}


