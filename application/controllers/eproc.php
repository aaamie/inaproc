<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eproc extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_pengadaan','pengadaan');
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

	function index()
	{
		if(!$this->session->userdata('lkpp_logged_user')){

			redirect('signin/index/'.rawurlencode('maaf, anda harus login terlebih dahulu'));
		}
		$data['propinsi'] 			= $this->propinsi->getList($limit='')->result_array();
		$data['pengadaan'] 			= $this->pengadaan->getPengadaanPGA($limit=3)->result_array();
		$data['eproc'] 				= $this->db->order_by('create_date','desc')->where('is_delete','0')->get('eproc')->result_array();		
		$data['view'] 				= "eproc";
		return $this->template($data);
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */