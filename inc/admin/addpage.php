<?php
$title = 'Добавить страницу';
head(1,1);
if(!empty($_POST)){
$name = $_POST['name'];
$content = $_POST['content'];
$url = $_POST['url'];
if(empty($url)) $url = translit($name);
$q=$db->query("insert into `pages` values(0,'{$name}','{$url}','{$content}',0);");
if($q==1) text('Страница успешно добавлена. <a href="'.site('url').$url.'" target="_blank">Открыть в новой вкладке</a>');
else text('Произошла неизвестная ошибка.');
}

text('<form method="POST" role="form">
<label for="title">Заголовок</label><br>
<input id="title" type="text" name="name" required/>');
text('<label for="text">Содержимое</label?<br>
<textarea required id="text" name="content"></textarea>');
text('<details><summary aria-expanded="false">Дополнительные настройки</summary>
<label for="url">Короткий адрес</label><br>
'.site('url').'<input id="url" type="text" name="url"/>
</details>');
text('<input type="submit" value="Добавить"/></form>');
?>