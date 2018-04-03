<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	public function getMenu($param1="") {
		if ($param1=="") {
			$this->db->where('parent_id',0);
			$this->db->where('enable',"aktif");
		} else {
			$this->db->where('parent_id',$param1);
			$this->db->where('enable',"aktif");
		}
		$this->db->order_by("order","asc");
		return $this->db->get("menu");
	}
	public function getBedById($id_kamar) {
		$this->db->where('id_kamar',$id_kamar);
		return $this->db->get('m_bed');
	}
	public function getKelasById($id_paviliun) {
		$sql = "SELECT
			*, 
			SUM(IF(m_bed. STATUS = '0', 1, 1)) AS tersedia,
			SUM(IF(m_bed. STATUS = '1', 1, 0)) AS terisi
		FROM
			`m_kamar`
		JOIN m_bed ON m_kamar.id_kamar = m_bed.id_kamar
		WHERE
			id_paviliun = '".$id_paviliun."'
		GROUP BY
			m_kamar.kelas
		ORDER BY
			m_kamar.id_kamar DESC";
		return $this->db->query($sql);
	}

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */