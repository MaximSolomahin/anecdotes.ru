<?php
    session_start();

    if ($_SESSION['auth']){
        $links = ['Выйти' => 'logout.php'];
            if ($_SESSION['admin'] == 'user'){
                $links = array_merge($links, ['Админка' => 'admin/admin_page.php']);
            }
	} else {
        $_SESSION['massage'] = ['text' => 'Здравствуйте. Войдите или зарегистрируйтесь на сайте', 'status' => 'true' ];
        $links = ['Войти' => 'login.php', 'Зарегистрироваться' => 'register.php'];

	}
	include_once 'blocks/layout.php';
    $_SESSION['massage'] = null;