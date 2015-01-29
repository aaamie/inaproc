<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unduh extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_unduh','unduh');
	    $this->load->model('m_ref_unduh','ref_unduh');
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
		$kat = $this->ref_unduh->getList($limit='')->result();
		$unduh=array();
		foreach ($kat as $value) {
			$unduh[]=array('ref_title'=>$value->title,
						  'unduh_list'=>$this->unduh->getList($limit=6,$value->id)->result_array()
				);
		}


		$data['kat']        = $kat; 	
		$data['unduh'] 		= $unduh;   
		$data['view'] 		= "unduh";
		return $this->template($data);
	}

	function catagory($id){
		
		$kat = $this->ref_unduh->getList($limit='',$id)->result();
		$unduh=array();
		foreach ($kat as $value) {
			$unduh[]=array('ref_title'=>$value->title,
						  'unduh_list'=>$this->unduh->getList($limit=6,$value->id)->result_array()
				);
		}

		$kat = $this->ref_unduh->getList($limit='')->result();
		$data['kat']        = $kat; 	
		$data['unduh'] 		= $unduh;   
		$data['view'] 		= "unduh";
		return $this->template($data);
	}


	function searchAction(){
		$catagory = $this->input->post('catagory');
		$search   = $this->input->post('search');
		redirect('unduh/search/'.$catagory.'/'.rawurlencode($search));
	}


	function search($id='',$search=''){
		
		$kat = $this->ref_unduh->getList($limit='',$id)->result();
		$unduh=array();
		foreach ($kat as $value) {
			$unduh[]=array('ref_title'=>$value->title,
						  'unduh_list'=>$this->unduh->getList($limit=6,$value->id,rawurldecode($search) )->result_array()
				);
		}

		$kat = $this->ref_unduh->getList($limit='')->result();
		$data['kat']        = $kat; 	
		$data['unduh'] 		= $unduh;   
		$data['view'] 		= "unduh";
		return $this->template($data);
	}

	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */