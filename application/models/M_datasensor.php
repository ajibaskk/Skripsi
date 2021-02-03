<?php
class M_datasensor extends CI_Model {
  function ambilDataSensorTabel() {
    return $this->db->query("SELECT * FROM data_sensor ORDER BY tanggal DESC, waktu DESC LIMIT 5");
  }

  function ambilDataSensor() {
    return $this->db->query("SELECT * FROM data_sensor ORDER BY tanggal DESC, waktu DESC LIMIT 1");
  }

  function ambilDataSensorTabel2() {
    return $this->db->query("SELECT * FROM data_sensor ORDER BY id")->result_array();
  }

  function filterTanggal($start_date, $end_date) {
    $this->db->select("*");
    $this->db->from('data_sensor');
    $this->db->where('tanggal >=', $start_date);
    $this->db->where('tanggal <=', $end_date);

    return $this->db->get()->result_array();
  }
}
