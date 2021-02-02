<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index() {
		$this->load->model("m_statusjendela");
		$include['title'] = 'Dashboard';
		$include['dashboard'] = 'active';
		$data['jendela'] = $this->m_statusjendela->ambilJendela()->result_array();
		$this->load->view("templates/head.php", $include);
		$this->load->view("templates/sidebar.php", $include);
		$this->load->view("templates/navbar.php", $include);
		$this->load->view('dashboard', $data);
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

	public function ambilOperasi() {
		$this->load->model("m_operasi");
		$data_operasi = $this->m_operasi->ambilOperasi()->row_array();
		$operasi = $data_operasi['status'];
		$data = array();
		array_push($data, $operasi);
		echo json_encode($data);
	}

	public function ubahOperasi() {
		$this->load->model("m_operasi");
		$data_operasi = $this->m_operasi->ambilOperasi()->row_array();
		$operasi = $data_operasi['status'];
		$data = $this->m_operasi->ubahOperasi($operasi);
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

	public function ambilDataJendela() {
		$this->load->model("m_statusjendela");
		$this->load->model("m_operasi");
		$data_operasi = $this->m_operasi->ambilOperasi()->row_array();
		$operasi = $data_operasi['status'];
		if ($operasi  == 1) { // otomatis
			$data = $this->m_statusjendela->ambilJendela1()->row_array();
			if (count($data)  != 0) {
				$data = $data['status'];
			} else {
				$data = "Tidak Ditemukan";
			}
		} else { // manual
			$data = "Manual";
		}

		echo json_encode($data);
	}

	public function ambilStatusJendela() {
		$this->load->model("m_statusjendela");
		$data = $this->m_statusjendela->ambilJendela()->result();
		if (count($data)  == 0) {
			$data = false;
		}
		echo json_encode($data);
	}

	public function bukaJendela() {
		$this->load->model("m_statusjendela");
		$id_jendela = $this->input->post('id_jendela');
		$this->m_statusjendela->bukaJendela($id_jendela);
		$data = "Terbuka";
		echo json_encode($data);
	}

	public function tutupJendela() {
		$this->load->model("m_statusjendela");
		$id_jendela = $this->input->post('id_jendela');
		$this->m_statusjendela->tutupJendela($id_jendela);
		$data = "Tertutup";
		echo json_encode($data);
	}
}
