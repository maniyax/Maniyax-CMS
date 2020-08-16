<?php
//error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On');
include"DBC.php";
session_start();
if(!empty($_SESSION['auth'])){
$l = $db->query("SELECT * from `users` where login='{$_SESSION['username']}' limit 1;");
$f = $l->fetch_assoc();
if($f['lvl'] >2) $home = 'admin.php';
else $home = 'profile.php';
}
$t = $_SERVER['REQUEST_TIME'];

function site($row=''){
$db = DBC::instance();
$q = $db->query("select * from `config`");
$site = $q->fetch_assoc();
return $site[$row];
}

function footer($f='',$flag=0){
$db = DBC::instance();
if(!empty($f)) echo $f;
if($flag>0) echo '<br><a role="button" href="javascript:history.go(-'.$flag.')">Назад</a><br>';
$footer = htmlspecialchars_decode(site('footer'));
echo'</main><footer>'.$footer.'</footer>';
echo'<script async src="/inc/js/jquery-3.2.1.slim.min.js"></script>
<script async src="/inc/js/popper.min.js"></script>
<script async src="/inc/js/bootstrap.min.js"></script>
</body></html>';
exit();
}

function head($h=0,$a=0){
global $home, $f;
if($h==1){
if(empty($_SESSION['auth'])){
header("location: login.php");
exit();
}
}
elseif($h==2){
if(!empty($_SESSION['auth'])){
header("location: $home");
exit();
}
}
$db = DBC::instance();
global $title;
echo'<!DOCTYPE html>
<html lang="ru-RU">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/inc/css/bootstrap.min.css">
<title>'.$title.' - '.site('title').'</title>
</head>
<body>
<h1><a class="navbar-brand" href="'.site('url').'">'.site('title').'</a></h1>';

if($a==1){
require_once'menu/admin.php';
}
elseif($a==2){
require_once'menu/profile.php';
}
else{
require_once'menu/main.php';
}
echo'<main>
<h2>'.$title.'</h2>';

}

function text($t=''){
echo'<p>'.$t.'</p>';
}

function translit($translit = ''){
$translit = (string) $translit; // преобразуем в строковое значение
//$translit = strip_tags($translit); // убираем HTML-теги
$translit = str_replace(array("\n", "\r"), " ", $translit); // убираем перевод каретки
$translit = preg_replace("/\s+/", ' ', $translit); // удаляем повторяющие пробелы
$translit = trim($translit); // убираем пробелы в начале и конце строки
$translit = function_exists('mb_strtolower') ? mb_strtolower($translit) : strtolower($translit); // переводим строку в нижний регистр (иногда надо задать локаль)
$translit = strtr($translit, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
$translit = preg_replace("/[^0-9a-z-_ ]/i", "", $translit); // очищаем строку от недопустимых символов
$translit = str_replace(" ", "-", $translit); // заменяем пробелы знаком минус
return $translit;
}

function ekr($a)
	{
	$db = DBC::instance();
	$a = htmlspecialchars($a);
	$a = $db->real_escape_string($a);
	return $a;
	}

function page($p=''){
$pu='';
$explode = explode("/",$p);
if(preg_match('/\?/', $p)>0){
for ($i = 0; $i+1 < count($explode); $i++){
if($i==1) $pu = $explode[$i];
else $pu .= '/'.$explode[$i];
}
}
elseif(count($explode) >2){
for ($i = 0; $i+1 < count($explode); $i++){
if($i==1) $pu = $explode[$i];
else $pu = $pu.'/'.$explode[$i];
}
}
else{
for ($i = 0; $i < count($explode); $i++){
if($i==1) $pu = $explode[$i];
else $pu = $pu.'/'.$explode[$i];
}
}

return $pu;
}

?>