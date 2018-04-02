<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservasi extends CI_Controller {
	public $query_menu;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model',"admin");
		$this->load->model('reservasi_model',"reservasi");
		$this->load->model('paviliun_model',"paviliun");
		$this->load->model('kamar_model',"kamar");
		$this->query_menu = $this->admin->getMenu();
	}

	public function index()
	{
		
	}

	public function cekin($param1="") {
		if ($param1=="tambah") {
			$data = array(
                'nama' 				=> $this->input->post('nama', TRUE),
                'no_mr'    			=> $this->input->post('no_mr', TRUE),
                'jenis_kelamin' 	=> $this->input->post('jk', TRUE),
                'tgl_cekin'    		=> $this->input->post('tgl_cekin', TRUE),
                'tgl_cekout'    	=> $this->input->post('tgl_cekout', TRUE),
                'id_bed'    		=> $this->input->post('id_bed', TRUE),
                'status_reservasi'  => "0",
                'petugas'			=> $this->session->userdata('username')
            );
        
        	$insert = $this->reservasi->save($data);
        	$this->tambahPasien($data);
        	$this->setBedStatus($this->input->post('id_bed', TRUE),"1");
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
                'nama' 			=> $this->input->post('nama', TRUE),
                'no_mr'    		=> $this->input->post('no_mr', TRUE),
                'jenis_kelamin' => $this->input->post('jk', TRUE),
                'tgl_cekin'    	=> $this->input->post('tgl_cekin', TRUE),
                'tgl_cekout'    => $this->input->post('tgl_cekout', TRUE),
                'id_bed'    	=> $this->input->post('id_bed', TRUE),
            );
			$this->setBedStatus($this->input->post('id_bed', TRUE),"1");
			$test = $this->unsetBedStatus($this->input->post("id_pk"));
	        $this->reservasi->update(array("id_reservasi" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE,'debug'=>$this->input->post("id_pk")));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->reservasi->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$data_bed = $this->reservasi->get_by_id($id);
			$this->setBedStatus($data_bed->id_bed,"0");
			$this->reservasi->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="out") {
			$id = $this->input->post('id_reservasi',TRUE);
			$tgl_cekout = $this->input->post('tgl_cekout',TRUE);
			$data = array(
				'tgl_cekout' 		=> $tgl_cekout,
				'status_reservasi'	=> "1"
				);
			$data_bed = $this->reservasi->get_by_id($id);

			$this->setBedStatus($data_bed->id_bed,"0");
			$this->reservasi->update(array('id_reservasi'=>$id),$data);
       		echo json_encode(array("status" => TRUE,"id"=>$id));
		} else if ($param1=="list") {
			$list = $this->reservasi->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	        	if ($r->status_reservasi==1) {
	        		$r->status_reservasi = "<p class='text-green'>selesai</p>";
	        	} else {
	        		$r->status_reservasi = "<p class='text-yellow'>progress</p>";
	        	}
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_reservasi."'>";
	            $row[] = $no;
	            $row[] = $r->id_reservasi;
	            $row[] = $r->nama;
	            $row[] = $r->no_mr;
	            $row[] = $r->jenis_kelamin;
	            $row[] = $r->tgl_cekin;
	            $row[] = $r->tgl_cekout;
	            $row[] = $r->status_reservasi;
	            $row[] = $r->nama_paviliun."/".$r->nama_kamar."/".$r->no_bed;
	            $row[] = $r->petugas;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_reservasi."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_reservasi."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>
	                  <a class="btn btn-xs btn-default" data-rel="tooltip" title="Cekout" onclick="cekout('."'".$r->id_reservasi."'".')"><i class="ace-icon fa  fa-plane bigger-120"></i></a>
	                  ';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->reservasi->count_all(),
	                        "iTotalDisplayRecords" => $this->reservasi->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'reservasi/cekin_view',
				'link1'		=> 'Admin',
				'link2'		=> 'kamar',
				'bed'		=> $this->loadBed(),
				'reservasi'	=> $this->loadReservasi(),
				'data_reservasi' => $this->loadDataReservasi()
			);
			$this->load->view("admin_view",$data);
		}
	}

	public function cekout($param1="") {
		if ($param1=="out") {
			$id = $this->input->post('id_reservasi',TRUE);
			$tgl_cekout = $this->input->post('tgl_cekout',TRUE);
			$data = array(
				'tgl_cekout' 		=> $tgl_cekout,
				'status_reservasi'	=> "1"
				);
			$data_bed = $this->reservasi->get_by_id($id);

			$this->setBedStatus($data_bed->id_bed,"0");
			$this->reservasi->update(array('id_reservasi'=>$id),$data);
       		echo json_encode(array("status" => TRUE,"id"=>$id));
		} else if ($param1=="list") {
			$list = $this->reservasi->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	        	if ($r->status_reservasi==1) {
	        		$r->status_reservasi = "<p class='text-green'>selesai</p>";
	        	} else {
	        		$r->status_reservasi = "<p class='text-yellow'>progress</p>";
	        	}
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_reservasi."'>";
	            $row[] = $no;
	            $row[] = $r->id_reservasi;
	            $row[] = $r->nama;
	            $row[] = $r->no_mr;
	            $row[] = $r->jenis_kelamin;
	            $row[] = $r->tgl_cekin;
	            $row[] = $r->tgl_cekout;
	            $row[] = $r->status_reservasi;
	            $row[] = $r->nama_paviliun."/".$r->nama_kamar."/".$r->id_bed;
	            //add html for action
	            $row[] = '
	                  <a class="btn btn-xs btn-default" data-rel="tooltip" title="Cekout" onclick="cekout('."'".$r->id_reservasi."'".')"><i class="ace-icon fa  fa-plane bigger-120"></i></a>
	                  ';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->reservasi->count_all(),
	                        "iTotalDisplayRecords" => $this->reservasi->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'reservasi/cekout_view',
				'link1'		=> 'Admin',
				'link2'		=> 'kamar',
				'bed'		=> $this->loadBed(),
				'reservasi'	=> $this->loadReservasi(),
				'data_reservasi' => $this->loadDataReservasi()
			);
			$this->load->view("admin_view",$data);
		}
	}

	function kelola($param1="") {
		if ($param1=="list") {
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
	            $row[] = '<button class="btn btn-xs btn-default" data-rel="tooltip" title="Lihat" onclick="lihat('."'".$r->id_paviliun."'".')"><i class="ace-icon fa fa-eye bigger-120"></i></button>';
	 
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
		} else if ($param1=="list_kamar") {
			$id = $this->input->post('id');
			$data = $this->reservasi->getDataKamar($id)->result();
	        echo json_encode(array("status"=>true,"data"=>$data));		
		} else if ($param1=="list_bed") {
			$id = $this->input->post('id');
			$data = $this->reservasi->getDataBed($id)->result();
	        echo json_encode(array("status"=>true,"data"=>$data));		
		} else {
			$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'reservasi/kelola_view',
				'link1'		=> 'Admin',
				'link2'		=> 'kamar',
				'paviliun'	=> $this->loadPaviliun(),
				'kamar'		=> $this->loadKamar(),
			);
			$this->load->view('admin_view',$data);

		}
	}

	public function history($param1="") {
		if ($param1=="list") {
			$list = $this->reservasi->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	        	if ($r->status_reservasi==1) {
	        		$r->status_reservasi = "<p class='text-green'>selesai</p>";
	        	} else {
	        		$r->status_reservasi = "<p class='text-yellow'>progress</p>";
	        	}
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_reservasi."'>";
	            $row[] = $no;
	            $row[] = $r->id_reservasi;
	            $row[] = $r->nama;
	            $row[] = $r->no_mr;
	            $row[] = $r->jenis_kelamin;
	            $row[] = $r->tgl_cekin;
	            $row[] = $r->tgl_cekout;
	            $row[] = $r->status_reservasi;
	            $row[] = $r->nama_paviliun."/".$r->nama_kamar."/".$r->id_bed;
	            //add html for action
	            $row[] = '
	                  <button class="btn btn-xs btn-default" data-rel="tooltip" title="Riwayat Kunjungan" onclick="lihat('."'".$r->nama."'".')"><i class="ace-icon fa fa-eye bigger-120"></i></button>
	                  ';
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "sEcho" => $_POST['draw'],
	                        "iTotalRecords" => $this->reservasi->count_all(),
	                        "iTotalDisplayRecords" => $this->reservasi->count_filtered(),
	                        "aaData" => $data,
	                );
	        //output to json format
	        echo json_encode($output);			
		} else if ($param1=="riwayat") {
			$tampil = "";
			$nama = $this->input->post('nama');
			$data = $this->reservasi->getRiwayatPasien($nama);
			$no=1;
			$head = $data->row();
			$tampil.="
				<table class='table table-hover'>
				  <thead>
				    <tr>
				      <th>Data</th>
				      <th>Isian</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>Nama</td>
				      <td>".$head->nama."</td>
				    </tr>
				    <tr>
				      <td>No Mr</td>
				      <td>".$head->no_mr."</td>
				    </tr>
				  </tbody>
				</table>
			";
			$tampil.= "
				<table class='table table-hover'>
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Tanggal Cekin</th>
                       <th>Tanggal Cekout</th>
                       <th>Status</th>
                     </tr>
                   </thead>
                   <tbody>";
                    foreach ($data->result() as $row) {
                    	$status = ($row->status==0)?"Selesai":"Progres";
                    	$tampil.="
							<tr>
		                       <td>".$no++."</td>
		                       <td>".$row->tgl_cekin."</td>
		                       <td>".$row->tgl_cekout."</td>
		                       <td>".$status."</td>
		                    </tr>
                    	";
                    }
                  
            $tampil.="</tbody>
                 </table>";
            echo $tampil;
		} else {
		  	$data = array(
				'main_menu' => $this->query_menu,
				'p'			=> 'reservasi/history_view',
				'link1'		=> 'Admin',
				'link2'		=> 'kamar',
				'bed'		=> $this->loadBed(),
				'reservasi'	=> $this->loadReservasi(),
				'data_reservasi' => $this->loadDataReservasi()
			);
			$this->load->view("admin_view",$data);
		}
	
	}

	public function tambahPasien($data) {
		$data = array(
                'nama_pasien' 	=> $data['nama'],
                'no_mr'    		=> $data['no_mr'],
                'jk' 			=> $data['jenis_kelamin']
            );
		$this->reservasi->savePasien($data);
	}

	public function setBedStatus($param1="",$param2="") {
		$this->reservasi->setBedStatus($param1,$param2);
	}
	public function unsetBedStatus($param1="") {
		$this->reservasi->unsetBedStatus($param1);
	}

	public function loadDataReservasi () {
		$data = $this->reservasi->loadDataReservasi();
		return $data->result();
	}
	public function loadBed() {
		$data = $this->reservasi->getBed();
		return $data;
	}

	public function loadReservasi() {
		$data = $this->reservasi->getReservasi();
		return $data;
	}

	function loadPaviliun() {
		$data_paviliun = $this->paviliun->getPaviliun();
		return $data_paviliun->result();
	}

	function loadKamar($id="") {
		$data_kamar = $this->kamar->getKamar($id)->result();
		return $data_kamar;
	}



}

/* End of file reservasi.php */
/* Location: ./application/controllers/reservasi.php */