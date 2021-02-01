<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSensor extends CI_Controller {

  public function index() {
    $start_date = $this->input->post('start_date');
    $end_date = $this->input->post('end_date');

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

  public function filter_tanggal() {
    $start_date = $this->input->post('start_date');
    $end_date = $this->input->post('end_date');
    $this->load->model("m_datasensor");
    $return = $this->m_datasensor->filterTanggal($start_date, $end_date);

    echo json_encode($return);
  }
}
