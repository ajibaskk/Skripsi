<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSensor extends CI_Controller {

  public function index() {
    $include['title'] = 'Data Sensor';
    $include['datasensor'] = 'active';

    $this->load->view("templates/head.php", $include);
    $this->load->view("templates/sidebar.php", $include);
    $this->load->view("templates/navbar.php", $include);
    $this->load->view('datasensor');
    $this->load->view("templates/footer.php");
  }
}
