<?php
class m_pengadaan extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getPengadaanTotal($limit=false,$offset=null,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$auditupdated=false){

	# postgre connection
    $this->db2 = $this->load->database('postgre', TRUE);  

    $offset = $offset==null ? 0 : $offset;
    // $limit =  $limit==false ? 9 : $limit;
    
  
    $where = '';
    // if($propinsi_id)
    // {
    // 	$where .= "AND kgr_id=".$kgr_id."";
    // }
    if($kgr_id)
    {
    	$where .= " AND p.kgr_id=".$kgr_id."";
    }
    


    if($auditupdated){

       $where .= "AND p.auditupdatedce >='".$auditupdated."'"; 
    }

 
    if($pkt_nama)
    {
    	$where .= " AND lower(p.pkt_nama) like '%".$pkt_nama."%'";
    }
    
    if($satuan_kerja)
    {
    	$where .= " AND lower(s.stk_nama) like '%".$satuan_kerja."%'";
    }
    
    if($kls_id)
    {
    	//(string) $kls_id;
    	$where .= " AND p.kls_id='".$kls_id."'";
    }

    if($propinsi_id)
    {
    	//(string) $kls_id;
    	//$where .= " AND substr( CAST (l.lls_id AS text), 5)='".$propinsi_id."'";
    }

    if($lpse_id)
    {
        //(string) $kls_id;
        $where .= " AND substr( CAST (l.lls_id AS text), 5)='".$lpse_id."'";
    }


    if($pkt_hps)
    {
    	switch ($pkt_hps) {
    		case 'less500':
    			$where .= " AND pkt_hps<500000000";
    			break;
    		case '5001M':
    			$where .= " AND pkt_hps > 500000000 AND pkt_hps < 1000000000";
    			break;
    		case 'more1M':
    			$where .= " AND pkt_hps > 1000000000";
    			break;
  
    	}
    	
    }

   
	
	//$query = $this->db2->query('SELECT * FROM paket');   
	$query =	$this->db2->query("SELECT l.lls_id,substr( CAST (l.lls_id AS text), 5) as lpse_id, p.pkt_id, p.pkt_nama, p.pkt_pagu, p.pkt_hps, 
					ag.agc_nama, s.stk_nama, p.kgr_id , p.kls_id,  l.mtd_pemilihan, mtd_id, ag.agc_website, j.dtj_tglawal,j.dtj_tglakhir,
					mtd_evaluasi, lls_kontrak_pembayaran, lls_kontrak_tahun, 
					lls_kontrak_sbd, l.lls_bobot_teknis, l.lls_bobot_biaya FROM 
					lelang_seleksi l LEFT JOIN paket p ON l.pkt_id=p.pkt_id  LEFT JOIN jadwal j ON l.lls_id=j.lls_id LEFT JOIN 
					satuan_kerja s ON p.stk_id=s.stk_id LEFT JOIN agency ag ON 
					s.agc_id=ag.agc_id where j.dtj_tglawal is not null $where
					order by j.dtj_tglawal desc");
	
			// WHERE l.lls_id=?
	return $query;

	}

	function getPengadaan($limit=false,$offset=null,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$auditupdated=false){

	# postgre connection
    $this->db2 = $this->load->database('postgre', TRUE);  

    $offset = $offset==null ? 0 : $offset;
    // $limit =  $limit==false ? 9 : $limit;
    
    // if($limit!=false){
    // 	 $queryLimit = "limit ".$limit."";
    // }else{
    // 	$queryLimit = "";
    // }

    $where = '';
    // if($propinsi_id)
    // {
    // 	$where .= "AND kgr_id=".$kgr_id."";
    // }
    if($kgr_id)
    {
    	$where .= " AND p.kgr_id=".$kgr_id."";
    }
    
    if($kls_id)
    {
    	//(string) $kls_id;
    	$where .= " AND p.kls_id='".$kls_id."'";
    }

    if($pkt_nama)
    {
    	$where .= " AND lower(p.pkt_nama) like '%".$pkt_nama."%'";
    }
    
     if($satuan_kerja)
    {
    	$where .= " AND lower(s.stk_nama) like '%".$satuan_kerja."%'";
    }


    if($propinsi_id)
    {
    	//(string) $kls_id;
    	//$where .= " AND substr( CAST (l.lls_id AS text), 5)='".$propinsi_id."'";
    }

    if($lpse_id)
    {
        //(string) $kls_id;
        $where .= " AND substr( CAST (l.lls_id AS text), 5)='".$lpse_id."'";
    }

    if($pkt_hps)
    {
    	switch ($pkt_hps) {
    		case 'less500':
    			$where .= " AND pkt_hps<500000000";
    			break;
    		case '5001M':
    			$where .= " AND pkt_hps > 500000000 AND pkt_hps < 1000000000";
    			break;
    		case 'more1M':
    			$where .= " AND pkt_hps > 1000000000";
    			break;
  
    	}
    	
    }

   if($auditupdated){

       $where .= "AND p.auditupdatedce >='".$auditupdated."'"; 
    }

 

	$query =	$this->db2->query("SELECT l.lls_id,substr( CAST (l.lls_id AS text), 5) as lpse_id, p.pkt_id, p.pkt_nama, p.pkt_pagu, p.pkt_hps, 
					ag.agc_nama, s.stk_nama, p.kgr_id , p.kls_id,  l.mtd_pemilihan, mtd_id, ag.agc_website, j.dtj_tglawal,j.dtj_tglakhir,
					mtd_evaluasi, lls_kontrak_pembayaran, lls_kontrak_tahun, p.auditupdatedce,
					lls_kontrak_sbd, l.lls_bobot_teknis, l.lls_bobot_biaya FROM 
					lelang_seleksi l LEFT JOIN paket p ON l.pkt_id=p.pkt_id  LEFT JOIN jadwal j ON l.lls_id=j.lls_id LEFT JOIN 
					satuan_kerja s ON p.stk_id=s.stk_id LEFT JOIN agency ag ON 
					s.agc_id=ag.agc_id where j.dtj_tglawal is not null $where
					order by j.dtj_tglawal desc  limit ".$limit." OFFSET ".$offset."  ");
	// $query = $this->db2->query('SELECT * FROM paket p LEFT JOIN  lelang_seleksi l ON p.pkt_id=l.pkt_id 
	// 	LEFT JOIN jadwal j ON l.lls_id=j.lls_id
	// 	');   
			// WHERE l.lls_id=?
	//echo $this->db2->last_query();
	return $query;

	}

   
    function getPengadaanPGA($limit=false,$offset=null,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$detail=false){

        if($limit) $this->db->limit($limit,$offset);
        if($kgr_id) $this->db->where('kgr_id',$kgr_id);
        if($pkt_hps) $this->db->where('pkt_hps',$pkt_hps);
        if($lpse_id)  $this->db->where('lpse_id',$lpse_id);
        if($pkt_nama) $this->db->like('lower(pkt_nama)',$pkt_nama);
        if($satuan_kerja) $this->db->like('lower(satuan_kerja)',$satuan_kerja);


        $this->db->order_by('dtj_tglawal','desc');
        if(!$detail) $this->db->group_by('lpse_id');
        $this->db->group_by('pkt_nama');
        $query = $this ->db->get('pengadaan_pga');
        return $query;
    }

     function getPengadaanPGARand($limit=false,$offset=null,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$detail=false){

        if($limit) $this->db->limit($limit,$offset);
        if($kgr_id) $this->db->where('kgr_id',$kgr_id);
        if($pkt_hps) $this->db->where('pkt_hps',$pkt_hps);
        if($lpse_id)  $this->db->where('lpse_id',$lpse_id);
        if($pkt_nama) $this->db->like('lower(pkt_nama)',$pkt_nama);
        if($satuan_kerja) $this->db->like('lower(satuan_kerja)',$satuan_kerja);

        $this->db->order_by('pkt_nama','RANDOM');
        // if(!$detail) $this->db->group_by('lpse_id');
        $this->db->group_by('lpse_id');
        //$this->db->group_by('pkt_nama');
        $query = $this ->db->get('pengadaan_pga');
        return $query;
    }

    function getPengadaanPGATotal($limit=false,$offset=null,$propinsi_id=false,$kgr_id=false,$pkt_hps=false,$kls_id=false,$pkt_nama=false,$satuan_kerja=false,$lpse_id=false,$detail=false){
       
        if($kgr_id) $this->db->where('kgr_id',$kgr_id);
        if($pkt_hps) $this->db->where('pkt_hps',$pkt_hps);
        if($lpse_id)  $this->db->where('lpse_id',$lpse_id);
        if($pkt_nama) $this->db->like('lower(pkt_nama)',$pkt_nama);
        if($satuan_kerja) $this->db->like('lower(satuan_kerja)',$satuan_kerja);
        $this->db->select('id as total');
        if(!$detail) $this->db->group_by('lpse_id');
        $this->db->group_by('pkt_nama');

        $query = $this->db->get('pengadaan_pga');
        return $query;
    }

    function getPengadaanTotalLelang($lpse_id){
         $this->db->where('lpse_id',$lpse_id);
         $this->db->group_by('pkt_nama');
         return $this->db->get('pengadaan_pga');
    }

	function getSyarat($lls_id){

		# postgre connection
    	$this->db2 = $this->load->database('postgre', TRUE);  
		return $this->db2->query("SELECT dl.dll_id, lls_id, chk_id, chk_nama, chk_id,c.ckm_id, ckm_nama
                                  FROM dok_lelang dl
                                  INNER JOIN checklist c ON dl.dll_id=c.dll_id
                                  INNER JOIN checklist_master cm ON c.ckm_id=cm.ckm_id
                                  where lls_id=".$lls_id."
        ");
	}


	function getKontrak($lls_id){

		# postgre connection
    	$this->db2 = $this->load->database('postgre', TRUE);  
		return $this->db2->query('SELECT lls_kontrak_pembayaran,lls_kontrak_tahun,lls_kontrak_sbd FROM lelang_seleksi WHERE lls_id= '.$lls_id.' limit 5');
	}


	function getTahap($lls_id){

		# postgre connection
    	$this->db2 = $this->load->database('postgre', TRUE);  
		return $this->db2->query('SELECT * FROM jadwal WHERE lls_id= '.$lls_id.' limit 5');
	}


	function getDetail($oid,$dtj_tglawal){

		# postgre connection
	    $this->db2 = $this->load->database('postgre', TRUE);  


		$query =	$this->db2->query("SELECT l.lls_id,substr( CAST (l.lls_id AS text), 5) as lpse_id, p.pkt_id, p.pkt_nama, p.pkt_pagu, p.pkt_hps, 
					ag.agc_nama, s.stk_nama, p.kgr_id , p.kls_id,  l.mtd_pemilihan, mtd_id, ag.agc_website, j.dtj_tglawal,j.dtj_tglakhir,
					mtd_evaluasi, lls_kontrak_pembayaran, lls_kontrak_tahun, 
					lls_kontrak_sbd, l.lls_bobot_teknis, l.lls_bobot_biaya FROM 
					lelang_seleksi l LEFT JOIN paket p ON l.pkt_id=p.pkt_id  LEFT JOIN jadwal j ON l.lls_id=j.lls_id LEFT JOIN 
					satuan_kerja s ON p.stk_id=s.stk_id LEFT JOIN agency ag ON 
					s.agc_id=ag.agc_id WHERE j.dtj_tglawal is not null AND j.dtj_tglawal='$dtj_tglawal' AND l.lls_id=$oid limit 1 ");
		

		// echo "<pre>";
		// print_r($query);
		// echo "</pre>";
		// die()
		// die();
		return $query;

	}

	function getlatest($limit=false){

	# postgre connection
    $this->db2 = $this->load->database('postgre', TRUE);  
   
	$query =	$this->db2->query("SELECT l.lls_id, p.pkt_id, p.pkt_nama, p.pkt_pagu, p.pkt_hps, 
					ag.agc_nama, s.stk_nama, p.kgr_id , p.kls_id,  l.mtd_pemilihan, mtd_id, ag.agc_website, j.dtj_tglawal,j.dtj_tglakhir,
					mtd_evaluasi, lls_kontrak_pembayaran, lls_kontrak_tahun, 
					lls_kontrak_sbd, l.lls_bobot_teknis, l.lls_bobot_biaya FROM 
					lelang_seleksi l LEFT JOIN paket p ON l.pkt_id=p.pkt_id  LEFT JOIN jadwal j ON l.lls_id=j.lls_id LEFT JOIN 
					satuan_kerja s ON p.stk_id=s.stk_id LEFT JOIN agency ag ON 
					s.agc_id=ag.agc_id  where j.dtj_tglawal is not null order by j.dtj_tglawal desc limit ".$limit." ");
	
			// WHERE l.lls_id=?
	return $query;

	}

    function getlatestPGA($limit=false){

    $this->db->order_by('dtj_tglawal','desc');
    $this->db->group_by('pkt_nama');
    $query = $this ->db->get('pengadaan_pga',$limit);
    return $query;

    }

    function getPengadaanTotalByLPSE($lpse_id){

        # postgre connection
        $this->db2 = $this->load->database('postgre', TRUE); 

        $where = '';
        if($lpse_id)
        {
            //(string) $kls_id;
            $where .= " AND substr( CAST (l.lls_id AS text), 5)='".$lpse_id."'";
        }

        $query =    $this->db2->query("SELECT l.lls_id,substr( CAST (l.lls_id AS text), 5) as lpse_id, p.pkt_id, p.pkt_nama, p.pkt_pagu, p.pkt_hps, 
                    ag.agc_nama, s.stk_nama, p.kgr_id , p.kls_id,  l.mtd_pemilihan, mtd_id, ag.agc_website, j.dtj_tglawal,j.dtj_tglakhir,
                    mtd_evaluasi, lls_kontrak_pembayaran, lls_kontrak_tahun, 
                    lls_kontrak_sbd, l.lls_bobot_teknis, l.lls_bobot_biaya FROM 
                    lelang_seleksi l LEFT JOIN paket p ON l.pkt_id=p.pkt_id  LEFT JOIN jadwal j ON l.lls_id=j.lls_id LEFT JOIN 
                    satuan_kerja s ON p.stk_id=s.stk_id LEFT JOIN agency ag ON 
                    s.agc_id=ag.agc_id where j.dtj_tglawal is not null $where
                    order by j.dtj_tglawal desc");

        return $query;
    }

    function counter($lls_id,$pkt_id,$dtj_tglawal){
        session_start();
        $this->db->select('counter');
        $this->db->where('lls_id',$lls_id);
        $this->db->where('pkt_id',$pkt_id);
        $this->db->where('dtj_tglawal',$dtj_tglawal);
        $query = $this->db->get('pengadaan_pga')->row_array();
     
        if(!isset($_COOKIE['counter_pengadaan'])){
             $counter = $query['counter'] + 1;

             $this->db->where('lls_id',$lls_id);
             $this->db->where('pkt_id',$pkt_id);
             $this->db->where('dtj_tglawal',$dtj_tglawal);
             $this->db->update('pengadaan_pga',array('counter'=>$counter));

             setcookie("counter_pengadaan", 'ada', time()+60*60*24); 
        }
    
    }
	

}
?>