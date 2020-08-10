<?php


require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client as Client;

$client = new Client([
    'base_uri' => 'https://whoer.net/ru',
    'verify'  => false,
    'allow_redirects' => false,
    'cookies' => true,
    'headers' => [                         // устанавливаем различные заголовки
        'User-Agent'   => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
        'Accept'       => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Content-Type' => 'application/x-www-form-urlencoded' // кодирование данных формы, в такой кодировке
    ],
//    'proxy' => 'tcp://165.225.106.61:10605'
]);

$client = new GoutteClient();
$client->setClient(new GuzzleHttpClient(['proxy' => 'http://195.181.161.229:80']));


$html = $client->request("GET", '/', [
//        'proxy' => 'http://195.181.161.229:80',
]);

echo $html->getBody()->getContents();






















////$url = 'https://hidemy.name/ru/proxy-list/';
//$url = 'https://slivcours.ru/';
//
//
//$client = new Client([
//    'base_uri' => $url,
//    'verify'  => false,
//    'allow_redirects' => false,
//    'cookies' => true,
//    'headers' => [                         // устанавливаем различные заголовки
//        'User-Agent'   => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
//        'Accept'       => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
//        'Content-Type' => 'application/x-www-form-urlencoded' // кодирование данных формы, в такой кодировке
////            браузер отсылает данные на сервер
//    ]
//]);
//
//$login = $client->request('POST', '/pages/auth.php', [
//        'form_params' => [
//            'login' => 'ivan',
//            'password' => 'ivanivanivan',
//            'do_login' => '',
//        ]
//]);
//
//$cookie = $login->getHeaderLine('Set-Cookie' );
//
//$discounts = $client->request('GET','/index.php',[
//    'headers' => [
//        'Cookie' => $cookie
//    ],
////    'debug' => true // если захотите посмотреть что-же отправляет ваш скрипт, расскоментируйте
//]);
//
//$html = $discounts->getBody()->getContents();
//
//
//
//echo file_get_contents($html);


