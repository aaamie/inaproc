<?php
class m_content extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}


	function getDetail($id){

		$this->db->where('id',$id);
		return $this->db->get('contents');
	}


	

}
?>