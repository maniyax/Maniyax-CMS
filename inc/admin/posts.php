<?php
if(empty($ok)){
$title='Все записи';
head(1,1);
echo'<table>
<tr>
<th>ID</th>
<th>Название</th>
<th>Действия</th>
</tr>';
$u = $db->query("select * from `posts`");
while($post = $u->fetch_assoc()){
echo'<tr>
<td>'.$post['id'].'</td>
<td><a href="'.site('url').$post['category'].'/'.$post['url'].'" target="_blank">'.$post['name'].'</a></td>
<td><a role="button" href="admin.php?mod=posts&ok=edit&id='.$post['id'].'">Редактировать</a> <a role="button" href="admin.php?mod=posts&ok=delete&id='.$post['id'].'">Удалить</a></td>
</tr>';
}
echo'</table>';
}
elseif($ok=='delete'){
$title='Удаление записи';
head(1,1);
$id = $_GET['id'];
$q = $db->query("delete from `posts` where id={$id} limit 1;");
if($q==1) header("location: admin.php?mod=posts");
else text('Произошла неизвестная ошибка.');
}

elseif($ok=='edit'){
$id=$_GET['id'];
$title='Редактирование записи';
head(1,1);
if(!empty($_POST)){
$name = (isset($_REQUEST['name']))?$_REQUEST['name']:'';
$content = (isset($_REQUEST['content']))?$_REQUEST['content']:'';
$category = (isset($_REQUEST['category']))?$_REQUEST['category']:'';
$tags = (isset($_REQUEST['tags']))?$_REQUEST['tags']:'';
$reader = (isset($_REQUEST['tags']))?$_REQUEST['tags']:'0';
$share = (isset($_REQUEST['share']))?$_REQUEST['share']:'0';
$url = translit($name);
$edittime = $t;
$q=$db->query("update `posts` set name='{$name}',url='{$url}',content='{$content}',category='{$category}',tags='{tags}',edittime={$edittime},share={$share},reader={$reader} where id={$id}");
if($q==1) text('запись успешно отредактирована. <a href="'.site('url').$category.'/'.$url.'" target="_blank">Открыть в новой вкладке</a>');
else text('Произошла неизвестная ошибка.');
}

$q=$db->query("select * from `posts` where id={$id} limit 1;");
$post = $q->fetch_assoc();
text('<form method="POST" role="form">
<label for="title">Заголовок</label><br>
<input id="title" type="text" name="name" value="'.$post['name'].'" required/>');
text('<label for="text">Содержимое</label?<br>
<textarea required id="text" name="content">'.$post['content'].'</textarea>');
echo'<label for="category">Категория</label><br>
<select required id="category" name="category">';
$c = $db->query("select * from `categories`");
while($cat = $c->fetch_assoc()){
echo'<option value="'.$cat['url'].'">'.$cat['name'].'</option>';
}
echo'</select>';
text('<details><summary aria-expanded="false">Дополнительные настройки</summary>
<input type="checkbox" value="1" id="reader" name="reader" title="Включить читалку"/>');
text('<input type="checkbox" value="1" id="share" name="share" title="Отображать панель Поделиться"/>
</details>');
text('<input type="submit" value="Обновить"/></form>');
}
?>