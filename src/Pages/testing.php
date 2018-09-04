<?php

require"../Composer/vendor/autoload.php";

use Classes\email;

$hash = password_hash("system@1", PASSWORD_BCRYPT);
echo $hash."\n";

if (password_verify('system@1', $hash)) {
	echo 'Valid Password. Password is: ' . 'system@1';
} else {
	echo 'Invalid Password';
}


?>