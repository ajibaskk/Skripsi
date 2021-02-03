<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSensor extends CI_Controller {

  public function index() {
    //$start_date = $this->input->post('start_date');
    //$end_date = $this->input->post('end_date');

    $include['title'] = 'Data Sensor';
    $include['datasensor'] = 'active';

    //$this->load->model("m_datasensor");
    //$include["datasensors"] = $this->m_datasensor->ambilDataSensorTabel2();
    $this->load->view("templates/head.php", $include);
    $this->load->view("templates/sidebar.php", $include);
    $this->load->view("templates/navbar.php", $include);
    $this->load->view('datasensor', $include);
    $this->load->view("templates/footer.php");
    $this->load->view("templates/script.php");
  }

  public function filter_tanggal() {
    $this->load->model("m_datasensor");
    if (!empty($this->input->post('start_date')) && !empty($this->input->post('end_date'))) {
      $start_date = $this->input->post('start_date');
      $end_date = $this->input->post('end_date');

      $return = $this->m_datasensor->filterTanggal($start_date, $end_date);
    } else {
      $return = $this->m_datasensor->ambilDataSensorTabel2();
    }
    echo json_encode($return);
  }
}
