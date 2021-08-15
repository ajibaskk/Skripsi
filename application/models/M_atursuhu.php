<?php
class M_atursuhu extends CI_Model {

  function aturSuhu($suhu) {
    $this->db->query("UPDATE batas_suhu SET 	suhu = $suhu WHERE 	id_suhu = 1");
  }

  function ambilSuhu() {
    return $this->db->query("SELECT * FROM batas_suhu");
  }
}
