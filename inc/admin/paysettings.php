<?php
$title = '��������� ��������';
head(1,1);
if(!empty($_POST)){
$wmr = $_POST['wmr'];
$wmrkey = $_POST['wmrkey'];
$ym = $_POST['ym'];
$ymkey = $_POST['ymkey'];
$ymm = (isset($_REQUEST['ymm']))?$_REQUEST['ymm']:'0';
$ymc = (isset($_REQUEST['ymc']))?$_REQUEST['ymc']:'0';
$ymt = (isset($_REQUEST['ymt']))?$_REQUEST['ymt']:'0';
$q=$db->query("update `paysettings` set wmr='{$wmr}',wmrkey='{$wmrkey}',ym='{$ym}',ymkey='{$ymkey}',ymm={$ymm},ymc={$ymc},ymt={$ymt} limit 1;");
if($q==1) text('��������� �������� ������� ���������');
else text('��������� �����-�� ������.');
}

echo'<form method="POST">';
text('<label for="wmr">����� WMR ��������</label><br>
<input id="wmr" type="text" name="wmr" value="'.site('smtphost').'" required/>');
text('<label for="port">SMTP ����</label><br>
<input id="port" type="number" name="port" value="'.site('smtpport').'" required/>');
text('<label for="login">������������ SMTP</label><br>
<input id="login" type="email" name="login" value="'.site('smtplogin').'" required/>');
text('<label for="pass">������ ������������ SMTP</label><br>
<input id="pass" type="password" name="pass" value="'.site('smtppass').'" required/>');
text('<label for="from">��� �����������</label><br>
<input id="from" type="text" name="from" value="'.site('smtpfrom').'" required/>');
echo'<input type="submit" value="���������"/></form>';
?>