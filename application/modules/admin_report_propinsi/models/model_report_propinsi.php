<?php
class model_report_propinsi extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	function getTotal($table,$table_multi,$search1_parm,$search2_parm)
	{
		$table = "daftar_hitam";
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.propinsi_id',$search1_parm);
		}
		
		// if($search2_parm != 'null' && !empty($search2_parm) )
		// {
		// 	$this->db->where($table.'.publish',$search2_parm);
		// }
		
		$this->db->select("COUNT(".$table.".id) AS total");
		$this->db->where('is_delete','0');
		$this->db->group_by("propinsi_id");
		$query = $this->db->get($table);
		$r = $query->row();
		if(count($query->result()) > 0){
					return $r->total;			
		}
		return 0;
	}
	
	function getList($table,$table_multi,$per_page,$lmt,$search1_parm,$search2_parm)
	{
		$table = "daftar_hitam";
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.propinsi_id',$search1_parm);
		}

		// if($search1_parm != 'null' && !empty($search1_parm) )
		// {
		// 	$this->db->like($table.'.audittype',$search2_parm);
		// }
	
		// if($search2_parm != 'null' && !empty($search2_parm) )
		// {
		// 	$this->db->where($table.'.publish',$search2_parm);
		// }
		
		
		$this->db->select("propinsi_id,count(propinsi_id) as total");
		$this->db->where('is_delete','0');
		$this->db->order_by($table.".create_date","desc");
		$this->db->group_by("propinsi_id");
		$query = $this->db->get($table,$per_page,$lmt);
		return $query;
	}
	
	function getDetail($table,$id)
	{
		$this->db->where($table.'.id',$id);
		$this->db->where('is_delete','0');
		$query = $this->db->get($table);
		return $query;
	}
	
	function setUpdate($table,$post,$file_image_tmp,$file_image,$file_image_old)
	{
		
		// if(!empty($file_image)){
		// 	if(!empty($file_image_old)){
		// 		$this->deleteFileUpload($file_image_old);
		// 	}
		// 	$file_image = $this->setFileUpload($file_image,$file_image_tmp,$file_image_old);
		// }else{
		// 	$file_image = $file_image_old;
		// }
		$post['user_id'] 	 = $this->session->userdata('adminID');
		$post['modify_date'] = date('Y-m-d H:i:s');

		# write logs
		$postLogs = $post['logs'];
		unset($post['logs']);
		$newlogs[]=$post;
		if($postLogs && $postLogs!='null'){
			$oldlogs = json_decode($postLogs,true);
			$mergeLogs = array_merge($oldlogs,$newlogs);
			$post['logs'] = json_encode($mergeLogs);
		}else{
			$post['logs'] = json_encode($newlogs);
		}
		# write logs

		$this->db->where('id',$post['id']);
		$this->db->update($table,$post);
		
	}
	
	function setInsert($table,$post,$file_image_tmp,$file_image,$file_image_old)
	{
		
		// if(!empty($file_image)){
		// 	$file_image = $this->setFileUpload($file_image,$file_image_tmp,$file_image_old);
		// }
		
		$post['create_date'] = date("Y-m-d :H:i:s",now());
		unset($post['id']);
		$this->db->insert($table,$post);

		$last_id = $this->db->insert_id();
		

		$this->session->set_flashdata('last_id',$last_id);

		return $last_id;

	}
	

	function setDelete($table,$id)
	{
		$status = 0;

		$this->db->where('id',$id);
		$data['user_id'] = $this->session->userdata('adminID');
		$data['is_delete']  = '1';
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->update($table,$data);


		$status = 1;
		return $status;
	}
	
	function setFileUpload($file_image,$file_image_tmp,$file_image_old)
	{
		$d = date("Ymdhis");
		$file_image = $d.$file_image;
		$this->load->library('image_moo');
		
		list($w, $h) = getimagesize($file_image_tmp);
		if($w > $h){
			$w = 800;
			$h = 280;
		}else{
			$w = 300;
			$h = 280;
		}
								
 		$this->image_moo->load($file_image_tmp)->resize_crop($w,$h)->save("./uploads/".$file_image);
		$this->image_moo->load($file_image_tmp)->resize_crop(100,100)->save("./uploads/thumbs/".$file_image);
   		
   		if(!$file_image)
		{
			 	$file_image = $file_image_old;
		}

		return $file_image;
	}
	
	
	function deleteFileUpload($file_image)
	{
		if(file_exists("uploads/".$file_image)){ unlink("uploads/".$file_image); }
		if(file_exists("uploads/thumbs/".$file_image)){ unlink("uploads/thumbs/".$file_image); }
	}

}
?>