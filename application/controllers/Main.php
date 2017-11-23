<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('school_model');
        $this->load->model('major_model');
        $this->load->model('env_var_model');
    }

    public function index(){
        $this->load->view('home/view');
    }
}