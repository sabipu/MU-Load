<?php

class Error extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->helper('url');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  }

  function index() {
    $this->load->view('templates/header');
    $this->load->view('error/error');
    $this->load->view('templates/footer');
  }
}