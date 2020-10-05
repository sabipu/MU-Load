<?php

class Setting extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url_helper');

    if(!$this->session->userdata('admin')) {
      redirect('login');
    }
  }

  function index() {
    $this->load->model('settings_model');

    $data['settings'] = $this->db->get_where('settings')->result();
    $this->load->view('templates/header');
    $this->load->view('setting/setting', $data);
    $this->load->view('templates/footer');
  }

  function updateSettings() {
    $this->load->model('settings_model');

    $setting_id = $this->input->get_post('setting_id');
    $setting_title = $this->input->get_post('setting_title');
    $setting_value = $this->input->get_post('setting_value');
    $setting_additional = $this->input->get_post('setting_additional');

    if($this->settings_model->findSettingWithId($setting_id)) {
      $data = array(
        'title' => $setting_title,
        'value' => $setting_value,
        'additional' => $setting_additional,
        'added_date' => date('Y-m-d H:i:s')
      );
      $this->db->where('settings_id', $setting_id);
      $this->db->update('settings', $data);
    }
  }

  function addSettings() {
    $this->load->model('settings_model');

    $setting_title = $this->input->get_post('setting_title');
    $setting_value = $this->input->get_post('setting_value');
    $setting_additional = $this->input->get_post('setting_additional');
    $is_casual = $this->input->get_post('is_casual');

    if($is_casual === 'true') {
      $code = 'casual_' . $setting_additional;
    }

    $data = array(
      'title' => $setting_title,
      'value' => $setting_value,
      'additional' => $setting_additional,
      'gsetting_code' => $code,
      'added_date' => date('Y-m-d H:i:s')
    );

    $this->db->insert('settings', $data);

    echo 'Setting Added.';
  }
}


