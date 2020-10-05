<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller {
  public $vars = array();

  public function __construct() {
    parent::__construct();
    $this->load->library('session');

    $this->vars['javascript']=array();
    $this->vars['stylesheets']=array();
  }

  public function stylesheet($path = NULL) {
      if(!is_null($path) && strlen($path) > 0) {
        foreach($this->vars['stylesheets'] as $stylesheet) {
          if($stylesheet == $path) return;
        }
        $this->vars['stylesheets'][] = $path;
      }
  }
}