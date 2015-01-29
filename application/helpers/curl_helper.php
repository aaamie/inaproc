<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('curl'))
{

	function curlAPI($api){


			switch ($api) {
				case 'prov':
					$cache = APPPATH.'/cache/isb_propinsi.php';
					break;
				case 'kab':
					$cache = APPPATH.'/cache/isb_kabkota.php';
					break;
				case 'instansi':
					$cache = APPPATH.'/cache/isb_instansi.php';
					break;
				case 'lpse':
					$cache = APPPATH.'/cache/isb_lpse.php';
					break;
				default:
					# code...
					break;
			}

		$myfile = fopen($cache, "r") or die("Unable to open file!");
		$read  = fread($myfile,filesize($cache));
		fclose($myfile);
		return json_decode($read,true);
	}



	// function curlAPI($api)
	// {
	// 	try {
			
	// 		switch ($api) {
	// 			case 'prov':
	// 				$url = "https://inaproc.lkpp.go.id/isb/api/3e6ca70b-4b7f-4306-966b-8f22d6a1f8d2/json/12915635/MasterPropinsi/tipe/0/parameter/0";
	// 				break;
	// 			case 'kab':
	// 				$url = "https://inaproc.lkpp.go.id/isb/api/da8d7fad-4f43-4418-a109-66c3130f48c7/json/12915627/MasterKabupaten/tipe/4/parameter/1";
	// 				break;
	// 			case 'instansi':
	// 				$url = "https://inaproc.lkpp.go.id/isb/api/b6870b3b-f763-45b3-9c2c-bde1d088aaa1/json/12915666/MasterInstansi/tipe/0/parameter/0";
	// 				break;
	// 			case 'lpse':
	// 				$url = "https://inaproc.lkpp.go.id/isb/api/f0334e7b-b212-4430-a7dd-4598c24d02c2/json/12408694/MasterLPSE/tipe/91/parameter/2005-01-01";
	// 				break;
	// 			default:
	// 				# code...
	// 				break;
	// 		}
			
	// 		$ch = curl_init();  
	// 		curl_setopt($ch, CURLOPT_URL,$url);
	// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// 		curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
	// 		$response = curl_exec($ch); 
	// 		curl_close($ch); 

	// 		return json_decode($response,true);

	// 	} catch (Exception $e) {
	// 		return array();
	// 	}

	// }
}
?>