<?php
class M_datasensor extends CI_Model {
  function ambilDataSensorTabel() {
    return $this->db->query("SELECT * FROM data_sensor ORDER BY tanggal DESC, waktu DESC LIMIT 5");
  }

  function ambilDataSensor() {
    return $this->db->query("SELECT * FROM data_sensor ORDER BY tanggal DESC, waktu DESC LIMIT 1");
  }

  function ambilDataSensorTabel2() {
    return $this->db->query("SELECT * FROM data_sensor ORDER BY id");
  }
}
