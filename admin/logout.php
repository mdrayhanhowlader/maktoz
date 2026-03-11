<?php
session_start();
session_destroy();
header("Location: /maktoz/admin/login.php");
exit();
?>
