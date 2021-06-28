<?php
/*var_dump($_SERVER['REQUEST_URI']);
//echo preg_match('#^.+\/.+\.php?#', $_SERVER['REQUEST_URI']);
    if(preg_match('#^\/.+\/.+\.php?#', $_SERVER['REQUEST_URI'])){
        echo  preg_replace('#^\/.+\/(.+\.php)?#', '$1', $_SEREVER['REQUEST_URI']);
        var_dump($path);
    }*/
            $links =  ['На главную' => '../index.php', 'Пользователи' => 'users.php', 'Жанры' => 'genres.php', 'Админка' => 'admin_page.php'];
?>
<body>
<div id="wrapper">
    <h1 calss="<?=$_SESSION['massage']['status']?>"><?=$_SESSION['massage']['text']?> </h1>
    <div>
        <nav>
            <ul class="pagination">
                <?php
                foreach ($links as $key => $elem ){
                    echo "<li><a href='$elem'>$key</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>