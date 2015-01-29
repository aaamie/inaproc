<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
		$this->load->model('login/model_user','user');
		$this->lang->load('elemen_layout', 'indonesia');
	}
	
	
	public function header_login()
	{
		return Modules::run('layout/setheader_login');
	}

	public function footer()
	{
		return Modules::run('layout/setfooter');
	}
	 
	public function auth()
	{
		return Modules::run('auth/publicAuth');
	}
	
	function index()
	{
		$this->auth();
		$this->grid();
	}
	
	
	function grid($err=NULL)
	{
		$this->header_login();
		$contents = $this->grid_content($err);
	
		$data = array(
				  'base_url' => base_url(),
				  'contents' => $contents,
				  );
		$this->parser->parse('contents_login.html', $data);
		
		$this->footer();
	}
	
	
	function grid_content($err=NULL)
	{

		$notification = !empty($err) || !is_null($err) ? "<span>".$err."</span>" : "";
			$q = $this->user->getLogo();
			if($q->num_rows() > 0){
				foreach($q->result() as $r){
					$file_name = $r->file_name;
				}
			}
			else
			{
				$file_name = "inaproc-logo.png";
			}
		$data = array(
				  'base_url' => base_url(),
				  'notification'=>$notification,
				  'logo' => $file_name
				  );
		return $this->parser->parse('login.html', $data, TRUE);
	}
	
	
	function submit()
	{
		
		$post_username = strip_tags(mysql_real_escape_string($this->input->post('username')));
		$post_password = strip_tags(mysql_real_escape_string($this->input->post('password')));

		if(empty($post_username) && empty($post_password))
		{	
			$err = $this->lang->line('login_err_required');
			$this->grid($err);
		}else{
			$query = $this->user->cekUserLogin($post_username,$post_password);
			$jum = $query->num_rows();
			
			if($jum > 0){
				foreach($query->result() as $row){
					$adminID = $row->id;
					$adminGroupsID = $row->adminusers_level_id;
					$user_data = array(
									   "adminID"=>$adminID,
									   "adminGroupsID"=>$adminGroupsID
									   );
					$this->session->set_userdata($user_data);
					redirect("admin");
				}
			}else{
				$err = $this->lang->line('login_err_user');
				$this->grid($err);
			}
		}
	}
	

	function logout()
	{
	  $this->session->sess_destroy();
	  redirect('login');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */