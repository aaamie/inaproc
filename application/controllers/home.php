<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_pengadaan','pengadaan');
	    $this->load->model('m_lpse','lpse');
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

	public function slider()
	{
		$data['newsSlider'] = $this->db->where('is_slider','1')->where('publish','Publish')->where('is_delete','0')->order_by("order","asc")->get('news')->result_array();	
		$data['homebanner'] = $this->db->where('publish','Publish')->order_by("order","asc")->where('is_delete','0')->get('gambar_banner')->result_array();	
		return $this->load->view('homeslider',$data);
	}

	public function pencarianPopuler()
	{
		$data['list'] = $this->db->get('pencarian_populer')->result_array();	
		return $this->load->view('pencarianpopuler',$data);
	}
	 
	function template($data){
		$this->header();
		$this->slider();
		$this->load->view($data['view'],$data);
		$this->pencarianPopuler();
		$this->footer();
	}

	function index()
	{

	//	$this->output->cache(60*24); 
		$data['link_aplikasi'] 	    = $this->db->where('publish','Publish')->get('gambar_link')->result_array();
		$data['link_aplikasi1'] 	= $this->db->where('publish','Publish')->where('is_delete','0')->limit(6,0)->order_by('ordered','asc')->get('gambar_link')->result_array();
		$data['link_aplikasi2'] 	= $this->db->where('publish','Publish')->where('is_delete','0')->limit(6,6)->order_by('ordered','asc')->get('gambar_link')->result_array();
		$data['link_aplikasi3'] 	= $this->db->where('publish','Publish')->where('is_delete','0')->limit(6,12)->order_by('ordered','asc')->get('gambar_link')->result_array();
		$data['propinsi'] 			= $this->propinsi->getList($limit='')->result_array();
		$data['pengadaan'] 			= $this->pengadaan->getPengadaanPGARand($limit=3)->result();
		$data['pengadaanPopuler'] 	= $this->pengadaan->getPengadaanPGARand($limit=3)->result();		
		$data['total']              = count($this->pengadaan->getPengadaanPGATotal()->result());
		$data['view'] 				= "home";
		return $this->template($data);
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */