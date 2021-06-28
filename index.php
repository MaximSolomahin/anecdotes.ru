<?php
    session_start();
    $title = 'Анекдоты';
    include_once 'functions/function.php';
    $link = connectDB();

    if ($_SESSION['auth']){
        $links = ['Выйти' => 'logout.php'];
            if ($_SESSION['admin'] == 'admin'){
                $links = array_merge($links, ['Админка' => 'admin/admin_page.php']);
            }

            if (!empty($_POST['genre']) && !empty($_POST['text'])) {
                $genre = $_POST['genre'];
                $anecdote = $_POST['text'];


                $result = mysqli_query($link, "SELECT genre.id, genre.name FROM genre WHERE name = '$genre'");
                $genre_name = mysqli_fetch_assoc($result);


                $result = mysqli_query($link, "SELECT genre.name AS genre FROM anecdotes LEFT JOIN
                genre ON anecdotes.genre_id = genre.id WHERE text = '$anecdote'");
                $text_anecdote = mysqli_fetch_assoc($result);


                	if ($text_anecdote){
                        $_SESSION['massage']['text_anecdot'] = 'Такой же анекдот был найден в категории ' . $text_anecdote['genre'];
                	} else {
                	
                    	if ($genre_name){
                        	mysqli_query($link, "INSERT INTO anecdotes SET 
                        	author_id = '$_SESSION[id]', genre_id = '$genre_name[id]', status_id = '2', text = '$anecdote' ");
                        	$_SESSION['massage']['text_anecdot'] = 'Спасибо за предлженный анекдот, после проверки модератором Ваш анекдот опубликуется';
                            header('Location: /index.php'); die();
                    	} else {
                       		 mysqli_query($link, "INSERT INTO genre SET name = '$genre' ");

                       		$result = mysqli_query($link, "SELECT genre.id FROM genre WHERE name = '$genre'");
                        	$genre_id = mysqli_fetch_assoc($result);


                       		 mysqli_query($link, "INSERT INTO anecdotes SET 
                        author_id = '$_SESSION[id]', genre_id = '$genre_id[id]',  status_id = '2', text = '$anecdote' ");
                        	$_SESSION['massage']['text_anecdot'] = 'Спасибо за предлженный анекдот, после проверки модератором Ваш анекдот опубликуется';
                            header('Location: /index.php'); die();
                    }
                }
            } else {
                $_SESSION['massage']['text_anecdot'] = 'Предлагайте свои анекдоты, посмеемся вместе!';
        }



	} else {
        $_SESSION['massage'] = ['text' => 'Здравствуйте. Войдите или зарегистрируйтесь на сайте', 'status' => 'true' ];
        $links = ['Войти' => 'login.php', 'Зарегистрироваться' => 'register.php'];
	}


	include_once 'blocks/layout.php';
    $_SESSION['massage'] = null;