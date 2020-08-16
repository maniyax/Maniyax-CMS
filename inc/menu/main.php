<?php
text(site('descr'));
echo'<div role="menu">';
if(empty($_SESSION['auth'])){
text('<div role="menuitem"><a href="/login.php">Вход</a></div>
<div role="menuitem"><a href="/registration.php">Регистрация</a></div>');
}
else{
echo'<div role="menuitem"><a href="/profile.php">Здравствуйте, '.$f['login'].'</a></div>';
if($f['lvl']>2) echo'<div role="menuitem"><a href="/admin.php">Админ-панель</a></div>';
echo'<div role="menuitem"><a href="/logout.php">Выход</a></div>';
}
echo'</div>';


echo'<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div role="list" class="collapse navbar-collapse navbarNav" id="navbarNav">';
$m = $db->query("select * from `menu` where level=1 ORDER BY `weight` ASC;");
while($menu = $m->fetch_assoc()){
if($menu['url']!='#'){
echo'<div role="listitem" class="nav-item"><a class="nav-link" href="'.$menu['url'].'"';
if(!empty($menu['title'])) echo' title="'.$menu['title'].'"';
if(!empty($menu['accesskey'])) echo' accesskey="'.$menu['accesskey'].'"';
echo'>'.$menu['name'].'</a></div>';
}
else{
echo'<div class="dropdown show nav-item">
  <a class="btn btn-secondary dropdown-toggle" role="button" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$menu['name'].'</a>
<div role="list" class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
$m2 = $db->query("select * from `menu` where level=2 and byid={$menu['id']} ORDER BY `weight` ASC;");
while($menu2 = $m2->fetch_assoc()){
echo'<div role="listitem"><a class="dropdown-item" href="'.$menu2['url'].'">'.$menu2['name'].'</a></div>';
}
echo'</div></div>';
}
}
echo'</div></nav>';
?>