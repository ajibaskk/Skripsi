<?php
class M_aturwaktu extends CI_Model {

  function aturWaktu($jam_buka, $jam_tutup) {
    $this->db->query("UPDATE batas_jam SET jam_buka = '$jam_buka', jam_tutup = '$jam_tutup' WHERE id = 1");
  }

  function ambilJamBuka() {
    return $this->db->query("SELECT jam_buka FROM batas_jam");
  }

  function ambilJamTutup() {
    return $this->db->query("SELECT jam_tutup FROM batas_jam");
  }
}
