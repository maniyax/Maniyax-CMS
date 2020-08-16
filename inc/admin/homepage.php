<?php
$title = 'Настройки главной страницы';
head(1,1);
if(!empty($_POST)){
$homepage = $_POST['homepage'];
$q = $db->query("update `config` set homepage='{$homepage}';");
if($q==1) text('Настройки главной страницы успешно обновлены. <a href="'.site('url').'" target="_blank">Открыть в новой вкладке</a>');
else text('Произошла неизвестная ошибка.');
}

echo'<form method="POST">
<label for="homepage">На главной странице отображать</label><br>
<select id="homepage" name="homepage">
<option value="0">Ленту новостей</option>';
$hp = $db->query("select * from `pages`");
while($hp2 = $hp->fetch_assoc()){
echo'<option value="'.$hp2['url'].'">'.$hp2['title'].'</option>';
}
echo'</select><br>
<input type="submit" value="Сохранить"/></form>';
?>