<?php
$title = 'Настройки сайта';
head(1,1);
if(!empty($_POST)){
$name = $_POST['name'];
$domain = $_POST['domain'];
$url = $_POST['url'];
$descr = $_POST['descr'];
$q=$db->query("update `config` set title='{$name}',descr='{$descr}',domain='{$domain}',url='{$url}' limit 1;");
if($q==1) text('Настройки сайта успешно обновлены');
else text('Произошла какая-то ошибка.');
}

echo'<form method="POST">';
text('<label for="name">Название сайта</label><br>
<input id="name" type="text" name="name" value="'.site('title').'" required/>');
text('<label for="descr">Краткое описание</label><br>
<input id="descr" type="text" name="descr" value="'.site('descr').'" required/>');
text('<label for="domain">Домен</label><br>
<input id="domain" type="text" name="domain" value="'.site('domain').'" required/>');
text('<label for="url">Адрес сайта</label><br>
<input id="url" type="url" name="url" value="'.site('url').'" required/>');
echo'<input type="submit" value="Сохранить"/></form>';
?>