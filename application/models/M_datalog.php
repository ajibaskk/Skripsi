<?php
class M_datalog extends CI_Model {
  function ambilDataLog() {
    return $this->db->query("SELECT * FROM data_log ORDER BY id")->result_array();
  }

  function filterTanggal($start_date, $end_date) {
    $this->db->select("*");
    $this->db->from('data_log');
    $this->db->where('tanggal >=', $start_date);
    $this->db->where('tanggal <=', $end_date);

    return $this->db->get()->result_array();
  }

  //data log untuk manual
  public function tambahDataLogManualBukaJendela1($jam_sekarang, $tanggal_sekarang) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, status_operasi, posisi_jendela1, sensor) VALUES ('$jam_sekarang', '$tanggal_sekarang', 'Remote', 'Terbuka', 'Pengguna')");
  }
  public function tambahDataLogManualBukaJendela2($jam_sekarang, $tanggal_sekarang) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, status_operasi, posisi_jendela2, sensor) VALUES ('$jam_sekarang', '$tanggal_sekarang', 'Remote', 'Terbuka', 'Pengguna')");
  }
  public function tambahDataLogManualTutupJendela1($jam_sekarang, $tanggal_sekarang) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, status_operasi, posisi_jendela1, sensor) VALUES ('$jam_sekarang', '$tanggal_sekarang', 'Remote', 'Tertutup', 'Pengguna')");
  }
  public function tambahDataLogManualTutupJendela2($jam_sekarang, $tanggal_sekarang) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, status_operasi, posisi_jendela2, sensor) VALUES ('$jam_sekarang', '$tanggal_sekarang', 'Remote', 'Tertutup', 'Pengguna')");
  }

  //data log untuk otomatis
  public function tambahDataLogTerbukaOtomatisKarenaSemuaSensor($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, kecepatanangin, t_kecepatanangin, statushujan, t_statushujan, suhu, t_suhu, kelembaban, t_kelembaban, status_operasi, posisi_jendela1, posisi_jendela2, sensor, t_jambuka, t_jamtutup) VALUES ('$jam_sekarang', '$tanggal_sekarang', '$kec_angin', 8, '$stat_hujan', '$T_hujan', '$suhu', '$T_suhu', '$kelembaban', '$T_kelembaban', 'Otomatis', 'Terbuka', 'Terbuka', 'Semua Sensor', '$T_jam_buka', '$T_jam')");
  }
  public function tambahDataLogTertutupOtomatisKarenaJam($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, kecepatanangin, t_kecepatanangin, statushujan, t_statushujan, suhu, t_suhu, kelembaban, t_kelembaban, status_operasi, posisi_jendela1, posisi_jendela2, sensor, t_jambuka, t_jamtutup) VALUES ('$jam_sekarang', '$tanggal_sekarang', '$kec_angin', 8, '$stat_hujan', '$T_hujan', '$suhu', '$T_suhu', '$kelembaban', '$T_kelembaban', 'Otomatis', 'Tertutup', 'Tertutup', 'Jam', '$T_jam_buka', '$T_jam')");
  }
  public function tambahDataLogTertutupOtomatisKarenaAngin($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, kecepatanangin, t_kecepatanangin, statushujan, t_statushujan, suhu, t_suhu, kelembaban, t_kelembaban, status_operasi, posisi_jendela1, posisi_jendela2, sensor, t_jambuka, t_jamtutup) VALUES ('$jam_sekarang', '$tanggal_sekarang', '$kec_angin', 8, '$stat_hujan', '$T_hujan', '$suhu', '$T_suhu', '$kelembaban', '$T_kelembaban', 'Otomatis', 'Tertutup', 'Tertutup', 'Kecepatan Angin', '$T_jam_buka', '$T_jam')");
  }
  public function tambahDataLogTertutupOtomatisKarenaHujan($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, kecepatanangin, t_kecepatanangin, statushujan, t_statushujan, suhu, t_suhu, kelembaban, t_kelembaban, status_operasi, posisi_jendela1, posisi_jendela2, sensor, t_jambuka, t_jamtutup) VALUES ('$jam_sekarang', '$tanggal_sekarang', '$kec_angin', 8, '$stat_hujan', '$T_hujan', '$suhu', '$T_suhu', '$kelembaban', '$T_kelembaban', 'Otomatis', 'Tertutup', 'Tertutup', 'Hujan', '$T_jam_buka', '$T_jam')");
  }
  public function tambahDataLogTertutupOtomatisKarenaDHT($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, kecepatanangin, t_kecepatanangin, statushujan, t_statushujan, suhu, t_suhu, kelembaban, t_kelembaban, status_operasi, posisi_jendela1, posisi_jendela2, sensor, t_jambuka, t_jamtutup) VALUES ('$jam_sekarang', '$tanggal_sekarang', '$kec_angin', 8, '$stat_hujan', '$T_hujan', '$suhu', '$T_suhu', '$kelembaban', '$T_kelembaban', 'Otomatis', 'Tertutup', 'Tertutup', 'DHT22', '$T_jam_buka', '$T_jam')");
  }
  public function tambahDataLogTertutupOtomatisKarenaHujanDanAngin($jam_sekarang, $tanggal_sekarang, $kec_angin, $stat_hujan, $T_hujan, $suhu, $T_suhu, $kelembaban, $T_kelembaban, $T_jam_buka, $T_jam) {
    $this->db->query("INSERT INTO data_log (waktu, tanggal, kecepatanangin, t_kecepatanangin, statushujan, t_statushujan, suhu, t_suhu, kelembaban, t_kelembaban, status_operasi, posisi_jendela1, posisi_jendela2, sensor, t_jambuka, t_jamtutup) VALUES ('$jam_sekarang', '$tanggal_sekarang', '$kec_angin', 8, '$stat_hujan', '$T_hujan', '$suhu', '$T_suhu', '$kelembaban', '$T_kelembaban', 'Otomatis', 'Tertutup', 'Tertutup', 'Hujan dan Angin', '$T_jam_buka', '$T_jam')");
  }
}
