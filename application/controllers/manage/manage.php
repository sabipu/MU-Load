<?php

class Manage extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url_helper');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  }

  function index() {
    $this->load->model('users_model');

    $this->load->view('templates/header');

    $data['users'] = $this->db->get_where('users', array('status' => 'active'))->result();

    $this->load->view('manage/manage', $data);
    $this->load->view('templates/footer');
  }
}


