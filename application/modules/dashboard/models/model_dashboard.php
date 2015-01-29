<?php
class model_dashboard extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getMaxCustomers($table)
	{
		$this->db->select("SUM(total_manifest) AS total,(SELECT company FROM tbl_customers WHERE tbl_customers.id = customer_id) AS company");
		$this->db->group_by("customer_id");
		$this->db->order_by("total","desc");
		$this->db->limit(5);
		$q = $this->db->get($table);
		return $q;
	}
	
	
	function getMaxCustomersOrder($table)
	{
		$this->db->select("SUM(total_manifest) AS total,(SELECT company FROM tbl_customers WHERE tbl_customers.id = customer_id) AS company");
		$this->db->group_by("customer_id");
		$this->db->order_by("total","asc");
		$this->db->limit(5);
		$q = $this->db->get($table);
		return $q;
	}
	
	function getMonthlyOrder($table,$year,$month)
	{
		#total manifest
		$this->db->select("SUM(tbl_".$table.".total_manifest) AS total");
		$this->db->where("YEAR(tbl_".$table.".create_date) = '".$year."'");
		$this->db->where("MONTH(tbl_".$table.".create_date) = '".$month."'");
		$q = $this->db->get($table);
		$r = $q->row();
		$total = $r->total != NULL ? $r->total : 0;
		
		return $total;
	}
	
	function getMonthlySales($table,$year,$month)
	{
		#total manifest
		$this->db->select("SUM(tbl_".$table.".total_amount) AS total");
		$this->db->where("YEAR(tbl_".$table.".create_date) = '".$year."'");
		$this->db->where("MONTH(tbl_".$table.".create_date) = '".$month."'");
		$this->db->where($table.".status","Paid");
		$q = $this->db->get($table);
		$r = $q->row();
		$total = $r->total != NULL ? $r->total : 0;
		
		return $total;
	}
	
	function getTotalTodayManifest($table,$status)
	{
		$this->db->select("COUNT(tbl_".$table.".id) AS total");
		$this->db->where("status",$status);
		$this->db->where("(DATE(create_date) = CURRENT_DATE() OR DATE(modify_date) = CURRENT_DATE())");
		$query = $this->db->get($table);
		$r = $query->row();
		return $r->total != NULL ? $r->total : 0;
	}
	
	function getTotalTodayManifestAlert($table,$status)
	{
		$this->db->select("COUNT(tbl_".$table.".id) AS total");
		$this->db->where("status",$status);
		$this->db->where("(CURRENT_DATE() < DATE_SUB(exp_date, INTERVAL 7 DAY) OR CURRENT_DATE() = DATE_SUB(exp_date, INTERVAL 7 DAY) OR CURRENT_DATE() = DATE_SUB(exp_date, INTERVAL 3 DAY) OR CURRENT_DATE() = DATE_SUB(exp_date, INTERVAL 2 DAY))");
		$query = $this->db->get($table);
		$r = $query->row();
		return $r->total != NULL ? $r->total : 0;
	}
	
	function getTotalCustOrderManifest()
	{
		$this->db->select("COUNT(id) AS total");
		$this->db->where("publish","Publish");
		$query = $this->db->get("customers");
		$r = $query->row();
		$tot_customer = $r->total != NULL ? $r->total : 0;
		
		$this->db->select("COUNT(id) AS total");
		$query = $this->db->get("customer_manifest");
		$rm = $query->row();
		$tot_order = $rm->total != NULL ? $rm->total : 0;
		
		$this->db->select("SUM(total_manifest) AS total");
		$qr = $this->db->get("customer_manifest");
		$rt = $qr->row();
		$tot_manifest = $rt->total != NULL ? $rt->total : 0;
		
		return compact('tot_customer','tot_order','tot_manifest');
	}
}
?>