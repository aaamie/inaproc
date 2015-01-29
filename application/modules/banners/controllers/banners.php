<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class banners extends MX_Controller  {
	
	var $table = "banners";
	var $table_alias = "Banners";
	var $uri_page = 6;
	var $per_page = 25;
	 
	function __construct()
	{
		parent::__construct();
		$this->load->model($this->table."/model_".$this->table, $this->table);
		$this->lang->load('elemen_layout', 'indonesia');
	}
	
	public function setheader()
	{
		return Modules::run('layout/setheader');
	}

	public function setfooter()
	{
		return Modules::run('layout/setfooter');
	}
	 
	public function auth()
	{
		return Modules::run('auth/privateAuth');
	}
	
	public function forbiddenAuth()
	{
		return Modules::run('auth/forbiddenAuth');
	}
	
	function index()
	{
		$this->auth();
		$this->forbiddenAuth();
		$this->grid();
	}


	function grid()
	{
		$this->setheader();		
		$links = $this->grid_content();

		$data = array(
				  'admin_url' => base_url(),
				  'contents' => $links,
				  );
		$this->parser->parse('layout/contents.html', $data);
		
		$this->setfooter();
	}
	
	
	
	function grid_content()
	{	
		#search
		$sch1_parm = rawurldecode($this->uri->segment(3));
		$sch1_parm = $sch1_parm != 'null' && !empty($sch1_parm) ? $sch1_parm : 'null';
		$sch1_val = $sch1_parm != 'null' ? $sch1_parm : '';

		$sch2_parm = rawurldecode($this->uri->segment(4));
		$sch2_parm = $sch2_parm != 'null' && !empty($sch2_parm) ? $sch2_parm : 'null';
		$sch2_arr = array("Not Publish"=>"Not Publish","Publish"=>"Publish");
		$sch2_select_arr = array($sch2_parm);
		$ref2 = Modules::run('widget/getStaticDropdown',$sch2_arr,$sch2_select_arr,2);
		
		
		$sch_path = rawurlencode($sch1_parm)."/".rawurlencode($sch2_parm);
		#end search

		#paging
		$get_page = $this->uri->segment(5);
		$uri_segment = $this->uri_page;
		$pg = $this->uri->segment($uri_segment);
		$per_page = !empty($get_page) ? $get_page : $this->per_page;
		$no = $go_pg = !$pg ? 0 : $pg;

		if(!$pg)
		{
			$lmt = 0;
			$pg = 1;
		}else{
			$lmt = $pg;
		}
		$path = base_url().$this->table."/pages/".$sch1_parm."/".$sch2_parm."/".$per_page;
		$jum_record = $this->banners->getTotal($this->table,"ref_banners",$sch1_parm,$sch2_parm);
		$paging = Modules::run("widget/page",$jum_record,$per_page,$path,$uri_segment);
		if(!$paging) $paging = "";
		$display_record = $jum_record > 0 ? "" : "display:none;";
		#end paging
		
		#record
		$query = $this->banners->getList($this->table,"ref_banners",$per_page,$lmt,$sch1_parm,$sch2_parm);
		$list = array();
		if($query->num_rows() > 0){
			foreach($query->result() as $r)
			{
				$no++;

				$title = $r->title;
				$title = highlight_phrase($title, $sch1_parm, '<span style="color:#990000">', '</span>');
				$publish = $r->publish == "Publish" ? "icon-ok-sign" : "icon-minus-sign";
				$create_date = date("d/m/Y H:i",strtotime($r->create_date));
				$link = $r->link;

				$list[] = array(
								"no"=>$no,
								"id"=>$r->id,
								"title" =>$title,	
								"link" => $link,						
								"publish"=>$publish,
								"create_date"=>$create_date
								);
			}
		}	
		#end record
	
		$data = array(
				  'admin_url' => base_url(),
				  'paging'=>$paging,
				  'list'=>$list,
				  'jum_record'=>$jum_record,
				  'display_record'=>$display_record,
				  'sch1_parm'=>$sch1_parm,
				  'sch1_val'=>$sch1_val,
				  'sch2_parm'=>$sch2_parm,			  				  
				  'ref2'=>$ref2,
				  'sch_path'=>$sch_path,
				  'per_page'=>$per_page,
				  'pg'=>$go_pg,
				   'title_head'=>ucfirst(str_replace('_',' ',$this->table_alias)),
				  'title_link'=>$this->table
				  );
		return $this->parser->parse("list.html", $data, TRUE);
	}
	
	function search()
	{
		$sch1 = rawurlencode($this->input->post('sch1'));
		$sch2 = rawurlencode($this->input->post('ref2'));				
		$per_page = rawurlencode($this->input->post('per_page'));
		
		$sch1 = empty($sch1) ? 'null' : $sch1;
		$sch2 = empty($sch2) ? 'null' : $sch2;
		
		redirect($this->table."/pages/".$sch1."/".$sch2."/".$per_page);
	}
	
	
	function edit()
	{
		$this->setheader();		
		$id = $this->uri->segment(3);
		$links = $this->edit_content($id);

		$add_edit = $id == 0 ? "Add" : "Edit";
		
		$data = array(
				  'admin_url' => base_url(),
				  'contents' => $links,		  			  
				  'add_edit' => $add_edit
				  );
		$this->parser->parse('layout/contents.html', $data);
		
		$this->setfooter();
	}
	
	
	
	function edit_content($id)
	{
		$number = 0;
		$file_image = "";
		
		if(is_numeric($id)){
			
			#set asset
			$ref2_arr = array("Not Publish"=>"Not Publish","Publish"=>"Publish");
			
			#record
			$q = $this->banners->getDetail($this->table,$id);
			$list = array();
			if($q->num_rows() > 0){
				foreach($q->result() as $r){
					
					#image
					if($r->file_image)
					{
						$file_image = "
						<a href='".base_url()."uploads/".$r->file_image."' rel='facebox'><img src='".base_url()."uploads/thumbs/".$r->file_image."' class='thumbnail'></a>
						<br/>
						<a href='".base_url()."admin_".$this->table."/unlink/".$r->id."/".rawurlencode($r->file_image)."' class='btn'>delete</a><br/>
						<input type='hidden' name='file_image_old' value='".$r->file_image."' id='file_image_old'>";
					}
					#end image
					
					#ref dropdown no multi value
					$ref2_select_arr[0] = $this->session->flashdata("ref2") ? $this->session->flashdata("ref2") : $r->publish;
					$ref2 = Modules::run('widget/getStaticDropdown',$ref2_arr,$ref2_select_arr,2);
					#end ref dropdown no multi value
					
					$title = $this->session->flashdata("title") ? $this->session->flashdata("title") : $r->title;
					$link = $this->session->flashdata("link") ? $this->session->flashdata("link") : $r->link;

					$list[] = array(
									"id"=>$r->id,
									"title"=>$title,
									"link"=>$link,
									"file_image"=>$file_image,
									"ref2"=>$ref2,
									"create_date"=>$r->create_date
									);
				}
			}else{
				
				
				#ref dropdown no multi value
				$ref2_select_arr[0] = $this->session->flashdata("ref2") ? $this->session->flashdata("ref2") : null;
				$ref2 = Modules::run('widget/getStaticDropdown',$ref2_arr,$ref2_select_arr,2);
				#end ref dropdown no multi value
				
				$title = $this->session->flashdata("title") ? $this->session->flashdata("title") : "";
				$link = $this->session->flashdata("link") ? $this->session->flashdata("link") : "";
					
				$list[] = array(
									"id"=>0,
									"title"=>$title,
									"link"=>$link,
									"file_image"=>"",
									"ref2"=>$ref2,
									"create_date"=>""
									);
			}
			#end record
	
			#notification
			$err = $this->session->flashdata("err") ? $this->session->flashdata("err") : "";
			$success = $this->session->flashdata("success") ? $this->session->flashdata("success") : "";
			$notif = array();
			$btn_plus = "display:none;";
			if(!empty($success)){
				$btn_plus = "";
				$notif[] = array(
									"notif_title"=>$success,
									"notif_class"=>"warning fade in"
									);
			}else if(!empty($err)){
				$notif[] = array(
									"notif_title"=>$err,
									"notif_class"=>"alert-message error fade in"
									);
			}
			#end notification
		
			$data = array(
					  'base_url' => base_url(),
					  'admin_url' => base_url(),
					  'notif'=>$notif,
					  'btn_plus'=>$btn_plus,
					  'list'=>$list,
					  'title_head'=>ucfirst(str_replace('_',' ',$this->table_alias)),
				 	  'title_link'=>$this->table
					  );
			return $this->parser->parse("edit.html", $data, TRUE);
		}else{
			redirect($this->table);
		}
	}
	
	function submit()
	{
		$err = "";
		$title = strip_tags($this->input->post("title"));
		$link = $this->input->post("link");

		$ref2 = $this->input->post("ref2");
			
		$ordered = $this->input->post("ordered");
		$user_id = $this->session->userdata('adminID');
		$id = strip_tags($this->input->post("id"));

		# The image
		$file_image_old = strip_tags($this->input->post("file_image_old"));
		$file_image_name = $_FILES["file"]["name"];
		$file_image_tmp  = $_FILES["file"]["tmp_name"];
		# End the image
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("err",validation_errors());
			$this->session->set_flashdata("title",$title);
			$this->session->set_flashdata("link",$link);
			$this->session->set_flashdata("ref2",$ref2);
			redirect($this->table."/edit/".$id);
		}else{
			if($id > 0)
			{
				$this->banners->setUpdate($this->table,"ref_banners",$id,$title,$link,$ref2,$user_id,$file_image_tmp,$file_image_name,$file_image_old);
				$this->session->set_flashdata("success","Data saved successful");
				redirect($this->table."/edit/".$id);
			}else{
				$id_term = $this->banners->setInsert($this->table,"ref_banners",$id,$title,$link,$ref2,$user_id,$file_image_tmp,$file_image_name,$file_image_old);
				$last_id = $this->db->insert_id();
				
				$this->session->set_flashdata("success","Data inserted successful");
				redirect($this->table."/edit/".$id_term);
			}
		}
	}
	
	function delete($id=0)
	{
		$del_status = $this->banners->setDelete($this->table,$id);
		$response['id'] = $id;
		$response['status'] = $del_status;
		echo $result = json_encode($response);
		exit();
	}
	
	function unlink($id,$file_image)
	{
		$file_image = rawurldecode($file_image);
	
		$this->db->where("id",$id);
		$this->db->update($this->table,array("file_image"=>""));
		
		if(file_exists("uploads/".$file_image)){ unlink("uploads/".$file_image); }
		if(file_exists("uploads/thumbs/".$file_image)){ unlink("uploads/thumbs/".$file_image); }
		redirect($this->table."/edit/".$id);
	}

	function getTitle($id)
	{
		$title = "";
		$q = $this->contents->getDetail($this->table,$id)->row_array();
		if($q){
			$title['title'];
		}
		return $title;
	}
	
	function getRefDropdown($id,$name,$type=NULL)
	{
	
		$q = $this->banners->getList($this->table,null,null,null);
		$list = array();
		foreach ($q->result() as $val) {
			$selected = $val->id == $id ? $selected = "selected='selected'" : "";	
			$list[]= array(
						'id' => $val->id,
						'title'=>$val->title,
						"selected"=>$selected
					 );
		}
		$data = array(
				"list"=>$list,
				"name"=>"ref".$name
				);
		return $this->parser->parse("layout/ref_dropdown".$type.".html", $data, TRUE);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */