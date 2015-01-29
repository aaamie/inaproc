<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cron extends MX_Controller  {
	 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('m_pengadaan','pengadaan');
	}
	
	function pengadaan()
	{  
        date_default_timezone_set('Asia/Jakarta');

        $auditupdated = date('Y-m-d H:i:s',strtotime('- 1 days'));
        
        $dataConfig = $this->db->get('configs')->row();

        $hour = $dataConfig->hour_cron;
        $time = date('Y-m-d H:i:s');
        $time = strtotime($time) + 60*60*$hour; // Add 1 hour
        $time = date('Y-m-d H:i:s', $time); // Back to string
      
        /* matikan script ini untuk testing */
        // if(date('Y-m-d 00:00:00')<$time){
        //   echo "Run cron disable. belum ".$hour. "jam dari jam 12 malam";
        //   return false;
        // }

        // $this->db->where('created_at >=',date('Y-m-d'));
        // $this->db->order_by('created_at');
        // $latest = $this->db->get('pengadaan_pga',1);
        
        // if(count($latest->result_array()) > 0){
        //     if($time){

        //         $time2 = $latest->row()->created_at;
        //         $time2 = strtotime($time2) + 60*60*$hour; // Add 1 hour
        //        $time2 = date('Y-m-d H:i:s', $time2); // Back to string

        //         if(date('Y-m-d H:i:s') < $time2){
        //             echo "Run cron disable. belum ".$hour. "jam";
        //             return false;
        //         }

        //     }
        // }else{
        //   echo "Run cron disable. belum ".$hour. "jam";
        //   return false;
        // }
        /* matikan script ini untuk testing */

		$limit = false; // 100 ;
        $total = count($this->pengadaan->getPengadaanTotal($limit,$offset=false,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$auditupdated)->result_array());

        $data = $this->pengadaan->getPengadaan($total,$offset=false,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$auditupdated)->result();

        foreach ($data as $key => $value) {
       		foreach ($value as $key2 => $value2) {
            $dataSave[$key2] = $value2=='' ? 0 : $value2;
       		}
          // echo "<pre>";
          // print_r($dataSave);
          // echo "</pre>";
       	  	$dataSave['created_at'] = date('Y-m-d H:i:s');
       		  $this->db->insert('pengadaan_pga',$dataSave);

        }

        echo "1 day before is ".  $auditupdated."<br>";
        echo $total. " New Data Inserted";
			
	}

    function cekserverlpse(){

        date_default_timezone_set('Asia/Jakarta');

        # konfigurasi, ganti nilai limit jadi false untuk mengecek semua server LPSE
        $limit=false; // false;

        if($limit!=false)$this->db->limit($limit);
        $data = $this->db->get('lpse')->result();
        foreach ($data as $value) {
            if($this->visit($value->url)){
                $status=1;
            }else{
                $status=0;
            }

            $this->db->where('created_date',date('Y-m-d'));
            $this->db->where('lpse_id',$value->id);
            $get = $this->db->get('server_history')->result();

            if(count($get) > 0){

                foreach ($get as $value2) {
                    $jsonData = $value2->status;
                }
                $decode = json_decode($jsonData,true);

                $decode2[0]['time'] = date('H:i:s');
                $decode2[0]['status'] = $status;
                
         
                $new = array_merge($decode2,$decode);

                $dataInsert['status']= json_encode($new);
                $this->db->where('created_date',date('Y-m-d'));
                $this->db->where('lpse_id',$value->id);
                $this->db->update('server_history',$dataInsert);

               
            }else{
                $jsonData[0]['time'] = date('H:i:s');
                $jsonData[0]['status'] = $status;
                $dataInsert['lpse_id'] = $value->id;
                $dataInsert['created_date'] = date('Y-m-d');
                $dataInsert['status']= json_encode($jsonData);
                $this->db->insert('server_history',$dataInsert);
            }
        }
    }

    function Visit($url){
       $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
       curl_setopt ($ch, CURLOPT_URL,$url );
       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch,CURLOPT_VERBOSE,false);
       curl_setopt($ch, CURLOPT_TIMEOUT, 5);
       curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt($ch,CURLOPT_SSLVERSION,3);
       curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
       $page=curl_exec($ch);
       //echo curl_error($ch);
       $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
       curl_close($ch);
       if($httpcode>=200 && $httpcode<300) return true;
       else return false;
}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */