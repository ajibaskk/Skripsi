<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputSensor extends CI_Controller {

  public function index() {
    $include['title'] = 'Input Sensor';
    $include['inputsensor'] = 'active';

    $this->load->view("templates/head.php", $include);
    $this->load->view("templates/sidebar.php", $include);
    $this->load->view("templates/navbar.php", $include);
    $this->load->view('inputsensor');
    $this->load->view("templates/footer.php");
    $this->load->view("templates/script.php");
  }
}
