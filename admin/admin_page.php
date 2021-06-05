<?php
    session_start();
    if($_SESSION['auth'] && $_SESSION['admin'] == 'admin') {
        include_once '../functions/function.php';
        $link = connectDB();

        $links = ['Пользователи' => 'users.php'];

            $stylesheet = '<link rel="stylesheet" href="/../css/bootstrap/css/bootstrap.css">';
            $stylesheet2 ='<link rel="stylesheet" href="/../css/styles.css">';


        include_once '../blocks/layout_admin.php';

    }

