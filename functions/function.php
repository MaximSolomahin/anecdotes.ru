<?php
    function connectDB(){
        $link = mysqli_connect('localhost', 'root', 'root', 'anecdotes')
            or die(mysqli_error($link));
        return $link;
    }


    //functions for validation
    function validLogin($login)
    {
        if (preg_match('#[a-zA-Z0-9]{6,12}#', $login)) {
            return false;
        } else {
            $error = 'Логин должен состоять от 6 до 12 латинских символов и(или) цифр';
            return $error;
        }
    }

    function validPass($password)
    {
        if (preg_match('#[a-zA-Z0-9]{5,10}#', $password)) {
            return false;
        } else {
            $error = 'Пароль должен состоять от 6 до 12 латинских символов и(или) цифр';
            return $error;
        }
    }

    function validEmail($email)
    {
        if (preg_match('#^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$#', $email)) {
            return false;
        } else {
            $error = 'Некоректный адрес электронной почты';
            return $error;
        }
    }
