<?php
if(empty($ok)){
$title='Все страницы';
head(1,1);
echo'<table>
<tr>
<th>ID</th>
<th>Название</th>
<th>Действия</th>
</tr>';
$u = $db->query("select * from `pages`");
while($page = $u->fetch_assoc()){
echo'<tr>
<td>'.$page['id'].'</td>
<td><a href="'.site('url').$page['url'].'" target="_blank">'.$page['title'].'</a></td>
<td><a role="button" href="admin.php?mod=pages&ok=edit&id='.$page['id'].'">Редактировать</a> <a role="button" href="admin.php?mod=pages&ok=delete&id='.$page['id'].'">Удалить</a></td>
</tr>';
}
echo'</table>';
}
elseif($ok=='delete'){
$title='Удаление страницы';
head(1,1);
$id = $_GET['id'];
$q = $db->query("delete from `pages` where id={$id} limit 1;");
if($q==1) header("location: admin.php?mod=pages");
else text('Произошла неизвестная ошибка.');
}

elseif($ok=='edit'){
$id=$_GET['id'];
$title='Редактирование страницы';
head(1,1);
if(!empty($_POST)){
$name = $_POST['name'];
$content = $_POST['content'];
$url = $_POST['url'];
if(empty($url)) $url = translit($name);
$q=$db->query("update `pages` set title='{$name}',url='{$url}',content='{$content}',type=0 where id={$id}");
if($q==1) text('Страница успешно отредактирована. <a href="'.site('url').$url.'" target="_blank">Открыть в новой вкладке</a>');
else text('Произошла неизвестная ошибка.');
}

$q=$db->query("select * from `pages` where id={$id} limit 1;");
$page = $q->fetch_assoc();
text('<form method="POST" role="form">
<label for="title">Заголовок</label><br>
<input id="title" type="text" name="name" value="'.$page['title'].'" required/>');
text('<label for="text">Содержимое</label?<br>
<textarea required id="text" name="content">'.$page['content'].'</textarea>');
text('<details><summary aria-expanded="false">Дополнительные настройки</summary>
<label for="url">Короткий адрес</label><br>
'.site('url').'<input id="url" type="text" name="url" value="'.$page['url'].'"/>
</details>');
text('<input type="submit" value="Обновить"/></form>');
}
?>