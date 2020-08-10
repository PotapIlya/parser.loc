<?php


require_once 'files/simple_html_dom.php';

class Proxy
{
	private $url ='https://hidemy.name/ru/proxy-list/';

	function __construct()
	{

		$this->iAmBrouser();
		$this->parse();
	}


	private function parse()
	{

		echo $this->iAmBrouser($this->url);

	}
	private function iAmBrouser()
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.7.62 Version/11.01');
		$res = curl_exec($curl);
		curl_close($curl);

		return $res;
	}


}
new Proxy();