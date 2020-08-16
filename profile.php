<?php
include"inc/func.php";
$mod = (isset($_REQUEST['mod']))?$_REQUEST['mod']:'';
$ok = (isset($_REQUEST['ok']))?$_REQUEST['ok']:'';
$title = 'Профиль';
head(1,2);
if(empty($mod)){
text($f['login'].', последний раз вы входили в аккаунт '.date('d-m-Y, H:i', $f['authtime']).' с IP-адреса '.$f['authip']);
text('Вы зарегистрировались в системе '.date('d-m-Y, H:i', $f['regtime']).' с IP-адреса '.$f['regip']);
}

footer();
?>