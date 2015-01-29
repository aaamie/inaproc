<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends MX_Controller  {

	 
	function __construct()
	{
		parent::__construct();
		$this->load->model('configs/model_configs', 'configs');
		$this->load->model('dashboard/model_dashboard', 'dashboard');
		$this->lang->load('elemen_layout', 'indonesia');
	}
	
	public function setheader()
	{
		return Modules::run('layout/setheader');
	}

	public function setfooter()
	{
		return Modules::run('layout/setfooter');
	}
	 
	public function auth()
	{
		return Modules::run('auth/privateAuth');
	}
	
	public function forbiddenAuth()
	{
		return Modules::run('auth/forbiddenAuth');
	}

	function index()
	{
		$this->auth();
		$this->forbiddenAuth();
		$this->grid();
	}
	
	function grid($err=NULL)
	{
		$this->setheader();
		$contents = $this->grid_content($err);

		define('ga_email','aXRzbWVnb2Vuc0BnbWFpbC5jb20=');
		define('ga_password','emFrYXRkYW5zZWRla2Fo');
		define('ga_profile_id','91592938');

		require './gapi/gapi.class.php';

		$ga = new gapi(base64_decode(ga_email) ,base64_decode(ga_password) );

		$filter                 = 'pagePath=~inaproc\?*';
		$ga->requestReportData(ga_profile_id,array('pagePath','date'),array('visits','pageviews'),'-pageviews',$filter,$segment=null,$start_date=null,$end_date=null,$start_index=1,$max_results=10);


		foreach ($ga->getResults() as $result) {
		  // $result->getPagePath() .'   '. $result->getPageviews(). '  '.$result->getDate();
		  
		  $list[] = array('page'=>$result->getPagePath(),
		  				  'pageviews'=>$result->getPageviews()
		  	);
		}       
		      

		$data = array(
				  'base_url' => base_url(),
				  'contents' => $contents,
				  'list'=>$list
				  				  );
		$this->parser->parse('layout/contents.html', $data);
		
		$this->setfooter();
	}
	
	function grid_content($err=NULL)
	{
		$q = $this->configs->getDetail("configs",1);
		$r = $q->row();
		$site_name = $r->meta_title;
		
		$year = date("Y",now());
		
		$data = array(
				  'base_url' => base_url(),
				  'site_name'=>$site_name,
				  'year'=>$year
				  );
		return $this->parser->parse('dashboard.html', $data, TRUE);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */