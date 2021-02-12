<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mikrokontroler extends CI_Controller {

  public function ambilData() {
    $this->load->model('m_mikrokontroler');
    $this->load->model('m_operasi');
    $this->load->model('m_statusjendela');
    $this->load->model('m_atursuhu');
    $this->load->model('m_aturkelembaban');

    if (function_exists('date_default_timezone_set')) {
      date_default_timezone_set('Asia/Jakarta');
      $jam_sekarang = date("H:i:s");
      $tanggal_sekarang = date("Y-m-d");
    }

    $kec_angin = (float)$this->input->get('kec_angin'); //>3 nutup
    $stat_hujan = (int)$this->input->get('stat_hujan');
    $suhu = (float)$this->input->get('suhu');
    $kelembaban = (float)$this->input->get('kelembaban');

    $this->m_mikrokontroler->tambahData($kec_angin, $stat_hujan, $suhu, $kelembaban, $jam_sekarang, $tanggal_sekarang);

    //ambil tresshold suhu
    $T_suhu = $this->m_atursuhu->ambilSuhu()->row_array();
    $T_suhu = (float)$T_suhu['suhu'];

    //ambil tresshold kelembaban
    $T_kelembaban = $this->m_aturkelembaban->ambilKelembaban()->row_array();
    $T_kelembaban = (float)$T_kelembaban['kelembaban'];

    //tresshold jam
    $T_jam = strtotime('18:00:00');
    $T_jam = date('H:i:s', $T_jam);

    $T_jam_buka = strtotime('06:00:00');
    $T_jam_buka = date('H:i:s', $T_jam_buka);

    //ambil status otomatisasi
    $otomatisasi = $this->m_operasi->ambilOperasi()->row_array();
    $otomatisasi = $otomatisasi['status'];

    if ($otomatisasi == 1) { //auto nyala
      //ambil status jendela terakhir
      $status_jendela = $this->m_statusjendela->ambilJendela1()->row_array();
      $status_jendela = $status_jendela['status'];

      if ($status_jendela == 0) { //jendela masih tertutup
        //$this->m_statusjendela->tutupJendelaAll();
        if ($suhu >= $T_suhu || $kelembaban >= $T_kelembaban) {
          if ($stat_hujan == 0 && $kec_angin <= 8) {
            if ($jam_sekarang > $T_jam_buka && $jam_sekarang < $T_jam) {
              $this->m_statusjendela->bukaJendelaAll();
            } else {
              $this->m_statusjendela->tutupJendelaAll();
            }
          } else {
            $this->m_statusjendela->tutupJendelaAll();
          }
        } else {
          $this->m_statusjendela->tutupJendelaAll();
        }
      } else { // jendela terbuka
        //$this->m_statusjendela->bukaJendelaAll();
        if ($stat_hujan == 1) {
          $this->m_statusjendela->tutupJendelaAll();
        } else if ($stat_hujan == 0 && $kec_angin >= 8) { //moderate breeze
          $this->m_statusjendela->tutupJendelaAll();
        } else if ($suhu >= $T_suhu || $kelembaban >= $T_kelembaban) {
          if ($stat_hujan == 0 && $kec_angin <= 8) {
            if ($jam_sekarang > $T_jam_buka && $jam_sekarang < $T_jam) {
              $this->m_statusjendela->bukaJendelaAll();
            } else {
              $this->m_statusjendela->tutupJendelaAll();
            }
          } else {
            $this->m_statusjendela->tutupJendelaAll();
          }
        } else {
          $this->m_statusjendela->tutupJendelaAll();
        }
      }
    } else { // auto mati
      //tidak ngapa ngapain
    }

    $status_jendela_final = $this->m_statusjendela->ambilJendela()->result();
    // $last_otomatisasi_status = array('status_otomatisasi' => $otomatisasi);

    // array_push($status_jendela_final, $last_otomatisasi_status);

    echo json_encode($status_jendela_final);
  }
}
