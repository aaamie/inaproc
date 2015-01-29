<?php
class m_ref_news extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit){

		if($limit){
			$this->db->limit($limit);		
		}
		$this->db->order_by('order','asc');
		$this->db->where('is_delete','0');
		$this->db->where('publish','publish');
		return $this->db->get('ref_news');
	}

	

	

	

}
?>