<?php
setcookie("user", "" . $token, time() - 3600, "/");
header('Location: login.php?e=logout');
?>