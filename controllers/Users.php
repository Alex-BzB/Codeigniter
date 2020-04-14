<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class Users extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Users_model');
  }

  public function Index(){
    $data['title'] = "Print users";
    $data['users'] = $this->Users_model->getUsers();

    $this->load->view('templates/header',$data);
    $this->load->view('users/index',$data);
    $this->load->view('templates/footer');
    }

  public function view($name = NULL){
    $data['name_user'] = $this->Users_model->getUsers($name);

    if(empty($data['name_user'])){
      show_404();
    }
    $data['title'] = "Страница: ".$data['name_user']['name'];
    $data['email'] =" Email: ".$data['name_user']['email'];
    $data['name'] = "Имя: ".$data['name_user']['name'].
    $data['age'] = "Возраст: ".$data['name_user']['age'];

    $this->load->view('templates/header',$data);
    $this->load->view('users/view',$data);
    $this->load->view('templates/footer');


  }
}
