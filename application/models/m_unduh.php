<?php
class m_unduh extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit,$ref_id,$search=null){

		if($limit){
			$this->db->limit($limit);		
		}
		if($search){
			$this->db->like('title',$search);
			$this->db->like('content',$search);
		}
		$this->db->order_by('create_date','desc');
		$this->db->where('is_delete','0');
		$this->db->where('publish','publish');
		$this->db->where('ref_link_id',$ref_id);
		return $this->db->get('link');
	}

	function getDetail($id){

		$this->db->where('id',$id);		
		$this->db->where('is_delete','0');
		$this->db->where('publish','publish');
		return $this->db->get('link');
	}

	

	

}
?>