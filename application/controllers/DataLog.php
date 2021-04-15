<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataLog extends CI_Controller {

  public function index() {

    $include['title'] = 'Data Log';
    $include['datalog'] = 'active';

    $this->load->view("templates/head.php", $include);
    $this->load->view("templates/sidebar.php", $include);
    $this->load->view("templates/navbar.php", $include);
    $this->load->view('datalog', $include);
    $this->load->view("templates/footer.php");
    $this->load->view("templates/script.php");
  }

  public function filter_tanggal() {
    $this->load->model("m_datalog");
    if (!empty($this->input->post('start_date')) && !empty($this->input->post('end_date'))) {
      $start_date = $this->input->post('start_date');
      $end_date = $this->input->post('end_date');

      $return = $this->m_datalog->filterTanggal($start_date, $end_date);
    } else {
      $return = $this->m_datalog->ambilDataLog();
    }
    echo json_encode($return);
  }
}
