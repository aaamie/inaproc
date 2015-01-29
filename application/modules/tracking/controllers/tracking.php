<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tracking extends MX_Controller  {
	
	var $table = "customer_manifest";
	var $table_alias = "VISA tracking";	
	var $uri_page = 10;
	var $per_page = 25;
	 
	function __construct()
	{
		parent::__construct();
		$this->load->model("tracking/model_tracking", "tracking");
		$this->lang->load('elemen_layout', 'indonesia');
	}
	
	public function setheader()
	{
		return Modules::run('layout/setheader_login');
	}

	public function setfooter()
	{
		return Modules::run('layout/setfooter');
	}
	 

	function index()
	{
		$this->grid();
	}


	function grid()
	{
		$this->setheader();		
		$contents = $this->grid_content();
	
		$data = array(
				  'admin_url'=>base_url(),
				  'contents'=>$contents,
				  );
		$this->parser->parse('login/contents_login.html', $data);
		
		$this->setfooter();
	}
	
	
	
	function grid_content()
	{	
		
		
		$data = array(
				  'admin_url' => base_url()
				  );
		return $this->parser->parse("form.html", $data, TRUE);
	}
	
	
	function get_label($status)
	{
		switch($status){
			case "Entry Process":
			$label = "label1";
			break;
			case "Entry Confirmation":
			$label = "label2";
			break;
			case "Mofa Process":
			$label = "label3";
			break;
			case "Mofa Approved":
			$label = "label4";
			break;
			case "Mofa Expired":
			$label = "label5";
			break;
			case "Legal Process":
			$label = "label6";
			break;
			case "Visa Ready":
			$label = "label7";
			break;
			case "Canceled":
			$label = "label8";
			break;
		}
		return $label;
	}
	

	function search()
	{
		$registered_number = $this->input->post("registered_number");
		$q = $this->tracking->getList($this->table,$registered_number);
		$list = array();
		if($q->num_rows() > 0){
			foreach($q->result() as $r)
			{
				$title = $r->registered_number;
				$create_date  = date("d/m/Y H:i",strtotime($r->create_date));
				$modify_date  = $r->modify_date == "0000-00-00 00:00" || empty($r->modify_date) ? "" : date("d/m/Y H:i",strtotime($r->modify_date));
				$label = $this->get_label($r->status);
								
				$list[] = array(
								"label"=>$label,
								"registered_number"=>$title,
								"customers"=>ucwords($r->company),
								"total_manifest"=>$r->total_manifest,
								"status"=>$r->status,
								"modify_date"=>$modify_date,
								"create_date"=>$create_date
								);
			}
			$data = array(
				  'admin_url' => base_url(),
				  'base_url' => base_url(),
				  'list'=>$list
				  );
			echo $this->parser->parse("list.html", $data, TRUE);
		}else{
			$msg = "Maaf Nomor Registrasi Anda tidak terdaftar pada Sistem kami.";
			$data = array(
				  'admin_url' => base_url(),
				  'base_url' => base_url(),
				  'msg'=>$msg
				  );
			echo $this->parser->parse("list_empty.html", $data, TRUE);
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */