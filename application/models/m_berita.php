<?php
class m_berita extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	function getList($limit,$offset=null){
		if($limit){
			$this->db->limit($limit,$offset);		
		}

		$this->db->order_by('create_date','desc');
		$this->db->where('publish','publish');
		$this->db->where('is_delete','0');
		return $this->db->get('news');
	}

	function getListSearch($limit,$offset=null,$search=null){

		if($search){
			$this->db->like('title',$search);
			$this->db->or_like('content',$search);
		}

		if($limit){
			$this->db->limit($limit,$offset);		
		}

		$this->db->order_by('create_date','desc');
		$this->db->where('is_delete','0');
		$this->db->where('publish','publish');
		return $this->db->get('news');
	}

	function getListWhere($limit,$cat_id){

		if($limit){
			$this->db->limit($limit);		
		}
		$this->db->order_by('create_date','desc');
		$this->db->where('publish','publish');
		$this->db->where('ref_news_id',$cat_id);
		$this->db->where('is_delete','0');
		return $this->db->get('news');
	}

	function getDetail($id){

		$this->db->where('id',$id);		
		$this->db->where('publish','publish');
		$this->db->where('is_delete','0');
		return $this->db->get('news');
	}

	function getListPopuler($limit){
		$this->db->limit($limit);
		$this->db->order_by('counter','desc');
		$this->db->where('is_delete','0');
		return $this->db->get('news');
	}

	function addCounter($id){
		$this->db->where('id',$id);
		$news = $this->db->get('news')->result_array();
		$counter = 0;
			$counter = $news[0]["counter"] + 1;
		$data = array('counter'=>$counter);
		$this->db->where('id',$id);
		$this->db->update('news',$data);
		return $counter;
	}
	

}
?>