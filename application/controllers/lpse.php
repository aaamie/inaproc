<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lpse extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_lpse','lpse');
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
    	redirect('lpse/index/'.$propinsi_id.'/'.rawurlencode($search) );
	}

	function index($propinsi_id=null,$search=null)
	{
		$show_lpse = $this->db->get('configs')->row()->show_lpse;
		
		$propinsi_id					= $propinsi_id!=null ? $propinsi_id : 0;
		$search 						= $search!=null ? $search : 0;
		$offset 						= ($this->uri->segment(5)) ? $this->uri->segment(5) : "0";
		$url                            = base_url()."lpse/index/".$propinsi_id."/".$search."/";
		$total_rows				        = $this->lpse->getAPITotal($offset,$propinsi_id,rawurldecode($search)); //count($this->lpse->getList($limit=false,false,false,rawurldecode($search))->result_array());
		$per_page 						= 10;

		$lpse  = $this->lpse->getAPI($offset,$propinsi_id,rawurldecode($search));
		if($show_lpse=='all'){
			$lpseAll = $this->db->get('lpse')->result_array();
		}else{
			$lpseAll = $lpse;
		}

		$data['lpse']       = $lpse;
		$data['view'] 		= "lpse";
		$data['lpseAll']    = $lpseAll;
		$data['pagging']    = $this->_paginate($total_rows,$per_page,$url);
		return $this->template($data);
	}

	
	function detail($propinsi_id,$keyword,$page,$id)
	{
		$data['lpse']       = $this->lpse->getAPIDetail($page,$propinsi_id,$keyword,$id);
		$data['view'] 		= "lpsedetail";
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
		$config['first_link'] = '';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';

		$this->pagination->initialize($config); 

		return $this->pagination->create_links();
	}
	
	function import(){

		$data = curlAPI('lpse');
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		foreach ($data as $value) {
			
			$post['id'] = $value['kd_lpse'];
			$post['provinsi_id']= $value['kd_propinsi'];
			$post['kabupaten_id']= $value['kd_kabupaten'];
			$post['nama'] =$value['nama_lpse'];
			$post['alamat'] = strip_tags($value['alamat'],"<div><p>");
			$this->db->insert('lpse',$post);
		}

		echo count($data) .'data  berhasil diimport';
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */