<?php

 $path = __DIR__.'\\database\\';
$token = "6055776005:AAGPEEGBcTlKNgKkee1CEUmdAyhBiCvnciw";


 $channels = array(
         "🔰ИГРАЙ В ПЛЮС 🔰 2.0", //0
         "Duck’Sliv | 🅑🅔🅣",  
         "Yakamoz", //2
         "НОРВЕЖСКИЙ ГЕНИЙ", //3
		 "Bablo Shik ⚜️", //4
		 "Аналитик USA 🇺🇸", 
		 "SlivPlatnikov | Слив платных прогнозов", //6
		 "STAR WARS SLIV - Битва Капперов", //7
		 "Продажный Хоккей",
		 "Миллионы на информации Ⓜ️", //9
		 "HockeyPRO | Бот ®️", //10
		 "Складчина🔐 🏴‍☠️", //11
		 "VIPSLIV |Слив VIP прогнозов БЕСПЛАТНО", //12
);
 $links = array(
         "https://tgstat.ru/channel/q4Qb01d0xsA2YzUy",
         "https://tgstat.ru/channel/AAAAAEvojvEfZ6TwS5tbBQ",
         "https://tgstat.ru/channel/@Yakamoz54321",
         "https://tgstat.ru/channel/st9HlqOcLeYxZTEy",
		 "https://tgstat.ru/channel/AAAAAEpeaoM8qD7q2W4zhQ",
		 "https://tgstat.ru/channel/Smc0ePoQTehmYjYy",
		 "https://tgstat.ru/channel/ppdsEQjX8JNkMmE6",
		 "https://tgstat.ru/channel/3_f2CQLeUq1iMWEy",
		 "https://tgstat.ru/channel/obada1VMaAgwMTUy",
		 "https://tgstat.ru/channel/SsaRyXSdO2ZlxOZ1",
		 "https://tgstat.ru/channel/Ljwkg3GYCiQ5NzYy",
		 "https://tgstat.ru/channel/r14WCeT15rM0NDhi",
		 "https://tgstat.ru/channel/00eGoeLIxsA3OGZi",
);
 $pattern = [["КУБОК", "ЛИГА", "ЧЕМПИОНАТ"], //0
["коэффициент"], //1
[], //2
 ["Футбол"], //3
 ["ЦЕНА:"], //4
 ["#Line"], //5
 ["#Line"], //6
 ["Stats"], //7
 [], //8
 ["информация"], //9
 ["СИГНАЛ"], //10
 ["Бейсбол", "Футбол", "Хоккей","Баскетбол"], //11
 ["прогноз "], //12
 ];
$limits = array(1,5,1,1,5,5,5,5,1,5,1,5,5);

a:
for($i = 0; $i <count($channels); ++$i) {
if ($links[$i] != ""){
	if ($limits[$i] > 0){
$headers = array(
	'cache-control: max-age=0',
	'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
	'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
);
$ch = curl_init($links[$i]);
curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$txt = curl_exec($ch);
curl_close($ch);

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

if ($date_check > $last_date){
	$limits[$i]=$limits[$i]-1;
	if ($i=0 || 3){
	if ($i=0){
	$arrayQuery = array(
    'chat_id' => 736114046,
    'text' => '1'
);
}
	if ($i=3){
	$arrayQuery = array(
    'chat_id' => 736114046,
    'text' => '3'
);
}


	
	
$ch = curl_init('https://api.telegram.org/bot'. $token .'/sendMessage');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayQuery);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);
	}else {
	$searcher='<div class="post-text">';
	$len = mb_strlen($searcher);
	$num1=mb_stripos($txt, $searcher,$num1,'UTF-8')+$len;
		 $searcher   ='</div>';
$num2=mb_stripos($txt, $searcher,$num1);
	$post_text = mb_substr($txt,$num1,$num2-$num1,'UTF-8');
	
	//for
	//if(mb_stripos($post_text,$pattern[$i][$ii],0,'UTF-8')>1){
		$fp = fopen($path . $channels[$i] . $date_check . ".txt", "w");
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

$arrayQuery = array(
    'chat_id' => 736114046,
    'caption' => '',
    'photo' => curl_file_create($path_to_parse)
);

$ch = curl_init('https://api.telegram.org/bot'. $token .'/sendPhoto');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayQuery);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);
$arrayQuery = array(
    'chat_id' => 736114046,
    'text' => $post_text
);		
$ch = curl_init('https://api.telegram.org/bot'. $token .'/sendMessage');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayQuery);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);
	
	//}
}
}
}
}
}
$last_date = $date_check;
sleep(1800);
goto a;



   ?>
   
   
   