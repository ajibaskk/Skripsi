<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mikrokontroler extends CI_Controller {

  public function ambilData() {
    $this->load->model('m_mikrokontroler');
    $this->load->model('m_operasi');
    $this->load->model('m_statusjendela');
    $this->load->model('m_atursuhu');
    $this->load->model('m_aturkelembaban');
    $this->load->model('m_aturhujan');
    $this->load->model('m_datalog');
    $this->load->model('m_aturwaktu');

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

    //ambil tresshold hujan
    $T_hujan = $this->m_aturhujan->ambilHujan()->row_array();
    $T_hujan = (int)$T_hujan['hujan'];

    //tresshold jam
    $T_jam = $this->m_aturwaktu->ambilJamTutup()->row_array();
    $T_jam = $T_jam['jam_tutup'];
    //$T_jam = date('H:i:s', $T_jam);

    $T_jam_buka = $this->m_aturwaktu->ambilJamBuka()->row_array();
    $T_jam_buka = $T_jam_buka['jam_buka'];
    //$T_jam_buka = date('H:i:s', $T_jam_buka);

    //ambil status otomatisasi
    $otomatisasi = $this->m_operasi->ambilOperasi()->row_array();
    $otomatisasi = $otomatisasi['status'];

    if ($otomatisasi == 1) { //auto nyala
      //ambil status jendela terakhir
      $status_jendela = $this->m_statusjendela->ambilJendela1()->row_array();
      $status_jendela = $status_jendela['status'];

      $status_jendela2 = $this->m_statusjendela->ambilJendelaKedua()->row_array();
      $status_jendela2 = $status_jendela2['status'];

      if ($status_jendela == 0) { //jendela masih tertutup
        //$this->m_statusjendela->tutupJendelaAll();
        if ($suhu >= $T_suhu || $kelembaban >= $T_kelembaban) {
          if ($kec_angin <= 8) {
            if ($stat_hujan > $T_hujan) {
              if ($jam_sekarang > $T_jam_buka && $jam_sekarang < $T_jam) {
                $this->m_statusjendela->bukaJendelaAll();
                //masukin data log terbuka karena semua sensor
                $this->m_datalog->tambahDataLogTerbukaOtomatisKarenaSemuaSensor($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
              } else {
                $this->m_statusjendela->tutupJendelaAll();
                if ($status_jendela2 == 1) { //jendela masih kedua terbuka karena manual
                  //masukin data log tertutup karena jam
                  $this->m_datalog->tambahDataLogTertutupOtomatisKarenaJam($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
                }
              }
            } else {
              $this->m_statusjendela->tutupJendelaAll();
              if ($status_jendela2 == 1) { //jendela masih kedua terbuka karena manual
                //masukin data log tertutup karena hujan
                $this->m_datalog->tambahDataLogTertutupOtomatisKarenaHujan($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
              }
            }
          } else {
            $this->m_statusjendela->tutupJendelaAll();
            if ($status_jendela2 == 1) { //jendela masih kedua terbuka karena manual
              //masukin data log tertutup karena angin
              $this->m_datalog->tambahDataLogTertutupOtomatisKarenaAngin($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
            }
          }
        } else {
          $this->m_statusjendela->tutupJendelaAll();
          if ($status_jendela2 == 1) { //jendela masih kedua terbuka karena manual
            //masukin data log tertutup karena suhu/kelembaban
            $this->m_datalog->tambahDataLogTertutupOtomatisKarenaDHT($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
          }
        }
      } else { // jendela terbuka
        //$this->m_statusjendela->bukaJendelaAll();
        // if ($stat_hujan <= $T_hujan) {
        //   $this->m_statusjendela->tutupJendelaAll();
        //   //masukin data log tertutup karena hujan

        //} else 
        if ($stat_hujan <= $T_hujan && $kec_angin >= 8) { //moderate breeze
          $this->m_statusjendela->tutupJendelaAll();
          //masukin data log tertutup karena hujan dan angin
          $this->m_datalog->tambahDataLogTertutupOtomatisKarenaHujanDanAngin($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
        } else if ($suhu >= $T_suhu || $kelembaban >= $T_kelembaban) {
          if ($kec_angin <= 8) {
            if ($stat_hujan > $T_hujan) {
              if ($jam_sekarang > $T_jam_buka && $jam_sekarang < $T_jam) {
                $this->m_statusjendela->bukaJendelaAll();
                //($status_jendela2 == 0) {
                if ($status_jendela2 == 0) { //jendela kedua masih tertuttup
                  //masukin data log terbuka karena semua sensor
                  $this->m_datalog->tambahDataLogTerbukaOtomatisKarenaSemuaSensor($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
                }
              } else {
                $this->m_statusjendela->tutupJendelaAll();
                //masukin data log tertutup karena jam
                $this->m_datalog->tambahDataLogTertutupOtomatisKarenaJam($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
              }
            } else {
              $this->m_statusjendela->tutupJendelaAll();
              //masukin data log tertutup karena hujan
              $this->m_datalog->tambahDataLogTertutupOtomatisKarenaHujan($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
            }
          } else {
            $this->m_statusjendela->tutupJendelaAll();
            //masukin data log tertutup karena angin
            $this->m_datalog->tambahDataLogTertutupOtomatisKarenaAngin($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
          }
        } else {
          $this->m_statusjendela->tutupJendelaAll();
          //masukin data log tertutup karena suhu/kelembaban
          $this->m_datalog->tambahDataLogTertutupOtomatisKarenaDHT($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam);
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

  public function ambilDataTerakhir() {
    $this->load->model('m_statusjendela');
    $status_jendela_final = $this->m_statusjendela->ambilJendela()->result();
    echo json_encode($status_jendela_final);
  }
}
