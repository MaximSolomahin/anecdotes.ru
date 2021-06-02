<?php
    session_start();
    include_once 'functions/function.php';
    $link = connectDB();
    if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm']) && !empty($_POST['email']) && isset($_POST['submit'])) {

        $login = mysqli_escape_string($link, $_POST['login']);
        $password = mysqli_escape_string($link, $_POST['password']);
        $confirm = mysqli_escape_string($link, $_POST['confirm']);
        $email = mysqli_escape_string($link, $_POST['email']);

        if ($password === $confirm){
            //валидация , Выплняется в подключенном файле функций
            if (validLogin($login) === false && validPass($password) === false && validEmail($email) === false){

                $result = mysqli_query($link, "SELECT users.login, users.email FROM users WHERE login = '$login' OR email = '$email'");
                $checkUser = mysqli_fetch_assoc($result);

                if(!$checkUser){
                    //Добавление
                    $hash = password_hash($password,  PASSWORD_DEFAULT);
                    mysqli_query($link, "INSERT INTO users SET login = '$login', password = '$hash', email = '$email', admin_status = '1', ban_status = '2'") or die(mysqli_error($link));

                    $_SESSION['id'] = mysqli_insert_id($link);
                    $_SESSION['auth'] = true;
                    $_SESSION['login'] = $login;
                    $_SESSION['massage']['text'] = 'Регистрация прошла успешно';
                    $_SESSION['massage']['status'] = 'true' ;
                    header('Location: /index.php');

                } else {
                    if (!empty($checkUser['login'])){
                        $_SESSION['massage']['text'] = 'Пользователь с данным логином уже существует';
                        $_SESSION['massage']['status'] = 'false' ;
                    }
                    if (!empty($checkUser['email'])){
                        $_SESSION['massage']['text'] = 'Данная электронная почта уже зарегистрированна';
                        $_SESSION['massage']['status'] = 'false' ;
                    }
                }
            } else {
                if (validLogin($login)) {
                    $validError['login'] = validLogin($login);
                }
                elseif (validPass($password)) {
                    $validError['pass'] = validPass($password);
                }
                elseif (validEmail($email)) {
                    $validError['email'] = validEmail($email);
                }
            }
        } else {
            $_SESSION['massage']['text'] = 'Проверочный пароль не совпал' ;
            $_SESSION['massage']['status'] = 'false' ;
        }
    } else {
        $_SESSION['massage']['text'] = 'Введите ваши данные';
    }
    include 'blocks/layout_register.php';
