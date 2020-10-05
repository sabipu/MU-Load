<?php

class Logout extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url_helper');
  }

  function index() {
    $this->session->sess_destroy();
    redirect('login');
  }
}


