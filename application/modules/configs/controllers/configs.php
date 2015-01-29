<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class configs extends MX_Controller  {
	
	var $table = "configs";
	var $table_alias = "Settings";
	var $uri_page = 4;
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
		$this->edit();
	}
	
	function edit()
	{
		$this->setheader();		
		$id = 1;
		$contents = $this->edit_content($id);
		$add_edit = $id == 0 ? "Add" : "Edit";
		$data = array(
				  'admin_url'=>base_url(),
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
			
			$q = $this->configs->getDetail($this->table,$id);
			$list = $list_term_option = array();
			if($q->num_rows() > 0){
				foreach($q->result() as $r){
					
					$checked1 = $checked2 = '';
					if($r->show_lpse=='all'){
						$checked1='checked';
					}else{
						$checked2='checked';
					}

					$list[] = array(
									"id"=>$r->id,
									"meta_title"=>$r->meta_title,
									"meta_keyword"=>$r->meta_keyword,
									"meta_description"=>$r->meta_description,
									"meta_author"=>$r->meta_author,
									"email"=>$r->email,
									"password"=>$r->password,
									"create_date"=>$r->create_date,
									"file_name"=>$r->file_name,
									"adp_api_url"=>$r->adp_api_url,
									"hour_cron"=>$r->hour_cron,
									"checked1"=>$checked1,
									"checked2"=>$checked2
									);
				}
			}else{
				
				$list[] = array(
									"id"=>0,
									"meta_title"=>"",
									"meta_keyword"=>"",
									"meta_description"=>"",
									"meta_author"=>"",
									"email"=>"",
									"password"=>"",
									"create_date"=>"",
									"adp_api_url"=>"",
									"display"=>"display:none;",
									"hour_cron"=>""
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
					  'base_url' => base_url(),
					  'admin_url'=>base_url(),
					  'notif'=>$notif,
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
		$meta_title = strip_tags($this->input->post("meta_title"));
		$meta_keyword = strip_tags($this->input->post("meta_keyword"));
		$meta_description = strip_tags($this->input->post("meta_description"));
		$meta_author = strip_tags($this->input->post("meta_author"));
		$email = $this->input->post("email");
		$show_lpse = $this->input->post("show_lpse");
		$hour_cron = $this->input->post("hour_cron");
		$adp_api_url = $this->input->post('adp_api_url');
		$password = $this->input->post("password");
		$publish = "";
		$user_id = $this->session->userdata('adminID');
		$id = strip_tags($this->input->post("id"));

	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		$this->form_validation->set_rules('meta_keyword', 'meta keyword', 'required');
		$this->form_validation->set_rules('meta_description', 'meta description', 'required');
		$this->form_validation->set_rules('meta_author', 'meta author', 'required');

		# The image
		//$file_image_old = $file_image_name = $file_image_tmp = "";
		$file_image_old = strip_tags($this->input->post("file_image_old"));
		$file_image_name = $_FILES["file"]["name"];
		$file_image_tmp  = $_FILES["file"]["tmp_name"];
		$file_name    = date('ymdhis-').$file_image_name;
		if($_FILES["file"]['name']){
			if(file_exists("./images/".$file_name)){
				unlink("./images/".$file_name);
			}
			$this->load->library('image_moo');
			$file_image = $d.$file_name;
			// $this->image_moo->load($file_image_tmp)->resize_crop($w,$h)->save("./uploads/".$file_image);
			// $this->image_moo->load($file_image_tmp)->resize_crop(125,125)->save("./images/admin_images/".$file_image);
			move_uploaded_file($file_image_tmp, "./images/".$file_name);
		}else{
			$file_name  = $file_image_old;
		}
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("err",validation_errors());
			redirect($this->table);
		}else{
			if($id > 0)
			{
				$this->configs->setUpdate($this->table,$id,$meta_title,$meta_keyword,$meta_description,$meta_author,$email,$password,$adp_api_url,$hour_cron,$show_lpse,$publish,$user_id,$file_name);
				$this->session->set_flashdata("success","Data saved successful");
				redirect($this->table);
			}else{
				$id_term = $this->configs->setInsert($this->table,$id,$meta_title,$meta_keyword,$meta_description,$meta_author,$email,$password,$adp_api_url,$hour_cron,$show_lpse,$publish,$user_id,$file_name);
				$last_id = $this->db->insert_id();
				
				$this->session->set_flashdata("success","Data inserted successful");
				redirect($this->table);
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */