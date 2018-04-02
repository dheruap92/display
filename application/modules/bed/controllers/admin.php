<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public $query_menu;
	public function __construct() {
		parent::__construct();
		$this->load->library("ion_auth");
		$this->load->model("paviliun_model",'paviliun');
		$this->load->model("kamar_model",'kamar');
		$this->load->model('bed_model',"bed");
		$this->load->model('pengumuman_model',"pengumuman");
		$this->load->model('menu_model',"menu");
		$this->load->model('akun_model',"akun");
		$this->load->model('admin_model',"admin");
		$this->load->model('reservasi_model',"reservasi");
		$this->load->model('panel_model','panel');
		$this->load->model('activity_model','activity');
		$this->query_menu = $this->admin->getMenu();
		if (!$this->ion_auth->logged_in()) {
			redirect("auth",'refresh');
		} else {
			
		}
	}
	
	public function index(){
		// print_r($query_menu->result());
		$data = array(
			'main_menu' => $this->query_menu,
			'p'			=> 'admin/dashboard_view',
			'paviliun'	=> $this->loadPaviliun()
		);
		$this->load->view("admin_view",$data);
	}

	#paviliun
	public function paviliun($param1="") {
		$this->validate_admin();
		if ($param1=="tambah") {
			$data = array(
                'nama_paviliun' => $this->input->post('nama_paviliun', TRUE),
                'keterangan'    => $this->input->post('keterangan', TRUE),
            );
        
        	$insert = $this->paviliun->save($data);
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
                'nama_paviliun' => $this->input->post('nama_paviliun', TRUE),
                'keterangan'    => $this->input->post('keterangan', TRUE),
            );

	        $this->paviliun->update(array("id_paviliun" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->paviliun->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->paviliun->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->paviliun->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_paviliun."'>";
	            $row[] = $no;
	            $row[] = $r->nama_paviliun;
	            $row[] = $r->keterangan;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_paviliun."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_paviliun."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->paviliun->count_all(),
	                        "iTotalDisplayRecords" => $this->paviliun->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/paviliun_view',
				'link1'		=> 'Admin',
				'link2'		=> 'Paviliun',
			);
			$this->load->view("admin_view",$data);
		}
	}

	#kamar
	public function Kamar($param1="") {
		$this->validate_admin();
		if ($param1=="tambah") {
			$data = array(
              'nama_kamar'  => $this->input->post('nama_kamar', TRUE),
               'kelas'       => $this->input->post('kelas', TRUE),
               'id_paviliun' => $this->input->post('id_paviliun', TRUE)
            );
        
        	$insert = $this->kamar->save($data);
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
                'nama_kamar'  => $this->input->post('nama_kamar', TRUE),
                'kelas'       => $this->input->post('kelas', TRUE),
                'id_paviliun' => $this->input->post('id_paviliun', TRUE)
            );

	        $this->kamar->update(array("id_kamar" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->kamar->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->kamar->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->kamar->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_kamar."'>";
	            $row[] = $no;
	            $row[] = $r->nama_kamar;
	            $row[] = $r->kelas;
	            $row[] = $r->nama_paviliun;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_kamar."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	            	  <a class="btn btn-xs btn-default" data-rel="tooltip" title="Lihat" onclick="lihat('."'".$r->id_kamar."'".')"><i class="ace-icon fa fa-eye bigger-120"></i></a>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_kamar."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->kamar->count_all(),
	                        "iTotalDisplayRecords" => $this->kamar->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/kamar_view',
				'link1'		=> 'Admin',
				'link2'		=> 'kamar',
				'paviliun'	=> $this->loadPaviliun()
			);
			$this->load->view("admin_view",$data);
		}
	}

	#bed
	public function bed($param1="") {
		$this->validate_admin();
		if ($param1=="tambah") {
			$data = array(
              'id_kamar'    => $this->input->post('id_kamar', TRUE),
              'no_bed'      => $this->input->post('no_bed', TRUE)
            );
        
        	$insert = $this->bed->save($data);
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
               'id_kamar'    => $this->input->post('id_kamar', TRUE),
               'no_bed'      => $this->input->post('no_bed', TRUE)
            );

	        $this->bed->update(array("id_bed" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->bed->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->bed->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->bed->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            if ($r->status==0) {
	            	$r->status = "Kosong";
	            } else {
	            	$r->status = "Terisi";
	            }
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_bed."'>";
	            $row[] = $no;
	            $row[] = $r->nama_paviliun;
	            $row[] = $r->nama_kamar;
	            $row[] = $r->kelas;
	            $row[] = $r->no_bed;
	            $row[] = $r->status;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_bed."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_bed."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->kamar->count_all(),
	                        "iTotalDisplayRecords" => $this->kamar->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/bed_view',
				'link1'		=> 'Admin',
				'link2'		=> 'Bed',
				'paviliun'	=> $this->loadPaviliun(),
			);
			$this->load->view("admin_view",$data);
		}
	}

	#Pengumuman
	public function pengumuman($param1="") {
		// $this->validate_admin();
		if ($param1=="tambah") {
			$data = array(
              'judul'    		=> $this->input->post('judul', TRUE),
              'text_pengumuman' => $this->input->post('text_pengumuman', TRUE),
              'keterangan' 		=> $this->input->post('keterangan', TRUE)
            );
        
        	$insert = $this->pengumuman->save($data);
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
               'judul'    		=> $this->input->post('judul', TRUE),
              'text_pengumuman' => $this->input->post('text_pengumuman', TRUE),
              'keterangan' 		=> $this->input->post('keterangan', TRUE)
            );

	        $this->pengumuman->update(array("id_pengumuman" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->pengumuman->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->pengumuman->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->pengumuman->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_pengumuman."'>";
	            $row[] = $no;
	            $row[] = $r->judul;
	            $row[] = $r->text_pengumuman;
	            $row[] = $r->keterangan;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_pengumuman."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_pengumuman."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->pengumuman->count_all(),
	                        "iTotalDisplayRecords" => $this->pengumuman->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/pengumuman_view',
				'link1'		=> 'Admin',
				'link2'		=> 'Pengumuman'
			);
			$this->load->view("admin_view",$data);
		}
	}

	#menu
	public function menu($param1="") {
		$this->validate_admin();
		if ($param1=="tambah") {
			$data = array(
              'name'    	=> $this->input->post('name', TRUE),
              'url' 		=> $this->input->post('url', TRUE),
              'judul' 		=> $this->input->post('judul', TRUE),
              'parent_id'	=> $this->input->post('parent_id', TRUE)
            );
        
        	$insert = $this->menu->save($data);
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
              'name'    	=> $this->input->post('name', TRUE),
              'url' 		=> $this->input->post('url', TRUE),
              'judul' 		=> $this->input->post('judul', TRUE),
              'parent_id'	=> $this->input->post('parent_id', TRUE)
            );

	        $this->menu->update(array("id_menu" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->menu->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->menu->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->menu->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_menu."'>";
	            $row[] = $no;
	            $row[] = $r->id_menu;
	            $row[] = $r->name;
	            $row[] = $r->url;
	            $row[] = $r->judul;
	            $row[] = $r->parent_name;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_menu."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_menu."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->menu->count_all(),
	                        "iTotalDisplayRecords" => $this->menu->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/menu_view',
				'link1'		=> 'Admin',
				'link2'		=> 'menu',
				'menu'		=> $this->loadmenu()
			);
			$this->load->view("admin_view",$data);
		}
	}

	#akun
	public function akun($param1="") {
		$this->validate_admin();
		if ($param1=="tambah") {
            $username 	= $this->input->post('username', TRUE);
            $email 		= $this->input->post('email', TRUE);
            $password 	= $this->input->post('password', TRUE);

            $additional_data = array(
								'first_name' => 'RSUD',
								'last_name' => 'Pariaman',
								);
			$group = array($this->input->post('user_group', TRUE)); // Sets user to admin.
			$this->ion_auth->register($username, $password, $email, $additional_data, $group);
        
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
              'username'    => $this->input->post('username', TRUE),
              'email' 		=> $this->input->post('email', TRUE),
            );
            $password =  $this->input->post('password', TRUE);
            if ($password!='initial') {
            	$data['password'] = $password;
            }

	        $this->ion_auth->update($this->input->post("id_pk"), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->akun->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->ion_auth->delete_user($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->akun->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id."'>";
	            $row[] = $no;
	            $row[] = $r->username;
	            $row[] = $r->email;
	            $row[] = ($r->password);
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->akun->count_all(),
	                        "iTotalDisplayRecords" => $this->akun->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/akun_view',
				'link1'		=> 'Admin',
				'link2'		=> 'akun',
				'group'		=> $this->loadGroup()
			);
			$this->load->view("admin_view",$data);
		}
	}

	public function setting($param1="") {
		$this->validate_admin();
		if ($param1=="lagu") {
       		$data = file_get_contents("./assets/aplikasi/data/audio.JSON");
       		$data_arr = json_decode($data);
       		$data_arr->{"lagu1"} = $this->input->post("nilai");
       		$data_js = json_encode($data_arr);
       		file_put_contents("./assets/aplikasi/data/audio.JSON", $data_js);
       		$this->refresh();
		}  else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'admin/setting_view',
				'link1'		=> 'Admin',
				'link2'		=> 'Setting',
				'group'		=> $this->loadGroup()
			);
			$this->load->view("admin_view",$data);
		}
	}

	public function subkamar($param1="") {
		if ($param1=="petugas") {
			$this->session->unset_userdata('petugas');
			$this->session->set_userdata('petugas',$this->input->post('petugas', TRUE));
			echo $this->session->petugas;
		} else if ($param1=="list") {
			$list = $this->activity->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id."'>";
	            $row[] = $no;
	            $row[] = $r->paviliun;
	            $row[] = $r->kamar;
	            $row[] = $r->kelas;
	            $row[] = $r->no_bed;
	            $row[] = $r->tanggal_aksi;
	            $row[] = ($r->aksi=="cekin")?"<span class='label label-success'>CEKIN</span>":"<span class='label label-danger'>CEKOUT</span>";
	            $row[] = $r->petugas;
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->activity->count_all(),
	                        "iTotalDisplayRecords" => $this->activity->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);		
		} else {
			$id_paviliun = $this->input->post("id_paviliun");
			$data = array(
				'kamar' => $this->kamar->getKamar($id_paviliun)->result(),
				'reservasi' => $this->reservasi->getReservasiByIdPaviliun($id_paviliun)->result(),
				'totalTersedia' => $this->panel->getTotalTersedia()->result(),
				'kelas' => $this->admin->getKelasById($id_paviliun)->result() 
			);
			return $this->load->view('admin/subkamar_view',$data);
		}
		
	}
	public function getReservasiById() {
		$id = $this->input->post("id");
		$data_reservasi = $this->reservasi->getReservasiById($id);
		echo json_encode($data_reservasi->result());
	}	
	function validate_admin() {
		if (!$this->ion_auth->in_group('admin')) {
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('admin');
		}
	}

	function loadPaviliun() {
		$data_paviliun = $this->paviliun->getPaviliun();
		return $data_paviliun->result();
	}

	function loadKamar($id="") {
		$data_kamar = $this->kamar->getKamar($id)->result();
		echo json_encode($data_kamar);
	}

	function loadMenu() {
		$data_menu = $this->menu->getMenu()->result();
		return $data_menu;
	}

	function loadGroup() {
		$data_akun = $this->akun->getGroup();
		return $data_akun->result();
	}

	function refresh() {
		$write = write_file('./assets/aplikasi/data/refresh.txt',"1");
	}
	


}

