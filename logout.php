<?php
include"inc/func.php";
unset($_SESSION['auth']);
 session_destroy();
header("location: index.php");
?>