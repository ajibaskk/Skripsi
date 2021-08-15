<?php
class M_aturhujan extends CI_Model {

  function aturHujan($hujan) {
    $this->db->query("UPDATE batas_hujan SET hujan = $hujan WHERE id_hujan = 1");
  }

  function ambilHujan() {
    return $this->db->query("SELECT * FROM batas_hujan");
  }
}
