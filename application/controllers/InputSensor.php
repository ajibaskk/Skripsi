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

    $this->load->model("m_aturhujan");
    $hujan = $this->m_aturhujan->ambilHujan()->row_array();
    $data["hujan"] = $hujan["hujan"];

    $this->load->model("m_aturwaktu");
    $jam_buka = $this->m_aturwaktu->ambilJamBuka()->row_array();
    $jam_tutup = $this->m_aturwaktu->ambilJamTutup()->row_array();
    $data["jam_buka"] = $jam_buka["jam_buka"];
    $data["jam_tutup"] = $jam_tutup["jam_tutup"];


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

  public function ubah_hujan() {
    $hujan = $this->input->post('hujan');
    $this->load->model("m_aturhujan");
    $this->m_aturhujan->aturHujan($hujan);
    echo json_encode(true);
  }

  public function ubah_waktu() {
    $jam_buka = $this->input->post('jam_buka');
    $jam_tutup = $this->input->post('jam_tutup');
    $this->load->model("m_aturwaktu");
    $this->m_aturwaktu->aturWaktu($jam_buka, $jam_tutup);
    echo json_encode(true);
  }

  public function ambil_hujan() {
    $this->load->model("m_aturhujan");
    $data = $this->m_aturhujan->ambilHujan()->result();
    if (count($data)  == 0) {
      $data = false;
    }
    echo json_encode($data);
  }
}
