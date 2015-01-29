<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('curl'))
{	

	function logoImage(){

		$ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT file_name
	    FROM configs"; 
	    $query = $ci->db->query($sql)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->file_name;
			}
	    }
	    return 'inaproc-logo.png';
	}


	function standarisasiList($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM ref_standarisasi where id=$id"; 
	    $query = $ci->db->query($sql)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}

	function tahap($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM engine_tahap where id=$id"; 
	    $query = $ci->db->query($sql)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}

	function jenisKontrak($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM engine_jeniskontrak where id=$id"; 
	    $query = $ci->db->query($sql)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}


	function kategori($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT title 
	    FROM engine_kategori where id=$id"; 
	    $query = $ci->db->query($sql)->result();

	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}

	function kategoriIcon($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT file_image 
	    FROM engine_kategori where id=$id"; 
	    $query = $ci->db->query($sql)->result();

	    if(count($query) > 0){
			foreach ($query as $value) {
				return "<img src=".base_url()."images/icon/".$value->file_image.">";
			}
	    }
	    return '';
	}

	function metodePemilihan($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM engine_metodepemilihan where id=$id"; 
	    $query = $ci->db->query($sql)->result();

	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}

	function metodeKualifikasi($id)
	{
		 // $ci=& get_instance();
	  //   $ci->load->database(); 
	    
	  //   $sql = "SELECT * 
	  //   FROM engine_metodepemilihan where id=$id"; 
	  //   $query = $ci->db->query($sql)->result();

	  //   if(count($query) > 0){
			// $row = $query->row();
		 //    return $row->title;
	  //   }
	    return ' - ';
	}

	function metodeEvaluasi($id)
	{
		$ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM engine_metodeevaluasi where id=$id"; 
	    $query = $ci->db->query($sql)->result();

	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}


	function kualifikasi($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM engine_kualifikasi where id=$id"; 
	    $query = $ci->db->query($sql)->result();

	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->title;
			}
	    }
	    return ' - ';
	}

	function getData($query){

		//print_r($query);
		die();
		echo count($query);
		die();
		if(count($query) > 0){
			$row = $query->row();
		    return $row->title;
	    }
	    return ' - ';
	}



	function lpseName($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM lpse where id=$id"; 
	    $query = $ci->db->query($sql)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->nama;
			}
			// $row = $query->row_array();
		 //    return $row['nama'];
	    }
	    return ' - ';
	}

	function lpseUrl($id)
	{
		 $ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT url 
	    FROM lpse where id=$id"; 
	    $query = $ci->db->query($sql)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				return $value->url;
			}
			// $row = $query->row_array();
		 //    return $row['nama'];
	    }
	    return ' - ';
	}

	function lpseMap($id)
	{
		$ci=& get_instance();
	    $ci->load->database(); 
	    
	    $sql = "SELECT * 
	    FROM lpse where id=$id"; 
	    $query = $ci->db->query($sql)->result();
	    $map['lat'] = 0;
	    $map['long'] = 0;
	    if(count($query) > 0){
			foreach ($query as $value) {
				$map['lat'] = $value->lat;
				$map['long'] = $value->long;
			}
	    }
	    return $map;
	}

	function totalPengadaanByKategori($id){
 		

 		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_pengadaan');

	    // Call a function of the model
	    $data = $CI->m_pengadaan->getPengadaanTotal(false,false,false,$id)->result();
	    return count($data);

	}



	function totalPengadaanByHps($id){
 		

 		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_pengadaan');

	    // Call a function of the model
	    $data = $CI->m_pengadaan->getPengadaanTotal(false,false,false,false,$id)->result();
	    return count($data);

	}


	function totalPengadaanByKualifikasi($id){

 		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_pengadaan');

	    // Call a function of the model
	    $data = $CI->m_pengadaan->getPengadaanTotal(false,false,false,false,false,$id)->result();
	    return count($data);

	}


	function totalPengadaanByLPSE($id){

 		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_pengadaan');

	    // Call a function of the model
	    $data = $CI->m_pengadaan->getPengadaanTotalByLPSE($id)->result();
	    return count($data);

	}

	function getSyarat($lls_id){

 		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_pengadaan');

	    // Call a function of the model
	    $data = $CI->m_pengadaan->getSyarat($lls_id)->result();

	    return $data;
	   

	}

	function getFileImage($keyword,$id){

 		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_lpse');

	    // Call a function of the model
	    return $CI->m_lpse->getAPIImage($keyword,$id);
	   

	}


	function getStatusServer($id){

		date_default_timezone_set('Asia/Jakarta');

 		$CI = get_instance();

 		$CI->load->model('m_lpse');

	    // You may need to load the model if it hasn't been pre-loaded
	   	
	   	$date=date('Y-m-d');

	    // $sql = "SELECT status 
	    // FROM server_history where lpse_id=$id and created_date=$date"; 
	    // $query = $CI->db->query($sql)->result();

	    $query = $CI->m_lpse->getHistory($id,$date)->result();
	    if(count($query) > 0){
			foreach ($query as $value) {
				$status = $value->status;
			}
			
			$decode = json_decode($status,true);

			if($decode[0]['status']==1){
				return true;
			}
	    }
	    return false;

	}

	function getTotalLelang($lpse_id){
		$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('m_pengadaan');

	    $data = $CI->m_pengadaan->getPengadaanTotalLelang($lpse_id)->result_array();

	    return count($data);
	}


}
?>