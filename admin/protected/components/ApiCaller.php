<?php 

class ApiCaller {

	protected $service_url;

	public function __construct() {
	}

	public function setServiceUrl($url) {
		$this->service_url = $url;
	}

	public function post($post_data = array()) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($curl, CURLOPT_URL, $this->service_url);
		$curl_response = curl_exec($curl);

		if ($curl_response === false) {
    		$info = curl_getinfo($curl);
    		curl_close($curl);
    		die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		
		return $curl_response;
	}
}
