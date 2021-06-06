
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

<?php
        $status = '2';

        include_once '../blocks/pagination.php';

    foreach ($data as $elem){
?>
        <div class="data_admin">
            <p>
                <div class="name"><b><?=$elem['genre']?></b></div>
                <span class="date"><?=$elem['data_created']?></span>
                <span class="name"><b><?=$elem['name']?></b></span>
                <span class="name"><?=$elem['text']?></span>
                <div class="name"><a href="?access=<?=$elem['id']?>">Принять</a></div>
                <div class="name"><a href="?deny=<?=$elem['id']?>">Отклонить</a></div>
            </p>
            <p>

            </p>
        </div>
    <?php
    }
    if (!empty($_SESSION['massage']['text_anecdot'])){
    ?>
    <div class="info alert alert-info">
        <?= $_SESSION['massage']['text_anecdot']?>
    </div>
<?php
    }
?>
        <div id="form_admin">
            <form action="#form" method="POST">
                <p><input class="form-control" placeholder="Ваше имя"></p>
                <p><textarea class="form-control" placeholder="Ваш отзыв"></textarea></p>
                <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
            </form>
        </div>
    </div>
</body>
</html>
