<?php
include"inc/func.php";
$mod = (isset($_REQUEST['mod']))?$_REQUEST['mod']:'';
$ok = (isset($_REQUEST['ok']))?$_REQUEST['ok']:'';
if(empty($mod)){
$title = 'Админка';
head(1,1);
text('Тут обязательно будет что-нибудь полезное о сайте');
}

elseif($mod=='md5'){
require_once'inc/admin/md5.php';
}

elseif($mod=='menu'){
require_once'inc/admin/menu.php';
}

elseif($mod=='settings'){
require_once'inc/admin/settings.php';
}

elseif($mod=='smtp'){
require_once'inc/admin/smtp.php';
}

elseif($mod=='homepage'){
require_once'inc/admin/homepage.php';
}

elseif($mod=='footer'){
require_once'inc/admin/footer.php';
}

elseif($mod=='addpage'){
require_once'inc/admin/addpage.php';
}

elseif($mod=='pages'){
require_once'inc/admin/pages.php';
}

elseif($mod=='addpost'){
require_once'inc/admin/addpost.php';
}

elseif($mod=='posts'){
require_once'inc/admin/posts.php';
}

elseif($mod=='categories'){
require_once'inc/admin/categories.php';
}

footer();
?>