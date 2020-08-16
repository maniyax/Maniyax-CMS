<?php
$title = 'Добавить новую запись';
head(1,1);
if(!empty($_POST)){
$name = (isset($_REQUEST['name']))?$_REQUEST['name']:'';
$content = (isset($_REQUEST['content']))?$_REQUEST['content']:'';
$category = (isset($_REQUEST['category']))?$_REQUEST['category']:'';
$tags = (isset($_REQUEST['tags']))?$_REQUEST['tags']:'';
$reader = (isset($_REQUEST['tags']))?$_REQUEST['tags']:'0';
$share = (isset($_REQUEST['share']))?$_REQUEST['share']:'0';
$url = translit($name);
$createtime = $t;
$edittime = $t;
$q=$db->query("insert into `posts` values(0,'{$name}','{$url}','{$content}','{$category}','{$tags}',{$createtime},{$edittime},{$reader},{$share});");
if($q==1) text('Запись успешно опубликована. <a href="'.site('url').$category.'/'.$url.'" target="_blank">Открыть в новой вкладке</a>');
else text('Произошла неизвестная ошибка.');
}

text('<form method="POST" role="form">
<label for="title">Заголовок</label><br>
<input id="title" type="text" name="name" required/>');
text('<label for="text">Содержимое</label?<br>
<textarea required id="text" name="content"></textarea>');
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
text('<input type="submit" value="Добавить"/></form>');
?>