<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class content extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_content','content');
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

	function detail($id)
	{
		$data['content'] 	= $this->content->getDetail($id)->result_array();
		$data['view'] 		= "tentangkami";
		return $this->template($data);
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */