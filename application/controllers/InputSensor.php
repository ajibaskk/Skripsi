<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputSensor extends CI_Controller {

  public function index() {
    $include['title'] = 'Input Sensor';
    $include['inputsensor'] = 'active';

    $this->load->model("m_aturkelembaban");
    $kelembaban = $this->m_aturkelembaban->ambilKelembaban()->row_array();
    $data["kelembaban"] = $kelembaban["kelembaban"];

    $this->load->model("m_atursuhu");
    $suhu = $this->m_atursuhu->ambilSuhu()->row_array();
    $data["suhu"] = $suhu["suhu"];

    $this->load->view("templates/head.php", $include);
    $this->load->view("templates/sidebar.php", $include);
    $this->load->view("templates/navbar.php", $include);
    $this->load->view('inputsensor', $data);
    $this->load->view("templates/footer.php");
    $this->load->view("templates/script.php");
  }

  public function ubah_kelembaban() {
    $kelembaban = $this->input->post('kelembaban');
    $this->load->model("m_aturkelembaban");
    $this->m_aturkelembaban->aturKelembaban($kelembaban);
    echo json_encode(true);
  }

  public function ubah_suhu() {
    $suhu = $this->input->post('suhu');
    $this->load->model("m_atursuhu");
    $this->m_atursuhu->aturSuhu($suhu);
    echo json_encode(true);
  }
}
