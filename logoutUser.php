<?php
session_start();
session_destroy();
unset($_SESSION['auth']);
header("location:loginUser.php?logout=1");
?>