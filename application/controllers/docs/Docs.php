<?php
class Docs extends CI_Controller {
  public function __construct() {
    parent::__construct();

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  }

  function index() {
    $this->load->view('templates/header');
    $this->load->view('docs/docs');
    $this->load->view('templates/footer');
  }
}