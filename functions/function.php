<?php
    function connectDB(){
        $link = mysqli_connect('anecdotes.ru', 'root', 'root', 'anecdotes')
            or die(mysqli_error($link));
        return $link;
    }