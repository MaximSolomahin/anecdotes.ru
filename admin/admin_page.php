<?php
    session_start();
    if($_SESSION['auth'] && $_SESSION['admin'] == 'admin') {
        include_once '../functions/function.php';
        $link = connectDB();

        $links =  ['На главную' => '../index.php', 'Пользователи' => 'users.php'];

        if (isset($_GET['access'])){
            mysqli_query($link, "UPDATE anecdotes SET status_id = '1' WHERE id = '$_GET[access]' ");
            $_SESSION['massage']['text_anecdot'] = 'Принято на сайт';
        }
        if (isset($_GET['deny'])){
            mysqli_query($link, "DELETE FROM anecdotes WHERE id = '$_GET[deny]' ");
            $_SESSION['massage']['text_anecdot'] = 'Анекдот удален';
        }


        include_once '../blocks/header.php';
        include_once '../blocks/layout_admin.php';

        $_GET = null;
        $_SESSION['massage']['text_anecdot'] = null;

    }

