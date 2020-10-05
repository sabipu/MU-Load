<?php

class Forgot extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url_helper');
  }

  function index() {
    $this->load->model('users_model');

    $recover_email = $this->input->get_post('recover_email');
    echo '<h2>Recover Email</h2>';
    echo '<p>Send an email with following link.</p>';

    $user = $this->users_model->findUserWithEmail($recover_email, 'active');

    if($user) {
      $recovery_hash = md5(time() . $user->email);

      $data = array(
        'recovery_hash' => $recovery_hash,
        'recovery_date' => date('Y-m-d H:i:s')
      );

      $this->db->where('user_id', $user->user_id);
      $this->db->update('users', $data);

      echo site_url() .'recover/'.$user->user_id.'/'.$recovery_hash;

    } else {
      echo '<hr>';
      echo 'No user found';
    }


    // echo $user['email'];

    // print_r($user);




    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.gmail.com',
      'smtp_port' => 465,
      'smtp_user' => 'bipu@dilate.com.au',// your mail name
      'smtp_pass' => 'DilateStew1181??',
      'mailtype'  => 'html',
      'charset'   => 'iso-8859-1',
       'wordwrap' => TRUE
    );

    $this->load->library('email');
    // $this->email->initialize($config);
    $this->load->model('users_model');
    // $email = $this->input->get_post('recover_email');
    $this->email->from('bipu@dilate.com.au', 'Bipu Bajgai');
    $this->email->to('bipubajgai@gmail.com');
    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');
    $this->email->send();
    echo $this->email->print_debugger();

  }
}


