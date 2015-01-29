<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class berita extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_berita','berita');
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

	function index()
	{
		$offset 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : "";
		$url                            = base_url()."berita/index/".$offset;
		$per_page 						= 10;
		$total_rows				        = count($this->berita->getList($limit=false)->result_array());
		$dataRight['ref_news'] 			= $this->ref_news->getList($limit=6)->result_array();
		$dataRight['beritaPopuler'] 	= $this->berita->getListPopuler($limit=6)->result_array();
		$dataRight['beritaRecent'] 		= $this->berita->getList($limit=6)->result_array();
		$data['dataRight']  			= $dataRight;
		$data['berita'] 				= $this->berita->getList($limit=10,$offset)->result_array();
		$data['pagging']                = $this->_paginate($total_rows,$per_page,$url);
		$data['view'] 					= "berita";
		return $this->template($data);
	}

	function catagory($cat_id)
	{
		$offset 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : "";
		$url                            = base_url()."berita/index/".$offset;
		$per_page 						= 6;
		$total_rows				        = count($this->berita->getList($limit=false,$cat_id)->result_array());
		$dataRight['ref_news'] 			= $this->ref_news->getList($limit=6)->result_array();
		$dataRight['beritaPopuler'] 	= $this->berita->getListPopuler($limit=6)->result_array();
		$dataRight['beritaRecent'] 		= $this->berita->getList($limit=6)->result_array();
		$data['dataRight']  			= $dataRight;
		$data['berita'] 				= $this->berita->getListWhere($limit=10,$cat_id)->result_array();
		$data['pagging']                = $this->_paginate($total_rows,$per_page,$url);
		$data['view'] 					= "berita";
		return $this->template($data);
	}

	function actionSearch(){
		$search =$this->input->post('cari');
		redirect(base_url()."berita/cari/0/".rawurlencode($search));
	}

	function cari($search)
	{
		$offset 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : "";
		$search                         = rawurldecode($this->uri->segment(4));
		$url                            = base_url()."berita/index/".$offset."/".rawurlencode($search);
		$per_page 						= 10;
		$total_rows				        = count($this->berita->getListSearch($limit=false,$search)->result_array());
		$dataRight['ref_news'] 			= $this->ref_news->getList($limit=6)->result_array();
		$dataRight['beritaPopuler'] 	= $this->berita->getListPopuler($limit=6)->result_array();
		$dataRight['beritaRecent'] 		= $this->berita->getList($limit=6)->result_array();
		$data['dataRight']  			= $dataRight;
		$data['berita'] 				= $this->berita->getListSearch($limit=10,$offset,$search)->result_array();
		$data['pagging']                = $this->_paginate($total_rows,$per_page,$url);
		$data['view'] 					= "berita";
		return $this->template($data);
	}

	function detail($id)
	{
		$counter = $this->berita->addCounter($id);
		//die();
		$dataRight['ref_news'] 			= $this->ref_news->getList($limit=6)->result_array();
		$dataRight['beritaPopuler'] 	= $this->berita->getListPopuler($limit=6)->result_array();
		$dataRight['beritaRecent'] 		= $this->berita->getList($limit=6)->result_array();
		$data['dataRight']  			= $dataRight;
		$data['berita'] 	= $this->berita->getDetail($id)->result_array();
		$data['komentar'] 	= $this->db->where('news_id',$id)->get('komentar')->result_array();
		$data['view'] 		= "beritaDetail";
		return $this->template($data);
	}

	protected function _paginate($total_rows,$per_page,$url)
	{
		$this->load->library('pagination');

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

	function submitKomentar(){

			$dataPost = $this->input->post();
			unset($dataPost['current_url']);
			$dataPost['create_date'] = date('Y-m-d H:i:s');
			$this->db->insert('komentar',$dataPost);
			redirect('berita/detail/'.$this->input->post('current_url'));

	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */