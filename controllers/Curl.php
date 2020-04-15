<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class Curl extends CI_Controller {

  public function __construct(){
    parent::__construct();
  }

  public function Index(){

  }
  function login($url,$login,$pass){

   $ch = curl_init();

   
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_COOKIESESSION, true);
   // откуда пришли на эту страницу
   curl_setopt($ch, CURLOPT_REFERER, $url);
   // cURL будет выводить подробные сообщения о всех производимых действиях
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS,"username=".$login."&password=".$pass);
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36");
   curl_setopt($ch, CURLOPT_HEADER, 1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //сохранять полученные COOKIE в файл
   curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'].'/cookievezetvsem.txt');
   $result=curl_exec($ch);

   curl_close($ch);

   return $result;
}

function mainParser( $url )// парсер с кукисами
{

  $ch = curl_init( $url );

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
  curl_setopt($ch, CURLOPT_COOKIESESSION, true);
  curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
  curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36");  // useragent
  curl_setopt($ch, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'].'/cookievezetvsem.txt'); //хотя тут скорей всего он не записывает, а после каждого прохода вновь обращается к этому файлу
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
  curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа


  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );

  $header['errno']   = $err;
  $header['errmsg']  = $errmsg;
  $header['content'] = $content;
  return $header;
}


$urlAut = "https://auth.vezetvsem.ru/auth/login";
login($urlAut,"XXX","XXX");

$result = mainParser("http://www.vezetvsem.ru/listing");
$page = $result['content'];

echo $page;

?>
}
