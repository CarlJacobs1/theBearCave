<?php

session_start();
if (isset($_SESSION['id'])) {

    if ($_SESSION['login_time'] < strtotime(date('d-m-Y H:i:s'))) {
        echo '<p>Login Session has Expired</p>';
        echo "<a href=\"login.php\"> Back to Login</a>";
    } else {
        $_SESSION['login_time'] = strtotime('+20 minutes', strtotime(date('d-m-Y H:i:s')));
    }

} else {
    #header("Location: login.php?sessionset=1;");
    echo '<p>PHP Login Session not set.</p>';
    echo "<a href=\"login.php\"> Back to Login</a>";
    die;
}

?>