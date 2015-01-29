<?php
class model_daftar_hitam extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	function getTotal($table,$table_multi,$search1_parm,$search2_parm)
	{
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.nama_penyedia',$search1_parm);
		}
		
		// if($search2_parm != 'null' && !empty($search2_parm) )
		// {
		// 	$this->db->where($table.'.publish',$search2_parm);
		// }
		
		$this->db->select("COUNT(".$table.".id) AS total");
		$this->db->where('is_delete','0');
		$query = $this->db->get($table);
		$r = $query->row();
		return $r->total;
	}
	
	function getList($table,$table_multi,$per_page,$lmt,$search1_parm,$search2_parm)
	{
		if($search1_parm != 'null' && !empty($search1_parm) )
		{
			$this->db->like($table.'.nama_penyedia',$search1_parm);
		}

		// if($search1_parm != 'null' && !empty($search1_parm) )
		// {
		// 	$this->db->like($table.'.audittype',$search2_parm);
		// }
	
		// if($search2_parm != 'null' && !empty($search2_parm) )
		// {
		// 	$this->db->where($table.'.publish',$search2_parm);
		// }
		
		
		$this->db->select("*");
		$this->db->where('is_delete','0');
		$this->db->order_by($table.".create_date","desc");
		$query = $this->db->get($table,$per_page,$lmt);
		return $query;
	}
	
	function getDetail($table,$id)
	{
		$this->db->where($table.'.id',$id);
		$this->db->where('is_delete','0');
		$query = $this->db->get($table);
		//die(''.$this->db->last_query());
		return $query;
	}
	
	function setUpdate($table,$post,$file_image_tmp,$file_image,$file_image_old,$rekanid)
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
		
		if(!empty($rekanid)){
			//print_r($rekanid);die();
			
			foreach($rekanid as $rknid){
				$data = array(
							"id_daftarhitam"=>$post['id'],
							"rkn_id"=>$rknid,
							"user_insert"=>$this->session->userdata('adminID')
				);
				
				$this->db->where(array("id_daftarhitam"=>$post['id'],"rkn_id"=>$rknid));
				$q = $this->db->get("blacklist");
				$check = $q->row();
				
				if($q->num_rows()>0){
					$du["status"] = 1;
					$du["user_delete"] = NULL;
					$du["deleted_date"] = NULL;
					$this->db->where(array("id_daftarhitam"=>$post['id'],"rkn_id"=>$check->rkn_id));
					$this->db->update("blacklist",$du);
					
					if(!in_array($check->rkn_id,$rekanid)){
						$this->db->insert("blacklist",$data);
					}
				}else{
					$this->db->insert("blacklist",$data);
				}
			}
		}
	}
	
	function setInsert($table,$post,$file_image_tmp,$file_image,$file_image_old,$rknid)
	{
		
		// if(!empty($file_image)){
		// 	$file_image = $this->setFileUpload($file_image,$file_image_tmp,$file_image_old);
		// }
		
		$post['create_date'] = date("Y-m-d :H:i:s",now());
		unset($post['id']);
		$this->db->insert($table,$post);

		$last_id = $this->db->insert_id();
		if(!empty($rknid)){
			foreach($rknid as $rknids){
				$data = array(
							"id_daftarhitam"=>$last_id,
							"rkn_id"=>$rknids,
							"user_insert"=>$this->session->userdata('adminID')
				);
				$this->db->insert("blacklist",$data);
			}
		}
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

		//delete blacklist username ~ by : Dhima Tauvik Ariezha
		$this->db->where('id_daftarhitam',$id);
		$databl['user_delete'] = $this->session->userdata('adminID');
		$databl['status']  = '2';
		$databl['deleted_date'] = date('Y-m-d H:i:s');
		$this->db->update("blacklist",$databl);

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
	
	function getBlacklist($param="",$id=""){
		if(!empty($param)){
			if($id==1){
				$this->db->like("name",$param);
			}elseif($id==2){
				$this->db->like("npwp",$param);
				$this->db->or_like("rkn_npwp",$param);
			}
			
			$data = $this->db->get("auth_login");
			if(count($data->result())>0){
				$result = $data->result_array();
			}else{
				$result = "No Data Found";
			}
		}else{
			$result = "Maaf anda tidak berhak mengakses halaman ini";
		}
		return $result;
	}
	
	function viewBlacklist($id=""){
		$data = $this->db->query("CALL blacklisted($id)");
		$result = $data->result_array();
			
		return $result;
	}
	
	function setDeleteBl($id,$iddh)
	{
		$status = 0;

		//delete blacklist username ~ by : Dhima Tauvik Ariezha
		$this->db->where(array('id_daftarhitam'=>$iddh,'rkn_id'=>$id));
		$databl['user_delete'] = $this->session->userdata('adminID');
		$databl['status']  = '2';
		$databl['deleted_date'] = date('Y-m-d H:i:s');
		$res = $this->db->update("blacklist",$databl);
		
		if($res){
			$status = 1;
		}else{
			$status = "gagal";
		}
		
		return $status;
	}

}
?>