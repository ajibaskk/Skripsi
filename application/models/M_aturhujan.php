<?php
class M_aturhujan extends CI_Model {

  function aturHujan($hujan) {
    $this->db->query("UPDATE atur_hujan SET hujan = $hujan WHERE id_hujan = 1");
  }

  function ambilHujan() {
    return $this->db->query("SELECT * FROM atur_hujan");
  }
}
