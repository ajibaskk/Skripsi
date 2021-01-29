<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSensor extends CI_Controller {

  public function index() {
    $include['title'] = 'Data Sensor';
    $include['datasensor'] = 'active';

    $this->load->model("m_datasensor");
    $include["datasensor"] = $this->m_datasensor->ambilDataSensorTabel2()->result_array();

    $this->load->view("templates/head.php", $include);
    $this->load->view("templates/sidebar.php", $include);
    $this->load->view("templates/navbar.php", $include);
    $this->load->view('datasensor', $include);
    $this->load->view("templates/footer.php");
    $this->load->view("templates/script.php");
  }
}
