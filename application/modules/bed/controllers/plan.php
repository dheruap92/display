<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "hello";
	}

	#akun
	public function akun($param1="") {
		if ($param1=="tambah") {
			$data = array(
              'name'    	=> $this->input->post('name', TRUE),
              'url' 		=> $this->input->post('url', TRUE),
              'judul' 		=> $this->input->post('judul', TRUE),
              'parent_id'	=> $this->input->post('parent_id', TRUE)
            );
        
        	$insert = $this->akun->save($data);
        	echo json_encode(array("status" => TRUE));
		} else if ($param1=="ubah") {
			$data = array(
              'name'    	=> $this->input->post('name', TRUE),
              'url' 		=> $this->input->post('url', TRUE),
              'judul' 		=> $this->input->post('judul', TRUE),
              'parent_id'	=> $this->input->post('parent_id', TRUE)
            );

	        $this->akun->update(array("id_akun" => $this->input->post("id_pk")), $data);
	        echo json_encode(array("status" => TRUE));
			
		} else if ($param1=="edit") {
			$id = $this->input->post("id");
			$data = $this->akun->get_by_id($id);
        	echo json_encode($data);
		} else if ($param1=="hapus") {
			$id = $this->input->post("id");
			$this->akun->delete_by_id($id);
       		echo json_encode(array("status" => TRUE));
		} else if ($param1=="list") {
			$list = $this->akun->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	            $no++;
	            $row = array();
	            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_akun."'>";
	            $row[] = $no;
	            $row[] = $r->id_akun;
	            $row[] = $r->name;
	            $row[] = $r->url;
	            $row[] = $r->judul;
	            $row[] = $r->parent_name;
	            //add html for action
	            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_akun."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
	                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_akun."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
	 
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
				'main_akun' => $this->query_akun,
				'p'			=> 'admin/akun_view',
				'link1'		=> 'Admin',
				'link2'		=> 'akun',
			);
			$this->load->view("admin_view",$data);
		}
	}



}

/* End of file plan.php */
/* Location: ./application/controllers/plan.php */