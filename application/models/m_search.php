<?php
class m_search extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getGlobalSearchTotal($search){

		
		$query = $this->db->query( 'SELECT count(title) as total FROM (
										    SELECT title, content, file_image, create_date, is_delete,"berita" as tipe FROM news 
										    UNION
										    SELECT nama as title, alamat as content,file_image,created_at as create_date, deleted_flag as is_delete,"lpse" as tipe FROM lpse
										    UNION
										    SELECT title, content, file_image,create_date, is_delete,"eproc" as tipe FROM eproc 
										    UNION
										    SELECT nama_penyedia as title, sk as content,file_image, create_date, is_delete, "daftarhitam" as tipe FROM daftar_hitam 
										) 
							AS t WHERE is_delete="0" AND (title like "%'.$search.'%" or content like "%'.$search.'%") ORDER BY create_date DESC' );

		
		return $query;
	}

	function getGlobalSearch($limit,$offset=null,$search=null){

		$offset = $offset == null ? 0 : $offset;
		
	
		$query = $this->db->query( 'SELECT * FROM (
										    SELECT id, title, content, file_image, create_date, is_delete,"berita" as tipe FROM news 
										    UNION
										    SELECT id, nama as title, alamat as content,file_image, created_at as create_date, deleted_flag as is_delete,"lpse" as tipe FROM lpse
										    UNION
										    SELECT id, title, content, file_image, create_date, is_delete,"eproc" as tipe FROM eproc 
										    UNION
										    SELECT id, nama_penyedia as title, sk as content, file_image,create_date, is_delete, "daftarhitam" as tipe FROM daftar_hitam 
										) 
							AS t WHERE is_delete="0" AND (title like "%'.$search.'%" or content like "%'.$search.'%") ORDER BY create_date DESC limit '.$limit.' offset '.$offset.'' );

		//echo $this->db->last_query();
		return $query;
	}

	
}
?>