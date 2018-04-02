<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('panel_model','panel');
	}
	
	public function index(){
		$data = array(
			"p" 		 => "admin/dasboard_view",
			'paviliun' 	 => $this->loadPaviliun(),
			'kelas'		 => $this->loadViewKelas(),
			'reservasi'  => $this->loadReservasi(),
			'pengumuman' => $this->loadPengumuman(),
			'totalTersedia' => $this->loadTotalTersedia()
			);
		$this->load->view("display_view",$data);
	}

	public function loadPaviliun() {
		$data = $this->panel->getPaviliun();
		return $data->result();
	}

	public function loadViewKelas() {
		$data = $this->panel->getViewKelas();
		return $data->result();
	}

	public function loadReservasi() {
		$data = $this->panel->getViewReservasi();
		return $data->result();
	}

	public function loadPengumuman() {
		$data = $this->panel->getViewPengumuman();
		return $data->result();
	}
	public function loadTotalTersedia() {
		$data = $this->panel->getTotalTersedia();
		return $data->result();
	}
	public function getRefresh() {
		$status = read_file("./assets/aplikasi/data/refresh.txt");
		echo  json_encode(array("status"=>$status));
		if ($status=="1") {
			write_file("./assets/aplikasi/data/refresh.txt","0");
		}
	}
}

