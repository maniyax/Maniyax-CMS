<?php
if(empty($ok)){
$title = 'Все категории';
head(1,1);
text('<a role="button" href="admin.php?mod=categories&ok=add">Добавить новую категорию</a>');
echo'<table>
<tr>
<th>ID</th>
<th>Название</th>
<th>Действия</th>
</tr>';
$q = $db->query("select * from `categories`");
while($cat = $q->fetch_assoc()){
echo'<tr>
<td>'.$cat['id'].'</td>
<td><a href="'.site('url').$cat['url'].'" target="_blank">'.$cat['name'].'</a></td>
<td><a role="button" href="admin.php?mod=categories&ok=edit&id='.$cat['id'].'">Редактировать</a> <a role="button" href="admin.php?mod=categories&ok=delete&id='.$cat['id'].'">Удалить</a></td>
</tr>';
}
echo'</table>';
}

elseif($ok=='delete'){
$title='Удаление категории';
head(1,1);
$id = $_GET['id'];
$q = $db->query("delete from `categories` where id={$id} limit 1;");
if($q==1) header("location: admin.php?mod=categories");
else text('Произошла неизвестная ошибка.');
}

elseif($ok=='edit'){
$id=$_GET['id'];
$title='Редактирование категории';
head(1,1);
if(!empty($_POST)){
$name = $_POST['name'];
$url = $_POST['url'];
if(empty($url)) $url = translit($name);
$q=$db->query("update `categories` set name='{$name}',url='{$url}' where id={$id}");
if($q==1) header("location: admin.php?mod=categories");
else text('Произошла неизвестная ошибка.');
}

$q=$db->query("select * from `categories` where id={$id} limit 1;");
$cat = $q->fetch_assoc();
text('<form method="POST" role="form">
<label for="title">Название</label><br>
<input id="title" type="text" name="name" value="'.$cat['name'].'" required/>');
text('<label for="url">Короткий адрес</label><br>
'.site('url').'<input id="url" type="text" name="url" value="'.$cat['url'].'"/>');
text('<input type="submit" value="Обновить"/></form>');
}

elseif($ok=='add'){
$id=$_GET['id'];
$title='Добавить новую категорию';
head(1,1);
if(!empty($_POST)){
$name = $_POST['name'];
$url = $_POST['url'];
if(empty($url)) $url = translit($name);
$q=$db->query("insert into `categories` values(0,'{$name}','{$url}')");
if($q==1) header("location: admin.php?mod=categories");
else text('Произошла неизвестная ошибка.');
}

text('<form method="POST" role="form">
<label for="title">Название</label><br>
<input id="title" type="text" name="name" required/>');
text('<label for="url">Короткий адрес</label><br>
'.site('url').'<input id="url" type="text" name="url"/>');
text('<input type="submit" value="Добавить"/></form>');
}

?>