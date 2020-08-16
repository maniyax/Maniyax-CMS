<?php
include"inc/func.php";
$mod = $_GET['mod'];
if(empty($mod)){
$title = 'Регистрация';
head(2);
if(!empty($_POST)){
$referer = 'profile.php';
$user = $_POST['user'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
if($user == $pass) footer('Логин и пароль должны различаться!',1);
if($pass != $pass2) footer('Пароли различаются!',1);
$pass = md5($pass);
$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? ekr($_SERVER['HTTP_X_FORWARDED_FOR']) : ekr($_SERVER['REMOTE_ADDR']);
$q = $db->query("SELECT * from `users` where login='{$user}' limit 1;");
$q2 = $db->query("SELECT * from `users` where email='{$email}' limit 1;");
if($q->num_rows > 0 or $q2->num_rows > 0){
footer('Пользователь с таким именем или e-mail уже существует, придумайте другой.',1);
}
else{
$q = $db->query("insert into `users` values(0,'{$user}','{$pass}','{$email}',{$t},{$t},'{$ip}','{$ip}',1,0,0);");
if($q == 1){
$subject = 'Активация аккаунта';
$message = 'Здравствуйте, '.$user.'<br><br>
Для завершения регистрации на сайте '.site('domain').' перейдите по данной ссылке:<br>
<a href="'.site('url').'registration.php?mod=confirm&user='.$user.'&key='.md5($user.$pass.$email).'">'.site('url').'registration.php?mod=confirm&user='.$user.'&key='.md5($user.$pass.$email).'</a><br><br>
Если запрос на регистрацию поступил не с вашего аккаунта, просто проигнорируйте данное письмо.<hr>
С уважением, '.site('smtpfrom');
require_once'smtp.php';
smtpmail($user, $email, $subject, $message);
footer('Регистрация прошла успешно. Вам на почту отправлено письмо с ссылкой для активации аккаунта.');
}
else{
footer('Что-то пошло не так');
}
}
}


echo'<p>Введите данные для регистрации на сайте.</p>

<form method="POST" action="registration.php" role="form">
<fieldset>
<legend>Регистрация</legend>
 <label>Логин:<br>
<input type="text" name="user" required></label><br>
 <label>Пароль:<br>
<input type="password" name="pass" required/></label>
<label>Пароль еще раз:<br>
<input type="password" name="pass2" required/></label>
<label>E-mail:<br>
<input type="email" name="email" required></label><br>
<fieldset><br>

<input type="submit" value="Зарегистрироваться"/>
</form>';
}
elseif($mod=='confirm'){
$title = 'Активация аккаунта';
head(2);
$key = $_GET['key'];
$user = $_GET['user'];
$q = $db->query("SELECT * from `users` where login='{$user}' limit 1;");
$l = $q->fetch_assoc();
$sol = md5($l['login'].$l['password'].$l['email']);
if($key == $sol){
$q = $db->query("update `users` set active=1 where login='{$l['login']}' limit 1;");
$_SESSION['auth'] = 1;
$_SESSION['username'] = $user;
$_SESSION['referer'] = 'profile.php';
text('Аккаунт успешно активирован!<br>Перейдите на страницу <a href="/profile.php">вашего профиля.</a>');
}
else{
text('Неправильная ссылка для активации.');
}
}
footer();


?>