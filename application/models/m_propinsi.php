<?php
class m_propinsi extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit){

		if($limit){
			$this->db->limit($limit);		
		}
		$this->db->order_by('create_date','desc');
		$this->db->where('publish','publish');
		return $this->db->get('propinsi');
	}


}
?>