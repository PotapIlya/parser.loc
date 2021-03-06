<?php



require_once './files/simple_html_dom.php';

class Parser
{
	public $number = 0;

	private $status = true;
	private $index = 0;

    private $url = null;
    private $defaultUrl = null;
    private $classWrapper = null;
    private $classData = null;
    private $classTitle = null;
    private $classHref = null;
    private $classPrice = null;
    private $classCategory = null;
    private $classText = null;


    function __construct($array)
    {
        $this->url = $array['url'];
        $this->defaultUrl = $array['url'];

        $this->classWrapper = $array['wrapper'];
        $this->classData = $array['data'];
        $this->classHref = $array['href'];
        $this->classTitle = $array['href'];
        $this->classPrice = $array['price'];
        $this->classCategory = $array['category'];
        $this->classText = $array['text'];

        if (!is_null($this->url))
        {
            $pdo = $this->pdo();
            $this->pages($pdo);
        }
    }
    private function pages($pdo){
        while ($this->status) {
            if ($this->checkUrl($this->url))
            {
                $this->index++;
                $this->url = $this->defaultUrl.$this->index;



                $this->serchHtml($this->url, $pdo);
            }
            else
            {
                $this->status = false;
            }
        }
    }

    private function serchHtml($url, $pdo)
    {
        $html = file_get_html($url);


        foreach ($html->find($this->classWrapper) as $i=>$wrapper)
        {

            $data = $wrapper->attr[$this->classData];

            $sth = $pdo->prepare("SELECT * FROM `parser` WHERE id_published=:id_published");
            $sth->execute(['id_published' => $data,]);
            $result = $sth->fetchAll();

//            var_dump($result);
//            echo '----------------------------------------------------------------------';

            if (!count($result))
            {
                $href = $wrapper->find($this->classHref, 0)->href;

                $sth = $pdo->prepare("INSERT INTO parser SET id_published=:id_published, title=:title, href=:href, price=:price, category=:category, text=:text");
                $sth->execute([
                    'id_published' => $data,
                    'title' => $wrapper->find($this->classTitle, 0)->innertext,
                    'href' => $href,
                    'price' => $wrapper->find($this->classPrice, 0),
                    'category' => $wrapper->find($this->classCategory, 0),
                    'text' => file_get_html($href)->find($this->classText, 0),
                ]);

                echo $this->number++.'da'.'<br>';
            }
            else
            {
                echo $this->number++.'net'.'<br>';
            }

        }
    }
    private function pdo()
    {
        $localhost = 'server135.hosting.reg.ru';
        $name = 'u0679512_potap';
        $pass = '6N0c8W9s';
        $db_name = 'u0679512_test1';
        return new PDO('mysql:dbname='.$db_name.'; host='.$localhost.'', $name, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    private function checkUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
//
//		$html = file_get_html($url);
//		$html = $html->find($this->classWrapper, 0);


//        if ($http === 200 && !is_null($html)) {{
        if ($http === 200) {
			return true;
		} else {
			return false;
		}
    }
}

//$array = [
//	'url' => 'https://freelancehunt.com/projects?tags[]=php&tags[]=javascript&tags[]=html&tags[]=CSS/HTML&tags[]=Vue.js&page=',
//	'wrapper' => '.table.table-normal.project-list tbody tr',
//	'data' => 'data-published',
//	'href' => 'a',
//	'title' => 'a',
//	'price' => '.text-green.price.with-tooltip',
//	'category' => 'td.left small',
//	'text' => '#project-description',
//];


//$array = [
//	'url' => 'https://kwork.ru/projects?c=11&page=',
//	'wrapper' => '.card.want-card.js-want-container',
//	'data' => 'data-id',
//	'href' => '.wants-card__header-title.first-letter.breakwords a',
//	'title' => '.wants-card__header-title.first-letter.breakwords a',
//	'price' => '.wants-card__header-price.wants-card__price.m-hidden',
//
//	'category' => 'td.left small',
//	'text' => '.wants-card__description-text.wish_name.first-letter.br-with-lh.break-word',
//];
$class = new Parser($array);



//echo file_get_html('https://freelancehunt.com/projects?tags[]=php&tags[]=javascript&tags[]=html&tags[]=CSS/HTML&tags[]=Vue.js&page=1');














//
//
//function requests($url, $postdata = null, $cookieFile = './files/file.txt')
//{
//    $ch = curl_init($url);
//
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36');
//
//    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
//    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
//
//
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//
////    curl_setopt($ch, CURLOPT_PROXY, '104.45.188.43:3128');
////    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLOPT_PROXY_HTTP);
//
//    curl_setopt($ch, CURLOPT_TIMEOUT, 9);
//    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
//
//
//    if ($postdata)
//    {
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
//    }
//
//    $html = curl_exec($ch);
//    curl_close($ch);
//    return $html;
//}



//function checkUrl($url)
//{
//	$ch = curl_init($url);
//	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//	curl_exec($ch);
//
//	$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//	curl_close($ch);
//
//	return $http;
//}
//
////$url = 'https://kwork.ru/projects?c=11&page=18';
////$html = checkUrl($url);
//
//$html = file_get_html($url);
//
//$res = $html->find('.card.want-card.js-want-container', 0);
//
//if (!is_null($res))
//{
//	echo 'da';
//}
//else
//{
//	echo 'net';
//}

