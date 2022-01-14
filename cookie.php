<?php
$str=$username.':'.$password.':'.strtotime("now");$str = bin2hex(str_rot13($str)); setcookie("SecretCookie", $str);
?>
