<?php
class model_aktivitas extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	function getTotal($table,$table_multi,$search1_parm,$search2_parm)
	{
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.title',$search1_parm);
		}
		
		if($search2_parm != 'null' && !empty($search2_parm) )
		{
			$this->db->where($table.'.publish',$search2_parm);
		}
		
		$this->db->select("COUNT(".$table.".akt_id) AS total");
		$query = $this->db->get($table);
		$r = $query->row();
		return $r->total;
	}
	
	function getList($table,$table_multi,$per_page,$lmt,$search1_parm,$search2_parm)
	{
		// if($search1_parm != 'null' && !empty($search1_parm) )
		// {
		// 	$this->db->like($table.'.audittype',$search1_parm);
		// }

		// if($search1_parm != 'null' && !empty($search1_parm) )
		// {
		// 	$this->db->like($table.'.audittype',$search2_parm);
		// }
	
		// if($search2_parm != 'null' && !empty($search2_parm) )
		// {
		// 	$this->db->where($table.'.publish',$search2_parm);
		// }
		
		
		$this->db->select("*");
		$this->db->order_by($table.".mtd_id","desc");
		$query = $this->db->get($table,$per_page,$lmt);
		return $query;
	}
	
	function getDetail($table,$id)
	{
		$this->db->where($table.'.akt_id',$id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function setUpdate($table,$post,$file_image_tmp,$file_image,$file_image_old)
	{
		
		if(!empty($file_image)){
			if(!empty($file_image_old)){
				$this->deleteFileUpload($file_image_old);
			}
			$file_image = $this->setFileUpload($file_image,$file_image_tmp,$file_image_old);
		}else{
			$file_image = $file_image_old;
		}

		$this->db->where('akt_id',$post['akt_id']);
		$this->db->update($table,$post);
		
	}
	
	function setInsert($table,$post,$file_image_tmp,$file_image,$file_image_old)
	{
		
		if(!empty($file_image)){
			$file_image = $this->setFileUpload($file_image,$file_image_tmp,$file_image_old);
		}
		
		$post['auditupdate'] = date("Y-m-d :H:i:s",now());
		unset($post['akt_id']);
		$this->db->insert($table,$post);

		$last_id = $this->db->insert_id();
		

		$this->session->set_flashdata('last_id',$last_id);

		return $last_id;

	}
	

	function setDelete($table,$id)
	{
		$status = 0;
		#select first
		// $this->db->where('akt_id',$id);
		// $this->db->where('publish','Publish');
		// $query = $this->db->get($table);
		// if($query->num_rows() == 0){
		
		// 	#delete images if having image
		// 	$this->db->where('akt_id',$id);
		// 	$q = $this->db->get($table);
		// 	$r = $q->row();
		// 	$file_image = $r->file_image;
		// 	if(!empty($file_image)){
		// 		if(file_exists("uploads/".$file_image)){ unlink("uploads/".$file_image); }
		// 		if(file_exists("uploads/thumbs/".$file_image)){ unlink("uploads/thumbs/".$file_image); }
		// 	}
		
		// 	$this->db->where('akt_id',$id);
		// 	$this->db->delete($table);

		// 	$status = 1;
		// }
		$this->db->where('akt_id',$id);
		$this->db->delete($table);

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