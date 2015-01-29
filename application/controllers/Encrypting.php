<?php
class Encrypting {
	function encrypt($string, $key) {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}

		return base64_encode($result);
	}

	function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);

		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}

		return $result;
	}


	function decrypt2($sData, $sKey='mysecretkey')
	{
	  $sResult = '';

	  $sData = str_replace('-', '+', $sData);
	  $sData = str_replace('_', '/', $sData);

	  $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND);
	  $sResult = trim(mcrypt_decrypt(MCRYPT_BLOWFISH, $sKey, base64_decode($sData), MCRYPT_MODE_ECB, $iv));

	  return $sResult;
	}
}
?>