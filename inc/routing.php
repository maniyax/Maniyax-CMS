<?php
$p = $_SERVER['REQUEST_URI'];
$pu = page($p);
if(empty($pu) or $p == '/index.php'){
if(!empty(site('homepage'))){
$hp = site('homepage');
$i=$db->query("select * from `pages` where url='{$hp}'");
$homepage = $i->fetch_assoc();
$title = $homepage['title'];
head();
$content = nl2br($homepage['content']);
text($content);
}
else{
$title = 'Главная страница';
head();
text('Тут будет лента записей, когда я реализую этот модуль');
}
}

else{
$q=$db->query("select * from `pages` where url='{$pu}'");
$page = $q->fetch_assoc();
if(!empty($page)){
$title = $page['title'];
head();
$content = nl2br($page['content']);
text($content);
}
else{
$caturl = explode('/', $p);
if(empty($caturl[2])){
$c1 = $db->query("select * from `categories` where url='{$caturl[1]}'");
$c2 = $c1->fetch_assoc();
if(!empty($c2)){
$title = $c2['name'];
head();
$q = $db->query("select * from `posts` where category='{$pu}'");
while($pc=$q->fetch_assoc()){
text('<h3><a href="'.site('url').$c2['url'].'/'.$pc['url'].'">'.$pc['name'].'</a></h3>
'.$pc['content']);
}
}
}
else{
$posturl = explode('/', $p);
$q=$db->query("select * from `posts` where category='{$posturl[1]}' and url='{$posturl[2]}'");
$post = $q->fetch_assoc();
$title = $post['name'];
head();
$content = nl2br($post['content']);
text($content);
echo'<hr>';
$u = $db->query("select * from `categories` where url='{$post['category']}'");
$cat = $u->fetch_assoc();
$time = date('d-m-Y, H:i', $post['createtime']);
text('Категория: <a href="'.site('url').$cat['url'].'">'.$cat['name'].'</a><br>
Дата публикации: '.$time.'');

if($post['share']==1) text('<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,blogger,reddit,linkedin,lj,tumblr,viber,whatsapp,skype,telegram"></div>');
}
}
}

?>