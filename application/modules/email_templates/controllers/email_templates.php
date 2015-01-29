<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_templates extends MX_Controller  {
	
	var $table = "email_templates";		
	var $table_alias = "Email Templates";
	var $uri_page = 5;
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
		$contents = $this->grid_content();
	
		$data = array(
				  'admin_url' => base_url(),
				  'contents' => $contents,
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

		$sch_path = rawurlencode($sch1_parm);
		#end search
		

		#paging
		$get_page = $this->uri->segment(4);
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
		$path = base_url().$this->table."/pages/".$sch1_parm."/".$per_page;
		$jum_record = $this->email_templates->getTotal($this->table,$sch1_parm);
		$paging = Modules::run("widget/page",$jum_record,$per_page,$path,$uri_segment);
		if(!$paging) $paging = "";
		$display_record = $jum_record > 0 ? "" : "display:none;";
		#end paging
		
		#record
		$query = $this->email_templates->getList($this->table,$per_page,$lmt,$sch1_parm);
		$list = array();
		if($query->num_rows() > 0){
			foreach($query->result() as $r)
			{
				$no++;
				
				$title = $r->subject;
				$title = highlight_phrase($title, $sch1_parm, '<span style="color:#990000">', '</span>');
				$content  = highlight_phrase(strip_tags(word_limiter($r->content,10)), $sch1_parm, '<span style="color:#990000">', '</span>');
				$create_date = date("d/m/Y H:i",strtotime($r->create_date));
				
				$list[] = array(
								 "no"=>$no,
								 "id"=>$r->id,
								 "title" =>$title,
								 "url" =>$r->url,
								 "content"=>$content,
								 "create_date"=>$create_date
								);
			}
		}	
		#end record
	
		$data = array(
				  'base_url' => base_url(),
				  'admin_url' => base_url(),
				  'paging'=>$paging,
				  'list'=>$list,
				  'jum_record'=>$jum_record,
				  'display_record'=>$display_record,
				  'sch1_parm'=>$sch1_parm,
				  'sch1_val'=>$sch1_val,			  				  
				  'sch_path'=>$sch_path,
				  'per_page'=>$per_page,
				  'pg'=>$go_pg,
				  'title_head'=>ucwords(str_replace("_","",$this->table_alias)),
				  'title_link'=>$this->table
				  );
		return $this->parser->parse("list.html", $data, TRUE);
	}
	
	function search()
	{
		$sch1 = rawurlencode($this->input->post('sch1'));
		$per_page = rawurlencode($this->input->post('per_page'));
		
		if(empty($sch1))
		{
			$sch1 = 'null';
		}

		redirect($this->table."/pages/".$sch1."/".$per_page);
	}
	
	
	function edit()
	{
		$this->setheader();		
		$id = $this->uri->segment(3);
		$contents = $this->edit_content($id);

		$add_edit = $id == 0 ? "Add" : "Edit";
		
		$data = array(
				  'admin_url'=>base_url(),
				  'base_url' => base_url(),
				  'contents'=>$contents,
				  'add_edit'=>$add_edit
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
			
			$q = $this->email_templates->getDetail($this->table,$id);
			$list = $list_term_option = array();
			if($q->num_rows() > 0){
				foreach($q->result() as $r){
				
					$title = $this->session->flashdata("title") ? $this->session->flashdata("title") : $r->subject;
					$url = $this->session->flashdata("url") ? $this->session->flashdata("title") : $r->url;
					$content = $this->session->flashdata("content") ? $this->session->flashdata("content") : $r->content;
					
		

					$list[] = array(
									"id"=>$r->id,
									"title"=>$title,
									"url"=>$url,
									"content"=>$r->content,
									"create_date"=>$r->create_date
									);
				}
			}else{
				
				$title = $this->session->flashdata("title") ? $this->session->flashdata("title") : "";
				$url = $this->session->flashdata("url") ? $this->session->flashdata("title") : "";
				$content = $this->session->flashdata("content") ? $this->session->flashdata("content") : "";
				
				#ref dropdown multi value
				$ref2 = Modules::run('widget/getStaticDropdown',$ref2_arr,null,2);
				#end ref dropdown multi value


				$list[] = array(
									"id"=>0,
									"title"=>$title,
									"url"=>$url,
									"content"=>"",
									"create_date"=>""
									);
			}

	
			#notification
			$err = $this->session->flashdata("err") ? $this->session->flashdata("err") : "";
			$success = $this->session->flashdata("success") ? $this->session->flashdata("success") : "";
			$notif = array();
			$btn_plus = "display:none;";
			if(!empty($success)){
				$btn_plus = "";
				$notif[] = array(
									"notif_title"=>$success,
									"notif_class"=>"success fade in"
									);
			}else if(!empty($err)){
				$notif[] = array(
									"notif_title"=>$err,
									"notif_class"=>"alert-message error fade in"
									);
			}
			#end notification
		
			$data = array(
					  'admin_url' => base_url(),
					  'base_url' => base_url(),
					  'notif'=>$notif,
					  'btn_plus'=>$btn_plus,
					  'list'=>$list,
					  'title_head'=>ucwords(str_replace('_',' ',$this->table_alias)),
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
		$url = strip_tags($this->input->post("url"));
		$content = $this->input->post("content");
		$ordered = $this->input->post("ordered");
		$user_id = $this->session->userdata('adminID');
		$id = strip_tags($this->input->post("id"));
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('url', 'url', 'required');
		$this->form_validation->set_rules('content', 'content', 'required');
		if ($this->form_validation->run($this) == FALSE)
		{
			$this->session->set_flashdata("err",validation_errors());
			$this->session->set_flashdata("title",$title);
			$this->session->set_flashdata("url",$url);
			$this->session->set_flashdata("content",$content);
			redirect($this->table."/edit/".$id);
		}else{
			if($id > 0)
			{
				$this->email_templates->setUpdate($this->table,$id,$title,$url,$content,$user_id);
				$this->session->set_flashdata("success","Data saved successful");
				redirect($this->table."/edit/".$id);
			}else{
				$id_term = $this->email_templates->setInsert($this->table,$id,$title,$url,$content,$user_id);
				$last_id = $this->db->insert_id();
				
				$this->session->set_flashdata("success","Data inserted successful");
				redirect($this->table."/edit/".$last_id);
			}
		}
	}
	
	function delete($id=0)
	{
		$del_status = $this->email_templates->setDelete($this->table,$id);
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
		$q = $this->email_templates->getDetail($this->table,$id)->row_array();
		if($q){
			$title['title'];
		}
		return $title;
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */