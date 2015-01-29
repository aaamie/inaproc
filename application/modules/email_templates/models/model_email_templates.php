<?php
class model_email_templates extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getTotal($table,$search1_parm)
	{
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.subject',$search1_parm);
		}
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.content',$search1_parm);
		}
		
		
		$this->db->select("COUNT(id) AS total");
		$query = $this->db->get($table);
		$r = $query->row();
		return $r->total;
	}
	
	function getList($table,$per_page,$lmt,$search1_parm)
	{
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.subject',$search1_parm);
		}
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.content',$search1_parm);
		}
		
		$this->db->order_by($table.".create_date","desc");
		$query = $this->db->get($table,$per_page,$lmt);
		//die($this->db->last_query());
		return $query;
	}
	
	function getDetail($table,$id)
	{
		$this->db->where($table.'.id',$id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function setUpdate($table,$id,$title,$url,$content,$user_id)
	{
		
		
		$data = array(
			      'subject'=>$title,
				  'url'=>$url,
			      'content'=>$content,
			      'modify_user_id'=>$user_id,
			      );
		$this->db->where('id',$id);
		$this->db->update($table,$data);
	}
	
	function setInsert($table,$id,$title,$url,$content,$user_id)
	{

		$data = array(
			      'subject'=>$title,
				  'url'=>$url,
			      'content'=>$content,
			      'user_id'=>$user_id,
			      'create_date'=>date("Y-m-d :H:i:s",now())
			      );
		$this->db->insert($table,$data);
	}
	
	function setDelete($table,$id)
	{
		$status = 0;
		#select first
		$this->db->where('id',$id);
		$this->db->where('publish','Publish');
		$query = $this->db->get($table);
		if($query->num_rows() == 0){
			$this->db->where('id',$id);
			$this->db->delete($table);
			$status = 1;
		}
		return $status;
	}
	
	
}
?>