<?php
class M_statusjendela extends CI_Model {

  function ambilJendela() {
    return $this->db->query("SELECT * FROM status_jendela");
  }

  function ambilJendela1() {
    return $this->db->query("SELECT * FROM status_jendela LIMIT 1");
  }

  function ambilJendela2() {
    return $this->db->query("SELECT status FROM status_jendela ORDER BY id");
  }

  function ambilJendelaKedua() {
    return $this->db->query("SELECT * FROM status_jendela WHERE id = 2");
  }

  function bukaJendela($id) {
    $this->db->query("UPDATE status_jendela SET status = 1 WHERE id = $id");
  }

  function tutupJendela($id) {
    $this->db->query("UPDATE status_jendela SET status = 0 WHERE id = $id");
  }

  function bukaJendelaAll() {
    $this->db->query("UPDATE status_jendela SET status = 1");
  }

  function tutupJendelaAll() {
    $this->db->query("UPDATE status_jendela SET status = 0");
  }
}
