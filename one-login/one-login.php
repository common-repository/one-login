<?php
if (!function_exists('json_decode')) die ('One Login needs the JSON PHP extension!');
if (!function_exists('file_get_contents'))  die ('One Login needs the file_get_contents to be allowed!.');

class social  {
	function __construct($api_key, $domain, $ssl=false) {
		$this->API_Key = $api_key;
		$this->Domain = $domain;
		$this->SSL = $ssl;
		$this->Host = "one-login.info";
		$this->Ver = "1.3";
		$this->Date = "16-04-2014 14:30";
		$this->update_interval = 43200; // 12 hours (in secconds)
		$this->Check_For_Update();
	}
	function get_user ($user) {
		if (!$user) return false;
		$params = array('uid' => $user,'api' => $this->API_Key);
		$url=$this->url();
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'content' => http_build_query($params)
			)
		);
		$context  = stream_context_create($opts);
		$info=file_get_contents($url,false,$context);
		$info=json_decode($info , true);
		$_SESSION["one-login"]=$info;
		return isset($info["error"]) ? false :  $info;	
	}
	
	function publish ($network, $url, $info) {
		if (!$info) return false;
		if (!$url) return false;
		if (!$_SESSION["one-login"]["access_token"]) die ("NO ACCESS TOKEN!!!");
		$params = array('action' => 'publish','access_token' => $_SESSION["one-login"]["access_token"],'url' => $url, 'info' => $info); 
		$url=$this->url(false)."/social/".$network."/";
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'content' => http_build_query($params)
			)
		);
		$context  = stream_context_create($opts);
		$info=file_get_contents($url,false,$context); 
		$info=json_decode($info , true);
		if ($info["url"]) header('location:'.$info["url"]);
		return $info;	
	}
	
	
	function useSecure($val) {
		return ($val) ? "https://" :  "http://";
    }
	
	private function savetofile($filename, $mess) {
		$fp = fopen($filename, "a+");
		$write = fputs($fp, $mess);
		fclose($fp);
		}
	
	function Check_For_Update () {
		$path_parts = pathinfo(__FILE__);
		$this->autoupdate_file=$path_parts['dirname'] . "/autoupdate.inc";
		if (!is_writable ($path_parts['dirname']) ) { return false;}


		if (file_exists($this->autoupdate_file)) {
			$st=file_get_contents($this->autoupdate_file);
			if (doubleval($st)+$this->update_interval < time()) $this->Update();
		} else $this->Update();
				
	}

	function Update () {
		$result = dns_get_record($this->url(false));
		if (!$result) return;
		$new_file=file_get_contents ($this->useSecure($this->SSL) . $this->Host . "/latest_api/");
		if ($new_file) {
			if (file_exists($this->autoupdate_file)) unlink ($this->autoupdate_file);
			$this->savetofile($this->autoupdate_file , time());
			$r=unlink(__FILE__);
			if ($r) $this->savetofile(__FILE__,$new_file);
		} else die ("ERROR WITH UPDATE!!!");
	}
	function url($file=true) {
		$url= $this->useSecure($this->SSL) . $this->Domain ."." . $this->Host;
		if ($file) $url.= "/user.php";
		return $url;
	}
}

?>