<?php
text('Здравствуйте, '.$_SESSION['username']);
text('<a role="button" href="logout.php">Выйти</a>');
text('<div role="list">
<div role="listitem"><a role="button" href="admin.php?mod=pages">Все страницы</a></div>
<div role="listitem"><a role="button" href="admin.php?mod=addpage">Добавить страницу</a></div>
<div role="listitem"><a role="button" href="admin.php?mod=settings">Настройки сайта</a></div>
<div role="listitem"><a role="button" href="admin.php?mod=homepage">Настройки главной страницы</a></div>
<div role="listitem"><a role="button" href="admin.php?mod=menu">Редактировать меню</a></div>
<div role="listitem"><a role="button" href="admin.php?mod=footer">Редактировать подвал сайта</a></div>
<div role="listitem"><a role="button" href="admin.php?mod=md5">MD5-шифроватор</a></div>
</div>');
?>