<?php
    session_start();
    if($_SESSION['auth'] && $_SESSION['admin'] == 'user') {
        include_once '../functions/function.php';
        $link = connectDB();

        $links = ['Пользователи' => 'users.php'];
    }

