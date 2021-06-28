<?php
    session_start();
    $_SESSION['auth'] = null;
    $_SESSION['login'] = null;
    $_SESSION['admin'] = null;
    $_SESSION['id'] = null;
    $_SESSION['massage'] = null;

    header('Location: index.php'); die();
