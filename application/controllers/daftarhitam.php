<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daftarhitam extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_daftarhitam','daftarhitam');
	    $this->load->model('m_propinsi','propinsi');
		$this->lang->load('elemen_layout', 'indonesia');
	}
	
	
	public function header()
	{
		return $this->load->view('header');
	}

	public function footer()
	{
		return $this->load->view('footer');
	}
	 
	function template($data){
		$this->header();
		$this->load->view($data['view'],$data);
		$this->footer();
	}

	function searchAction(){
		$propinsi_id = $this->input->post('propinsi_id');
    	$search 	 = $this->input->post('search');
    	redirect('daftarhitam/index/'.$propinsi_id.'/'.rawurlencode($search) );
	}

	function index($propinsi_id=null,$search=null)
	{
		$propinsi_id					= $propinsi_id!=null ? $propinsi_id : 0;
		$search 						= $search!=null ? $search : 'null';
		$offset 						= ($this->uri->segment(5)) ? $this->uri->segment(5) : "";
		$url                            = base_url()."daftarhitam/index/".$propinsi_id."/".$search."/";
		$per_page 						= 50;
		$total_rows				        = count($this->daftarhitam->getList($limit=false)->result_array());
		$data['propinsi'] 				= $this->propinsi->getList($limit)->result_array();
		$data['daftarhitam'] 			= $this->daftarhitam->getList($per_page,$offset,$propinsi_id,rawurldecode($search) )->result_array();
		$data['pagging']                = $this->_paginate($total_rows,$per_page,$url);
		$data['view'] 					= "daftarhitam";
		return $this->template($data);
	}
	
	function detail($id)
	{
		$data['propinsi'] 		= $this->propinsi->getList($limit='')->result_array();
		$data['daftarhitam'] 	= $this->daftarhitam->getDetail($id)->result_array();
		$data['daftarsk']       = $this->daftarhitam->getListGroupSk($this->daftarhitam->getDetail($id)->row()->npwp)->result_array();
		$data['view'] 			= "daftarhitamdetail";
		return $this->template($data);
	}
	

	protected function _paginate($total_rows,$per_page,$url)
	{
		$this->load->library('pagination');

		$config['uri_segment'] = 5;
		$config['base_url'] = $url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page; 
		$config['cur_tag_open'] = '<li><a><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 

		return $this->pagination->create_links();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */