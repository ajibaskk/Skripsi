<?php
class M_operasi extends CI_Model {
  function ambilOperasi() {
    return $this->db->query("SELECT * FROM operasi");
  }
}
