<?php

session_start();
if (isset($_SESSION['id'])) {

    if ($_SESSION['login_time'] < strtotime(date('d-m-Y H:i:s'))) {
        echo '<p>Login Session has Expired</p>';
        echo "<a href=\"login.php\"> Back to Login</a>";
        die;
    } else {
        $_SESSION['login_time'] = strtotime('+20 minutes', strtotime(date('d-m-Y H:i:s')));
        $session_username = $_SESSION['username'];
        $session_first_name = $_SESSION['first_name'];
        $session_last_name = $_SESSION['last_name'];
        $session_id = $_SESSION['id'];
        $session_login_time = $_SESSION['login_time'];
    }

} else {
    #header("Location: login.php?sessionset=1;");
    echo '<p>PHP Login Session not set.</p>';
    echo "<a href=\"login.php\"> Back to Login</a>";
    die;
}

?>