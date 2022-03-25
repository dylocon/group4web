<?php
session_start();
session_unset();
session_destroy();
header("Location: userLogin.php"); 
?>
<h1> hello </h1>