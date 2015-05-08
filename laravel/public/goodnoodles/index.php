<?php
/* Config */
$owner = 'BrokingClub';
$repository = 'BrokingClub';
$users = [
	'triggerdesign' => 0,
	'schempil' => 0,
	'marc1404' => 0
];
$alias = [
	'triggerdesign' => 'Simon',
	'schempil' => 'Philipp',
	'marc1404' => 'Marc'
];
/* Config */
/* Header */
header('Content-type: image/jpg');
/* Header */
/* Cache */
$cache_time = 600;
$cache_file = 'goodnoodles.cache';
$cache_created = file_exists($cache_file) ? filemtime($cache_file) : 0;

if(time() - $cache_created < $cache_time){
	readfile($cache_file);
	die();
}
/* Cache */
/* Main */
$response = file_get_contents("https://api.github.com/repos/$owner/$repository/stats/contributors");
$json = json_decode($response, true);

foreach($json as $contribution){
	$author = $contribution['author'];
	$login = $author['login'];
	
	if(array_key_exists($login, $users)){
		$users[$login] = $contribution['total'];
	}
}

arsort($users, SORT_NUMERIC);

$img = imagecreatefromjpeg('goodnoodles.jpg');
$white = imagecolorallocate($img, 255, 255, 255);
$y = 295;

foreach($users as $key => $value){
	imagettftext($img, 20, 0, 175, $y, $white, './krabby_patty.ttf', $alias[$key]);
	
	$y += 70;
}

ob_start();
imagejpeg($img);
imagedestroy($img);
file_put_contents($cache_file, ob_get_contents());
ob_end_flush();
/* Main */