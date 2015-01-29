<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_berita','berita');
	     $this->load->model('m_search','search');
	    $this->load->model('m_ref_news','ref_news');
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

	function action(){
		$search = $this->input->post('search');
		redirect('search/index/'.rawurlencode($search) );
	}

	function index($search=null)
	{

		$search 						= $search!=null ? $search : 'null';
		$offset 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : "";
		$url                            = base_url()."search/index/".$search."/";
		$per_page 						= 50;
		$total_rows				        = $this->search->getGlobalSearchTotal(rawurldecode($search) )->row()->total;
		$data['ref_news'] 			= $this->ref_news->getList($limit=6)->result_array();
		$data['beritaPopuler'] 	= $this->berita->getListPopuler($limit=6)->result_array();
		$data['beritaRecent'] 		= $this->berita->getList($limit=6)->result_array();
		$data['total']                  = $this->search->getGlobalSearchTotal(rawurldecode($search))->row_array();
		$data['searchResult'] 			= $this->search->getGlobalSearch($limit=6,$offset,rawurldecode($search))->result_array();
		$data['pagging']                = $this->_paginate($total_rows,$per_page,$url);
		$data['view'] 					= "search";
		return $this->template($data);
	}

	protected function _paginate($total_rows,$per_page,$url)
	{
		$this->load->library('pagination');

		$config['uri_segment'] = 4;
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