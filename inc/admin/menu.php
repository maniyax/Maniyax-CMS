<?php
$title = 'Редактирование меню';
head(1,1);
if(empty($ok)){
if(!empty($_POST)){
$m1 = $db->query("select * from `menu` ORDER BY `weight` ASC;");
while($menu1 = $m1->fetch_assoc()){
$id = $menu1['id'];
$name=$_POST['name'.$id];
$weight=$_POST['weight'.$id];
if(!empty($_POST['url'])){
$url=$_POST['url'.$id];
$title=$_POST['title'.$id];
$accesskey=$_POST['accesskey'.$id];
}
else{
$url=$menu1['url'];
$title=$menu1['title'];
$accesskey=$menu1['accesskey'];
}
$q=$db->query("update `menu` set name='{$name}',url='{$url}',weight={$weight},title='{$title}',accesskey='{$accesskey}' where id={$id};");
}
if($q>0) text('Успешно выполнено!');
else text('Произошла неизвестная ошибка.');
}

echo'<form method="POST">';
$m = $db->query("select * from `menu` where level=1 ORDER BY `weight` ASC;");
while($menu = $m->fetch_assoc()){
if($menu['url']!='#'){
text('<details><summary aria-expanded="false">'.$menu['name'].'</summary>');
text('<label for="name'.$menu['id'].'">Текст ссылки</label><br>
<input id="name'.$menu['id'].'" type="text" name="name'.$menu['id'].'" value="'.$menu['name'].'" required/>');
text('<label for="url'.$menu['id'].'">Адрес</label><br>
<input id="url'.$menu['id'].'" type="text" name="url'.$menu['id'].'" value="'.$menu['url'].'" required/>');
text('<label for="weight'.$menu['id'].'">Вес</label><br>
<input id="weight'.$menu['id'].'" type="number" name="weight'.$menu['id'].'" value="'.$menu['weight'].'" required/>');
echo'<details><summary aria-expanded="false">Дополнительные параметры</summary>';
text('<label for="title'.$menu['id'].'">Всплывающая подсказка</label><br>
<input id="title'.$menu['id'].'" type="title" name="title'.$menu['id'].'" value="'.$menu['title'].'"/>');
text('<label for="accesskey'.$menu['id'].'">Accesskey</label><br>
<input id="accesskey'.$menu['id'].'" type="text" name="accesskey'.$menu['id'].'" value="'.$menu['accesskey'].'"/>');
echo'</details>
<a href="admin.php?mod=menu&ok=delete&id='.$menu['id'].'">Удалить "'.$menu['name'].'"</a>
</details>';
}
else{
text('<details><summary aria-expanded="false" aria-haspopup="true">'.$menu['name'].'</summary>');
text('<label for="namesubmenu'.$menu['id'].'">Название подменю</label><br>
<input id="namesubmenu'.$menu['id'].'" type="text" name="name'.$menu['id'].'" value="'.$menu['name'].'" required/>');
text('<label for="weight'.$menu['id'].'">Вес</label><br>
<input id="weight'.$menu['id'].'" type="number" name="weight'.$menu['id'].'" value="'.$menu['weight'].'" required/>');
echo'<a href="admin.php?mod=menu&ok=delete&id='.$menu['id'].'">Удалить подменю "'.$menu['name'].'"</a>
<div role="list">';
$submenuitem = $db->query("select * from `menu` where byid={$menu['id']}");
while($smi = $submenuitem->fetch_assoc()){
text('<div role="listitem"><details><summary aria-expanded="false">'.$smi['name'].'</summary>');
text('<label for="name'.$smi['id'].'">Текст ссылки</label><br>
<input id="name'.$smi['id'].'" type="text" name="name'.$smi['id'].'" value="'.$smi['name'].'" required/>');
text('<label for="url'.$smi['id'].'">Адрес</label><br>
<input id="url'.$smi['id'].'" type="text" name="url'.$smi['id'].'" value="'.$smi['url'].'" required/>');
text('<label for="weight'.$smi['id'].'">Вес</label><br>
<input id="weight'.$smi['id'].'" type="number" name="weight'.$smi['id'].'" value="'.$smi['weight'].'" required/>');
echo'<details><summary aria-expanded="false">Дополнительные параметры</summary>';
text('<label for="title'.$smi['id'].'">Всплывающая подсказка</label><br>
<input id="title'.$smi['id'].'" type="title" name="title'.$smi['id'].'" value="'.$smi['title'].'"/>');
text('<label for="accesskey'.$smi['id'].'">Accesskey</label><br>
<input id="accesskey'.$smi['id'].'" type="text" name="accesskey'.$smi['id'].'" value="'.$smi['accesskey'].'"/>');
echo'</details>
<a href="admin.php?mod=menu&ok=delete&id='.$smi['id'].'">Удалить подпункт "'.$smi['name'].'"</a>
</details></div>';
}
echo'</div></details>';
}
}
echo'<input type="submit" value="Отправить"/></form>
<h3>Добавить страницу в меню</h3>
<form action="admin.php?mod=menu&ok=addpage" method="POST">
<label for="addpage">Выберете страницу</label><br>
<select required id="addpage" name="page">';
$hp = $db->query("select * from `pages`");
while($hp2 = $hp->fetch_assoc()){
echo'<option value="'.$hp2['id'].'">'.$hp2['title'].'</option>';
}
echo'</select><br>';
text('<label for="weightpage">Вес<br>
<input id="weightpage" type="number" name="weight" value="1" required/>');
echo'<details><summary aria-expanded="false">Дополнительные параметры</summary>';
text('<label for="titlepage">Всплывающая подсказка</label><br>
<input id="titlepage" type="title" name="title"/>');
text('<label for="accesskeypage">Accesskey</label><br>
<input id="accesskeypage" type="text" name="accesskey"/>');
echo'</details>
<input type="submit" value="Добавить страницу"/></form>

<h3>Добавить произвольную ссылку в меню</h3>
<form action="admin.php?mod=menu&ok=addurl" method="POST">';
text('<label for="namelink">Текст ссылки</label>:<br>
<input id="namelink" type="text" name="name" required/>');
text('<label for="urllink">Адрес</label><br>
<input id="urllink" type="url" name="url" required/>');
text('<label for="weightlink">Вес</label><br>
<input id="weightlink" type="number" name="weight" value="1" required/>');
echo'<details><summary aria-expanded="false">Дополнительные параметры</summary>';
text('<label for="titlelink">Всплывающая подсказка</label><br>
<input id="titlelink" type="title" name="title"/>');
text('<label for="accesskeylink">Accesskey</label><br>
<input id="accesskeylink" type="text" name="accesskey"/>');
echo'</details>
<input type="submit" value="Добавить ссылку"/></form>
<h3>Создать подменю</h3>
<form action="admin.php?mod=menu&ok=addsubmenu" method="POST">';
text('<label for="nameaddsubmenu">Название подменю</label><br>
<input id="nameaddsubmenu" type="text" name="name" required/>');
text('<label for="weightaddsubmenu">Вес</label><br>
<input id="weightaddsubmenu" type="number" name="weight" required/>');
echo'<input type="submit" value="Создать подменю"/></form>
<h3>Добавить пункт в подменю</h3>
<form action="admin.php?mod=menu&ok=addsubmenuitem" method="POST">';
$q=$db->query("select * from `menu` where url='#'");
$q1 = $q->fetch_assoc();
if(!empty($q1)){
echo'<label for="submenu">Выберите подменю</label><br>
<select requiredid="submenu" name="byid">';
$q=$db->query("select * from `menu` where url='#'");
while($sm = $q->fetch_assoc()){
echo'<option value="'.$sm['id'].'">'.$sm['name'].'</option>';
}
echo'</select>';
text('<label for="namesubmenuitem">Текст ссылки</label><br>
<input id="namesubmenuitem" type="text" name="name" required/>');
text('<label for="urlsubmenuitem">Адрес</label><br>
<input id="urlsubmenuitem" type="text" name="url" required/>');
text('<label for="weightsubmenuitem">Вес</label><br>
<input id="weightsubmenuitem" type="number" name="weight" value="1" required/>');
echo'<input type="submit" value="Добавить пункт в подменю"/></form>';
}
else{
text('Сначала создайте хотя бы одно подменю');
}
}

elseif($ok=='delete'){
$id = $_GET['id'];
$q = $db->query("delete from `menu` where id={$id} limit 1;");
if($q==1) header("location: admin.php?mod=menu");
else text('Произошла неизвестная ошибка.');
}


elseif($ok=='addpage'){
$page = $_POST['page'];
$weight = $_POST['weight'];
$title = $_POST['title'];
$accesskey = $_POST['accesskey'];
$x = $db->query("select * from `pages` where id={$page} limit 1;");
$page = $x->fetch_assoc();
$name = $page['title'];
$url = '/'.$page['url'];
$z = $db->query("insert into `menu` values(0,{$weight},'{$url}','{$name}','{$title}','{$accesskey}',1,0);");
if($z==1) header("location: admin.php?mod=menu");
else text('Произошла неизвестная ошибка.');
}

elseif($ok=='addurl'){
$weight = $_POST['weight'];
$title = $_POST['title'];
$accesskey = $_POST['accesskey'];
$name = $_POST['name'];
$url = $_POST['url'];
$z = $db->query("insert into `menu` values(0,{$weight},'{$url}','{$name}','{$title}','{$accesskey}',1,0);");
if($z==1) header("location: admin.php?mod=menu");
else text('Произошла неизвестная ошибка.');
}

elseif($ok=='addsubmenu'){
$weight = $_POST['weight'];
$name = $_POST['name'];
$z = $db->query("insert into `menu` values(0,{$weight},'#','{$name}','','',1,0);");
if($z==1) header("location: admin.php?mod=menu");
else text('Произошла неизвестная ошибка.');
}

elseif($ok=='addsubmenuitem'){
$weight = $_POST['weight'];
$name = $_POST['name'];
$url = $_POST['url'];
$byid = $_POST['byid'];
$z = $db->query("insert into `menu` values(0,{$weight},'{$url}','{$name}','','',2,{$byid});");
if($z==1) header("location: admin.php?mod=menu");
else text('Произошла неизвестная ошибка.');
}

?>