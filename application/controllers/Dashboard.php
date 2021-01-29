<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index() {
		$include['title'] = 'Dashboard';
		$include['dashboard'] = 'active';

		$this->load->view("templates/head.php", $include);
		$this->load->view("templates/sidebar.php", $include);
		$this->load->view("templates/navbar.php", $include);
		$this->load->view('dashboard');
		$this->load->view("templates/footer.php");
		$this->load->view("templates/script.php");
	}

	public function ambilDataSensor() {
		$this->load->model("m_datasensor");
		$data = $this->m_datasensor->ambilDataSensor()->result();

		if (count($data) == 0) {
			$data = false;
		}
		echo json_encode($data);
	}

	public function ambilDataSensorTabel() {
		$this->load->model("m_datasensor");
		$data = $this->m_datasensor->ambilDataSensorTabel()->result();

		if (count($data) == 0) {
			$data = false;
		}
		echo json_encode($data);
	}
}
