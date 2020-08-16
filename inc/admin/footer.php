<?php
$title='Редактировать подвал сайта';
head(1,1);
if(!empty($_POST)){
//$footer = $_POST['footer'];
$footer = htmlspecialchars($_POST["footer"]);
$q=$db->query("update `config` set footer='{$footer}' limit 1;");
if($q==1) text('Подвал успешно обновлен');
else text('Произошла неизвестная ошибка.');
}

text('<form method="POST">
<textarea name="footer">'.site('footer').'</textarea><br>
<input type="submit" value="Сохранить"/></form>');
?>