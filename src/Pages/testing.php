<?php

require"../Composer/vendor/autoload.php";

use Classes\email;


$email = new email('carl.jacobs3@gmail.com', 'Subject', email::getHTMLEmailFromFile(email::HTML_MAIL_NEW_USER_REGISTRATION));

echo $email->message;

$email->message = str_replace('<<tokenPlaceholder>>', 'c4c2b4d4-9f1b-11e8-9e1a-ac220b15705f', $email->message);

echo $email->message;



?>