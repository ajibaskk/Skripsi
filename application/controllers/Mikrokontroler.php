<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mikrokontroler extends CI_Controller {
  public function ambilData() {
    $this->load->model('m_mikrokontroler');
    $kec_angin = $this->input->get('kec_angin');
    $stat_hujan = $this->input->get('stat_hujan');
    $suhu = $this->input->get('suhu');
    $kelembaban = $this->input->get('kelembaban');

    $this->m_mikrokontroler->tambahData($kec_angin, $stat_hujan, $suhu, $kelembaban);

    echo json_encode(true);
  }
}
