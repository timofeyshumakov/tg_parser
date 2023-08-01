<?php
//$page = file_get_contents('https://api.investing.com/api/financialdata/13678/historical/chart/?interval=P1M&pointscount=70');
	// Открываем файл в нужном нам режиме. Нам же, нужно его создать и что то записать.
	//$fp = fopen("C:\papki\work\1)Programming\web\le.txt", "w");//поэтому используем режим 'w'
	// записываем данные в открытый файл
	//fwrite($fp, $page);
	//не забываем закрыть файл, это ВАЖНО
	//fclose($fp);
//$url = 'https://www.google.com.ua/logos/doodles/2016/earth-day-2016-5741289212477440.4-5728116278296576-ror.jpg';
//$path = 'C:\papki' . '\my-img.jpg';
//file_put_contents($path, file_get_contents($url));

$URL = "https://tgstat.ru/channel/q4Qb01d0xsA2YzUy"; // URL-адрес POST 
//$sPD = "name=Jacob&bench=150"; // Данные POST
$HTTP = array(
  'http' => // Обертка, которая будет использоваться
    array(
    'method'  => 'GET', // Метод запроса
    // Ниже задаются заголовки запроса
    'header'  => 'Content-type: application/x-www-form-urlencoded',
//    'content' => $sPD
	'User-Agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36'
  )
);
$context = stream_context_create($HTTP);
$txt = file_get_contents($URL, false, $context);
 $path = '';

// текущее время
//echo date('h:i:s') . "\n";

// ожидание в течениe 10 секунд
//sleep(1);

// завершение ожидания
//echo date('h:i:s') . "\n";

$searcher   = '<small>';



$num1= mb_stripos($txt, $searcher);
$searcher   = ', ';
$len = mb_strlen($searcher);
$num1= mb_stripos($txt, $searcher,$num1)+$len;

$searcher   = '<';
$num2 = mb_stripos($txt, $searcher,$num1);


$date_check = mb_substr($txt,$num1,$num2-$num1,'UTF-8');
$date_check = str_replace(':', '',$date_check);
$date_check = (int)$date_check;

 $channel = '\играй_в_плюс';

if ($date_check > $last_date){
	$searcher='<div class="post-text">';
	$len = mb_strlen($searcher);
	$num1=mb_stripos($txt, $searcher,$num1,'UTF-8')+$len;
		 $searcher   ='</div>';
$num2=mb_stripos($txt, $searcher,$num1);
	$post_text = mb_substr($txt,$num1,$num2-$num1,'UTF-8');
		$fp = fopen("C:\papki\work\Bets\database" . $channel . $date_check . ".txt", "w");//поэтому используем режим 'w'
	fwrite($fp, $post_text);
	fclose($fp);
	$searcher='<img class="post-img-img" src="';
	$len = mb_strlen($searcher);
	$num1=mb_stripos($txt, $searcher,$num1,'UTF-8')+$len;
	 $searcher   ='"';
$num2=mb_stripos($txt, $searcher,$num1);
$img_url = mb_substr($txt,$num1,$num2-$num1,'UTF-8');


$path_to_parse = $path . $channel . $date_check . '.jpg';
	file_put_contents($path_to_parse, file_get_contents($img_url));
}
//$date_check = $last_date


   ?>
   
   
   