<?php
    session_start();
    include_once 'functions/function.php';
    $link = connectDB();
    $_SESSION['massage'] = ['text' => 'Введите Ваш логин и пароль', 'status' => 'main'];

    if(!empty($_POST['login']) && !empty($_POST['password']) && isset($_POST['submit'])){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $result = mysqli_query($link, "SELECT users.login, users.password FROM users WHERE login = '$login'");
        $user = mysqli_fetch_assoc($result);

        if ($user){
            if (password_verify($password, $user['password'])){

                $result = mysqli_query($link, "SELECT users.id, users.login, admin.name as admin_status  
                        FROM users RIGHT JOIN admin ON users.admin_status = admin.id
                        WHERE login = '$login'");
                $user = mysqli_fetch_assoc($result);


                $_SESSION['id'] = $user['id'];
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = $user['admin_status'];
                $_SESSION['login'] = $user['login'];
                $_SESSION['massage']['text'] = 'Привет' . $user['login'];
                $_SESSION['massage']['status'] = 'true' ;
                header('Location: /index.php');

            } else {
                $_SESSION['massage'] = ['text' => 'Логин или пароль неверный', 'status' => 'false'];
            }
        } else {
            $_SESSION['massage'] = ['text' => 'Логин или пароль неверный', 'status' => 'false'];
        }

    }
    include_once 'blocks/layout_login.php';
