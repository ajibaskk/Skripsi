<?php
class M_operasi extends CI_Model {
  function ambilOperasi() {
    return $this->db->query("SELECT * FROM jenis_operasi");
  }

  function ubahOperasi($status) {
    if ($status == 1) {
      $this->db->query("UPDATE jenis_operasi SET status = 0");
    } else {
      $this->db->query("UPDATE jenis_operasi SET status = 1");
    }
  }
}
