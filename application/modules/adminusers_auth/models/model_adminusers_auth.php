<?php
class Model_adminusers_auth extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->groupID = $this->session->userdata('adminGroupsID');
	}
	
	
	function getTotal($table,$search1_parm,$search2_parm,$search3_parm)
	{
	
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.username',$search1_parm);
		}
		if($search2_parm != 'null' && !empty($search2_parm) )
		{
			$this->db->like($table.'.publish',$search2_parm);
		}
		if($search3_parm != 'null' && !empty($search3_parm) )
		{
			$this->db->like($table.'.adminusers_level_id',$search3_parm);
		}

		if($this->groupID <> 1){
			$this->db->where($table.".adminusers_level_id !=",1);
		}
		$this->db->select("COUNT(id) AS total");
		$query = $this->db->get($table);
		$r = $query->row();
		return $r->total;
	}
	
	
	function getList($table,$per_page,$lmt,$search1_parm,$search2_parm,$search3_parm)
	{
		
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.username',$search1_parm);
		}
		if($search2_parm != 'null' && !empty($search2_parm) )
		{
			$this->db->like($table.'.publish',$search2_parm);
		}
		if($search3_parm != 'null' && !empty($search3_parm) )
		{
			$this->db->like($table.'.adminusers_level_id',$search3_parm);
		}
		$this->db->select("adminusers_auth.*,adminusers_level.title,adminusers_level.publish AS pub,adminusers_level.create_date AS crt_date");
		$this->db->join("adminusers_level","adminusers_level.id=".$table.".adminusers_level_id");
		if($this->groupID <> 1){
			$this->db->where($table.".adminusers_level_id !=",1);
		}
		
		$this->db->order_by($table.".create_date","desc");
		$query = $this->db->get($table,$per_page,$lmt);
		return $query;
	}
	

	function getDetail($table,$id)
	{
		$this->db->select("adminusers_auth.*,adminusers_level.title,adminusers_level.publish AS pub,adminusers_level.create_date AS crt_date");
		$this->db->join("adminusers_level","adminusers_level.id=".$table.".adminusers_level_id");
		$this->db->where($table.'.id',$id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function checkUsername($table,$username,$id)
	{
		$this->db->where('id !=',$id);
		$this->db->where('username',$username);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	function getAccount($table,$id)
	{
		$this->db->select("adminusers_auth.*,adminusers_level.parent_id,adminusers_level.title,adminusers_level.publish AS pub,adminusers_level.create_date AS crt_date");
		$this->db->join("adminusers_level","adminusers_level.id=adminusers_auth.adminusers_level_id");
		$this->db->where("adminusers_auth.publish","Publish");
		$this->db->where($table.'.id',$id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function getParent($table,$id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function setUpdate($table,$id,$username,$email,$other_email,$password,$publish,$adminusers_level_id,$user_id)
	{
		$data = array(
			      'username'=>$username,
				  'email'=>$email,
				  'other_email'=>$other_email,
			      'password'=>$password,
			      'adminusers_level_id'=>$adminusers_level_id,
			      'publish'=>$publish,
			      'modify_user_id'=>$user_id,
			      'modify_date'=>date("Y-m-d :H:i:s",now())
			      );
		$this->db->where('id',$id);
		$this->db->update($table,$data);
	}
	
	
	function setInsert($table,$id,$username,$email,$other_email,$password,$publish,$adminusers_level_id,$user_id)
	{
		$data = array(
			      'username'=>$username,
				  'email'=>$email,
				  'other_email'=>$other_email,
			      'password'=>$password,
			      'adminusers_level_id'=>$adminusers_level_id,
			      'publish'=>$publish,
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
	
	function setFileUpload($file_image,$file_image_tmp,$file_image_old)
	{
		$this->load->library('image_moo');

 		$this->image_moo->load($file_image_tmp)->resize_crop(150,150)->save("./uploads/".$file_image);
   		
   			if(!$file_image)
			{
			 	$file_image = $file_image_old;
			}

			return $file_image;
	}
}
?>