<?php
class m_lpse extends CI_Model {
	

	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit,$offset='',$propinsi_id='',$search=''){

		if($limit){
			$this->db->limit($limit,$offset);		
		}
		if($propinsi_id){
			$this->db->where('provinsi_id',$propinsi_id);
		}
		if($search && $search!='null'){
			$this->db->like('nama',$search);
			
		}

		$this->db->order_by('create_date','desc');
		$this->db->where('publish','publish');
		
		$q = $this->db->get('lpse');
		return $q;
	}

	function getDetail($id){

		$this->db->where('id',$id);		
		$this->db->where('publish','publish');
		return $this->db->get('lpse');
	}

	function getAPI($page,$propinsi_id=0,$keyword=0){
		
		$api = $this->getCurl($propinsi_id,$keyword,$page);
		return $api;
	}

	function getAPIByGroup($page,$propinsi_id=0,$keyword=0){
		
		$api = $this->getCurl($propinsi_id,$keyword,$page);
		return $api;
	}


	function getAPIByGroupInstansi($page,$instansi_id,$keyword=0){
		

		$api = $this->getCurl($propinsi_id=0,$keyword,$page);

		$parsing=array();
		foreach ($api as $key => $value) {
			if($value['kabupaten_id']==$instansi_id){
				$parsing[$key] = $value;
			}
		}

		return $parsing;
	}


	function getAPITotal($page,$propinsi_id=0,$keyword=0){
		
		$api = $this->getCurl($propinsi_id,$keyword,$page,'total');
		return $api;
	}

	function getAPIDetail($page,$propinsi_id=0,$keyword=0,$id){
		
		$api = $this->getCurl($propinsi_id,$keyword,$page);


		// echo "<pre>";
		// print_r($api);
		// echo "</pre>";
		foreach ($api as $key => $value) {

			//echo "0".$value['id']. ' = '.$id."<br>";
			if($value['id']==$id || "0".$value['id']==$id){
				$parsing[$key] = $value;
			}
		}

		// echo "<pre>";
		// print_r($parsing);
		// echo "</pre>";
		//die();
		return $parsing;
	}

	

	function getAPIImage($keyword=0,$id){
		
		$api = $this->getCurl(0,$keyword,$page=0);
		$parsing=array();
		foreach ($api as $key => $value) {
			if($value['id']==$id){
				$parsing[$key] = $value;
			}
		}	


		if(count($parsing) > 0){

		foreach ($parsing as $valuelpse) {
			if($valuelpse['file_image']){
				return $valuelpse['file_image'];
			}
		}
		}
		return false;
	}

	function getCurl($propinsi_id,$keyword,$page,$tipe='api'){

		$tipe= $tipe=="total" ? "total" : 'api';

		$url = LPSE_API.$tipe."/".$propinsi_id."/".rawurlencode($keyword)."/".$page."";
		// echo "<br>";
		// echo $url = "http://dataclient.net/lkpp-lpse/lpse/api/0/yogyakarta/0";
		// die();
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90); 
		$response = curl_exec($ch); 
		
		curl_close($ch); 

		return json_decode($response,true);
	}

	function getHistory($id,$date){

		$this->db->where('lpse_id',$id);
		$this->db->where('created_date',$date);
		return $this->db->get('server_history');
	}
	

	

}
?>