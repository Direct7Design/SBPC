<?php

class SpaceBukkitAPI {
	private $hostname;
    private $spacebukkit_port;
    private $spacebukkitrtk_port;
	private $salt;
	
	public function __construct ($hostname, $spacebukkit_port, $spacebukkitrtk_port, $salt) {
		$this->hostname = $hostname;
        $this->spacebukkit_port = $spacebukkit_port;
        $this->spacebukkitrtk_port = $spacebukkitrtk_port;
		$this->salt = $salt;
	}
	
	public function call($method, array $args = array(), $isRTK = false) {        
        if ($isRTK)
        	$port = $this->spacebukkitrtk_port;
        else
        	$port = $this->spacebukkit_port;       
		$url = sprintf("http://%s:%s/call?method=%s&args=%s&key=%s", $this->hostname, $port, rawurlencode($method), rawurlencode(json_encode($args)), hash('sha256', $method . $this->salt));
		if ($method == "downloadWorld")
			return $url;
		else {
			$value = $this->curl($url, $port);
			return json_decode($value, true);
		}
	}
	
	private function curl($url, $port) {
		$c = curl_init($url);
		curl_setopt($c, CURLOPT_PORT, $port);
		curl_setopt($c, CURLOPT_HEADER, false);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($c);
		curl_close($c);
		return $result;
	}
}