<?php
$title = 'Настройки SMTP';
head(1,1);
if(!empty($_POST)){
$host = $_POST['host'];
$port = $_POST['port'];
$login = $_POST['login'];
$pass = $_POST['pass'];
$from = $_POST['from'];
$q=$db->query("update `config` set smtphost='{$host}',smtpport='{$port}',smtplogin='{$login}',smtppass='{$pass}',smtpfrom='{$from}' limit 1;");
if($q==1) text('Настройки SMTP успешно обновлены');
else text('Произошла какая-то ошибка.');
}

echo'<form method="POST">';
text('<label for="host">SMTP сервер</label><br>
<input id="host" type="text" name="host" value="'.site('smtphost').'" required/>');
text('<label for="port">SMTP порт</label><br>
<input id="port" type="number" name="port" value="'.site('smtpport').'" required/>');
text('<label for="login">Пользователь SMTP</label><br>
<input id="login" type="email" name="login" value="'.site('smtplogin').'" required/>');
text('<label for="pass">Пароль пользователя SMTP</label><br>
<input id="pass" type="password" name="pass" value="'.site('smtppass').'" required/>');
text('<label for="from">Имя отправителя</label><br>
<input id="from" type="text" name="from" value="'.site('smtpfrom').'" required/>');
echo'<input type="submit" value="Сохранить"/></form>';
?>