<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	

class pengadaan extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_pengadaan','pengadaan');
	    $this->load->model('m_propinsi','propinsi');
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

	function search(){
		$pkt_nama = strtolower($this->input->post('pkt_nama'));
		$satuan_kerja = strtolower($this->input->post('satuan_kerja'));

		$pkt_nama = $pkt_nama=='' ? 'null' : $pkt_nama;
		$satuan_kerja = $satuan_kerja=='' ? 'null' : $satuan_kerja;


		$kgr_id = $this->input->post('kgr_id');
		$kls_id = $this->input->post('kls_id');
		
		$lpse_id ='null';
		$lpse  = $this->input->post('lpse_id');
		if($lpse){
			$lpseExp = explode('-', str_replace(' ','',$lpse));
			$lpse_id = $lpseExp[1];
		}
		
		$propinsi_id = $this->input->post('propinsi_id');
		$pkt_hps = $this->input->post('pkt_hps');
		redirect('pengadaan/index/'.$propinsi_id.'/'.$kgr_id.'/'.$pkt_hps.'/'.$kls_id.'/'.rawurlencode($pkt_nama).'/'.rawurlencode($satuan_kerja).'/'.$lpse_id );
	}

	function index($propinsi_id=null,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false)
	{
		$nilaiHps['less500'] = '< 500jt';
		$nilaiHps['5001M'] = '500jt - 1M ';
		$nilaiHps['more1M'] = '> 1M';
		$this->output->cache(60*24);
		$pkt_nama_search				= $pkt_nama!='null' ? $pkt_nama : false;
		$satuan_kerja_search			= $satuan_kerja!='null' ? $satuan_kerja : false;
		$propinsi_id_search				= $propinsi_id!='null' ? $propinsi_id : false;
		$kgr_id_search 					= $kgr_id!='null' ? $kgr_id : false;
		$pkt_hps_search 				= $pkt_hps!='null' ? $pkt_hps : false;
		$kls_id_search 					= $kls_id!='null' ? $kls_id : false;
		$lpse_id_search 			    = $lpse_id!='null' ? $lpse_id : false;

		$pkt_nama					= $pkt_nama!='' ? $pkt_nama : 'null';
		$satuan_kerja				= $satuan_kerja!='' ? $satuan_kerja : 'null';
		$propinsi_id				= $propinsi_id!='' ? $propinsi_id : 'null';
		$kgr_id 					= $kgr_id!='' ? $kgr_id : 'null';
		$pkt_hps 					= $pkt_hps!='' ? $pkt_hps : 'null';
		$kls_id 					= $kls_id!='' ? $kls_id : 'null';
		$lpse_id 					= $lpse_id!='' ? $lpse_id : 'null';

		$offset 						= ($this->uri->segment(10)) ? $this->uri->segment(10) : "";
		$url                            = base_url()."pengadaan/index/".$propinsi_id."/".$kgr_id."/".$pkt_hps."/".$kls_id."/".$pkt_nama."/".$satuan_kerja."/".$lpse_id;
		$total_rows				        = count($this->pengadaan->getPengadaanPGATotal(false,false,$propinsi_id_search,$kgr_id_search,$pkt_hps_search,$kls_id_search,rawurldecode($pkt_nama_search),rawurldecode($satuan_kerja_search),$lpse_id_search,true)->result_array());
		$per_page 						= 9;
		$data['pengadaan'] 	= $this->pengadaan->getPengadaanPGA($per_page,$offset,$propinsi_id_search,$kgr_id_search,$pkt_hps_search,$kls_id_search,rawurldecode($pkt_nama_search),rawurldecode($satuan_kerja_search),$lpse_id_search,true)->result();
		$data['view'] 		= "pengadaan";
		$data['kategori']   = $this->db->get('engine_kategori')->result();
		$data['kualifikasi'] = $this->db->get('engine_kualifikasi')->result();
		$data['nilaiHps']   = $nilaiHps;
		$lpse = $this->db->order_by('nama','ASC')->get('lpse');
		$i=0;
		foreach ($lpse->result() as $value) {
			$lpseJson[$i] = $value->nama.' - '.$value->id;
			$i++;
		}
		$data['lpseJson']   = json_encode($lpseJson);
		$data['pagging']    = $this->_paginate($total_rows,$per_page,$url,$offset);
		return $this->template($data);
	}
	
	function detail($lls_id,$pkt_id,$dtj_tglawal)
	{
		$this->pengadaan->counter($lls_id,$pkt_id,rawurldecode($dtj_tglawal) );
		//$this->output->cache(60*24); 
		$data['propinsi'] 			= $this->propinsi->getList($limit='')->result_array();
		$data['pengadaan'] 			= $this->pengadaan->getDetail($lls_id,rawurldecode($dtj_tglawal))->result();
		$data['pengadaanTerbaru'] 	= $this->pengadaan->getlatestPGA($limit=10)->result();
		$data['syarat']      		= $this->pengadaan->getSyarat($pkt_id)->result();
		$data['tahap']      		= $this->pengadaan->getTahap($lls_id)->result();
		$data['kontrak']      		= $this->pengadaan->getKontrak($lls_id)->result();
		$data['view'] 				= "pengadaandetail";
		return $this->template($data);
	}

	function historyserver($id){
		$data['propinsi'] 			= $this->propinsi->getList($limit='')->result_array();
		$data['pengadaanTerbaru'] 	= $this->pengadaan->getlatestPGA($limit=10)->result();
		$this->db->where('lpse_id',$id);
		$this->db->order_by('created_date','desc');
		$d = $this->db->get('server_history',1);
		$status = array();
		if(count($d->result()) > 0){
			foreach ($d->result() as $value) {
				$status = json_decode($value->status,true);
			}
		}
		$data['status']             = $status;
		$data['view'] 				= "pengadaanhistoryserver";
		return $this->template($data);
	}

	function setSession($cat){
		$this->session->set_userdata('berdasarkan',$cat);
		redirect('pengadaan');
	}

	function kategori()
	{
		$data['kategori']   = $this->db->get('engine_kategori')->result();
		$data['view'] 				= "pengadaanKategori";
		return $this->template($data);
	}
	
	protected function _paginate($total_rows,$per_page,$url,$offset,$segment=0)
	{
		$this->load->library('pagination');

		$config['uri_segment'] = $segment!=0 ? $segment : 10;
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

	function lpse($propinsi_id=null,$search=null){

		$this->session->set_userdata('berdasarkan','');
		

		$nilaiHps['less500'] = '< 500jt';
		$nilaiHps['5001M'] = '500jt - 1M ';
		$nilaiHps['more1M'] = '> 1M';
		$data['view'] 		= "pengadaan";
		$data['kategori']   = $this->db->get('engine_kategori')->result();
		$data['kualifikasi'] = $this->db->get('engine_kualifikasi')->result();
		$data['nilaiHps']   = $nilaiHps;
		$lpse = $this->db->order_by('nama','ASC')->get('lpse');
		$i=0;
		foreach ($lpse->result() as $value) {
			$lpseJson[$i] = $value->nama.' - '.$value->id;
			$i++;
		}



		$propinsi_id					= $propinsi_id!=null ? $propinsi_id : 0;
		$search 						= $search!=null ? $search : 0;
		$offset 						= ($this->uri->segment(5)) ? $this->uri->segment(5) : "0";
		$url                            = base_url()."pengadaan/lpse/".$propinsi_id."/".$search."/";
		$total_rows				        = $this->lpse->getAPITotal($offset,$propinsi_id,rawurldecode($search)); //count($this->lpse->getList($limit=false,false,false,rawurldecode($search))->result_array());
		$per_page 						= 10;
		
		$lpse               = $this->lpse->getAPIByGroup($offset=0,$propinsi_id=0,rawurldecode($search=0));

		$data['lpse'] 		= $lpse;
		$data['lpseJson']   = json_encode($lpseJson);
		$data['view'] 		= "pengadaanLPSE";
		$data['pagging']    = $this->_paginate($total_rows,$per_page,$url,$offset,5);
		return $this->template($data);
	}

	function propinsi(){
		$listProv = curlAPI('prov'); 

		$nilaiHps['less500'] = '< 500jt';
		$nilaiHps['5001M'] = '500jt - 1M ';
		$nilaiHps['more1M'] = '> 1M';
		$data['view'] 		= "pengadaan";
		$data['kategori']   = $this->db->get('engine_kategori')->result();
		$data['kualifikasi'] = $this->db->get('engine_kualifikasi')->result();
		$data['nilaiHps']   = $nilaiHps;
		$lpse = $this->db->order_by('nama','ASC')->get('lpse');
		$i=0;
		foreach ($lpse->result() as $value) {
			$lpseJson[$i] = $value->nama.' - '.$value->id;
			$i++;
		}


		//print_r($listProv);
		foreach ($listProv as $key => $value) {
			$list[$key]['nama'] = $value['nama_propinsi'];
			$total = 0;
			$lpse = $this->lpse->getAPIByGroup($offset=0,$value['kd_propinsi'],rawurldecode($search=0));
			foreach ($lpse as $val) {
				$total = $total + totalPengadaanByLPSE($val['id']);
			}
			$list[$key]['total'] = $total;

		}

		$data['list']       = $list;
		$data['view'] 		= "pengadaanPropinsi";
		return $this->template($data);

	}


	function kota(){
		$listInstansi = curlAPI('instansi');

		$nilaiHps['less500'] = '< 500jt';
		$nilaiHps['5001M'] = '500jt - 1M ';
		$nilaiHps['more1M'] = '> 1M';
		$data['view'] 		= "pengadaan";
		$data['kategori']   = $this->db->get('engine_kategori')->result();
		$data['kualifikasi'] = $this->db->get('engine_kualifikasi')->result();
		$data['nilaiHps']   = $nilaiHps;
		$lpse = $this->db->order_by('nama','ASC')->get('lpse');
		$i=0;
		foreach ($lpse->result() as $value) {
			$lpseJson[$i] = $value->nama.' - '.$value->id;
			$i++;
		}

		// echo "<pre>";
		// print_r($listInstansi);
		// echo "</pre>";
		// die();
		foreach ($listInstansi as $key => $value) {
			$list[$key]['nama'] = $value['nama_instansi'];
			//echo $value['kd_instansi'];
			$total = 0;
			$lpse = $this->lpse->getAPIByGroupInstansi($offset=0,$value['kd_instansi'],rawurldecode($search=0));
			//print_r($lpse);
			if(count($lpse) > 0){
				foreach ($lpse as $val) {
					$total = $total + totalPengadaanByLPSE($val['id']);
				}
			}else{
				$total = 0;
			}
			$list[$key]['total'] = $total;

		}

		$data['list']       = $list;
		$data['view'] 		= "pengadaanPropinsi";
		return $this->template($data);

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */