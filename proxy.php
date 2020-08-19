<?php

require_once __DIR__.'/vendor/autoload.php';
require_once 'files/simple_html_dom.php';

use GuzzleHttp\Client as Client;

class Proxy
{
//	private $url ='https://hidemy.name/ru/proxy-list/';
//	private $url = 'https://2ip.ru/';
//    private $url = 'https://kwork.ru/projects?c=11&page=1';


	function __construct()
	{
		$this->parse();
	}
	private function parse()
	{

	    $this->iAmBrouser();
//	    $html = $this->iAmBrouser();
//	    echo $html;
//	    if (!empty($html))
//		{
//			$array = [];
//
//			foreach (str_get_html($html)->find('.table_block tbody tr') as $i=>$item)
//			{
//				$array[$i]['ip'] = $item->children(0);
//				$array[$i]['port'] = $item->children(1);
//			}
//			foreach ($array as $item)
//			{
//				echo 'ip => '.$item['ip'].'<br>';
//				echo 'port => '.$item['port'].'<br><hr>';
//			}
//		}
	}
	private function iAmBrouser()
	{

		$client = new Client([
			'verify'  => false,
			'allow_redirects' => false,
//			'cookies' => true,
			'headers' => [                         // устанавливаем различные заголовки
				'User-Agent'   => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
				'Accept'       => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Content-Type' => 'application/x-www-form-urlencoded'
			],
//    'proxy' => 'tcp://165.225.106.61:10605'
		]);


        $http = $client->request("GET", 'https://2ip.ru/', [
            'proxy' => 'tcp://165.227.35.11:80'
//			'proxy' => 'http://username:password@165.227.35.11:80'
		]);

		echo $http->getBody();

//
//		if ($http->getStatusCode() === 200)
//		{
//			return $http->getBody();
//		} else{
//			return false;
//		}
	}
}
new Proxy();