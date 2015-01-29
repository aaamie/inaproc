<?php
class m_daftarhitam extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit,$offset='',$propinsi_id='',$search=''){

		if($limit){
			$this->db->limit($limit,$offset);		
		}

		if($propinsi_id){
			$this->db->where('propinsi_id',$propinsi_id);
		}
		if($search && $search!='null'){
			$this->db->like('sk',$search);
			$this->db->or_like('nama_penyedia',$search);
			$this->db->or_like('npwp',$search);
			$this->db->or_like('alamat',$search);
			$this->db->or_like('direktur',$search);
			$this->db->or_like('alasan_terdaftar',$search);
		}

		$this->db->where('is_delete','0');
		$this->db->order_by('create_date','desc');
		return $this->db->get('daftar_hitam');
	}

	function getListGroupSk($npwp){

		if($npwp){
			$this->db->where('npwp',$npwp);
		}

		$this->db->order_by('create_date','desc');
		return $this->db->get('daftar_hitam');
	}

	function getDetail($id){

		$this->db->where('id',$id);
		$this->db->where('is_delete','0');
		return $this->db->get('daftar_hitam');
	}

	

}
?>