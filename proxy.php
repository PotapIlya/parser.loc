<?php


require_once 'files/simple_html_dom.php';

class Proxy
{
//	private $url ='https://hidemy.name/ru/proxy-list/';
	private $url = 'https://2ip.ru/';


	private $proxy = '88.198.50.103:3128';
	private $proxytype = 'HTTP';

	function __construct()
	{

//		$this->parse();
//
		$this->test();
	}

    private function test()
    {
        echo $this->iAmBrouser();
//        echo str_get_html($html)->find('big[id=d_clip_button]', 0);


    }
	private function parse()
	{

	    $html = $this->iAmBrouser();
	    $array = [];

	    foreach (str_get_html($html)->find('.table_block tbody tr') as $i=>$item)
        {
            $array[$i]['ip'] = $item->children(0);
            $array[$i]['port'] = $item->children(1);
        }


	    foreach ($array as $item)
        {
            echo 'ip => '.$item['ip'].'<br>';
            echo 'port => '.$item['port'].'<br><hr>';
        }

	}
	private function iAmBrouser()
	{
		$curl = curl_init($this->url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_HEADER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.7.62 Version/11.01');

		curl_setopt($curl, CURLOPT_PROXY, '138.68.2.224:3128');
		curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

		curl_setopt($curl, CURLOPT_TIMEOUT, 9);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 6);

		$res = curl_exec($curl);
		curl_close($curl);

		return $res;
	}


}
new Proxy();