<?php
class M_mikrokontroler extends CI_Model {
  public function tambahData($kec_angin, $stat_hujan, $suhu, $kelembaban, $jam_sekarang, $tanggal_sekarang) {
    $this->db->query("INSERT INTO data_sensor (kecepatanangin, statushujan, suhu, kelembaban, waktu, tanggal) VALUES ('$kec_angin', '$stat_hujan', '$suhu', '$kelembaban', '$jam_sekarang', '$tanggal_sekarang')");
  }

  public function ubahJendela() {
  }
}
