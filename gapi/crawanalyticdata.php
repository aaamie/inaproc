<?php
define('ga_email','itsmegoens@gmail.com');
define('ga_password','zakatdansedekah');
define('ga_profile_id','91592938');

require 'gapi.class.php';

$ga = new gapi(ga_email,ga_password);

//$ga->requestReportData(ga_profile_id,array('browser','browserVersion'),array('pageviews','visits'));
  

$ga->requestReportData(ga_profile_id,array('pagePath','date'),array('visits','pageviews'),'-pageviews',$filter=null,$segment=null,$start_date=null,$end_date=null,$start_index=1,$max_results=10);

// echo "<pre>";
// print_r($ga->getResults());
// echo "</pre>";

foreach ($ga->getResults() as $result) {
  echo $result->getPagePath() .'   '. $result->getPageviews(). '  '.$result->getDate();
  echo "<br>";
}       
        
?>

