<?php
class M_aturkelembaban extends CI_Model {

  function aturKelembaban($kelembaban) {
    $this->db->query("UPDATE batas_kelembaban SET 	kelembaban = $kelembaban WHERE 	id_kelembaban = 1");
  }

  function ambilKelembaban() {
    return $this->db->query("SELECT * FROM batas_kelembaban");
  }
}
