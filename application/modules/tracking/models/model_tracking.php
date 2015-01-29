<?php
class Model_tracking extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getList($table,$registered_number)
	{
		$jn1 = "customers";
		
		$this->db->where($table.'.registered_number',$registered_number);		
		$this->db->select($table.".*,
						  ".$jn1.".company,
						  ".$jn1.".publish AS pub,
						  ".$jn1.".user_id AS us_id,
						  ".$jn1.".modify_user_id AS mo_us_id,
						  ".$jn1.".modify_date AS mo_date,
						  ".$jn1.".create_date AS crt_date"
						  );
		$this->db->join($jn1,$jn1.".id=".$table.".customer_id");
		$query = $this->db->get($table);

		return $query;
	}
}
?>