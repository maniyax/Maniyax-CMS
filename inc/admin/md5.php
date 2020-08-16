<?php
$title = 'MD5-шифроватор';
head(1,1);
$string = $_POST['string'];
$md5 = md5($string);
if(!empty($string)){
text('Было:<br>'.$string);
text('Стало:<br>'.$md5);
}
text('<form method="POST" role="form">
<label>Введите строку для шифрования:</label><br>
<input type="text" name="string"/><br>
<input type="submit" value="Зашифровать"/>
</form>');

?>