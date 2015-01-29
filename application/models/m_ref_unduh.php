<?php
class m_ref_unduh extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit,$id=null){

		if($limit){
			$this->db->limit($limit);		
		}

		if($id){
			$this->db->where('id',$id);
		}
		$this->db->where('is_delete','0');
		$this->db->order_by('order','asc');
		$this->db->where('publish','publish');
		return $this->db->get('ref_link');
	}

	

	

	

}
?>