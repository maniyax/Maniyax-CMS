<?php
$title = 'Авторизация';
include"inc/func.php";
head(2);
if(!empty($_POST)){
$user = $_POST['user'];
$pass = md5($_POST['pass']);
$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? ekr($_SERVER['HTTP_X_FORWARDED_FOR']) : ekr($_SERVER['REMOTE_ADDR']);
$q = $db->query("SELECT * from `users` where login='{$user}' limit 1;");
$u = $q->fetch_assoc();
if($q->num_rows > 0){
if($u['password'] != $pass){
text('Пароль не верен');
}
elseif($u['active'] ==0){
text('Аккаунт не активирован. Проверьте почту');
}
else{
$q = $db->query("update `users` set authtime={$t},authip='{$ip}' where login='{$user}' limit 1;");
if($u['lvl'] > 2) $referer = 'admin.php';
else $referer = 'profile.php';
$_SESSION['auth'] = 1;
$_SESSION['username'] = $user;
$_SESSION['referer'] = $referer;
header("location: $referer");
}
}
else{
footer('Пользователь не найден, проверьте правильность введенных данных',1);
}
}
echo'<p>Введите логин и пароль для авторизации на сайте.</p>

<form method="POST" action="login.php" role="form">
<fieldset>
<legend>Авторизация</legend>
 <label>Логин:<br>
<input type="text" name="user"></label><br>
 <label>Пароль:<br>
<input type="password" name="pass"/></label>
<input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="type" value="'.$type.'"/><fieldset><br>
<input type="submit" value="Войти"/>
</form>';
footer();

?>