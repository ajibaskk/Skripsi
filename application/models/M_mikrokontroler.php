<?php
class M_mikrokontroler extends CI_Model {
  public function tambahData($kec_angin, $stat_hujan, $suhu, $kelembaban) {
    $this->db->query("INSERT INTO data_sensor (kecepatanangin, statushujan, suhu, kelembaban) VALUES ('$kec_angin', '$stat_hujan', '$suhu', '$kelembaban')");
  }

  public function ubahJendela() {
  }
}
