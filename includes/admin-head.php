<?php
if(!isset($_SESSION['role']) ||  $_SESSION['role']!='admin'){
     echo("<script>location.href = '".BASE_URL."admin-login.php';</script>");
}
?>