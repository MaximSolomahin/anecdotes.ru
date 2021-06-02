<?php
include_once 'header.php';
?>
<body>
<div id="wrapper">
    <h1 calss="<?=$_SESSION['massage']['status']?>"><?=$_SESSION['massage']['text']?> </h1>
    <div>
        <nav>
            <ul class="pagination">
                <?php
                foreach ($links as $key => $link ){
                    echo "<li><a href='$link'>$key</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
    <div class="note">
        <p>
            <span class="date">18.04.2014 23:59:59</span>
            <span class="name">Дмитрий</span>
        </p>
        <p>
            Lorem ipsum dolor sit amet,
            consectetur adipiscing elit.
            Nulla efficitur elementum lorem id venenatis.
            Nullam id sagittis urna, eu ultrices risus.
            Duis ante lorem, semper nec fringilla eu,
            commodo vel mauris. Nunc tristique odio lectus, eget condimentum nunc consectetur eu. Nullam non varius nisl, aliquet fringilla lectus. Aliquam erat volutpat. Ut vel mi et lectus hendrerit ornare vel ut neque. Quisque venenatis nisl eu mi
        </p>
    </div>

</div>
<div class="info alert alert-info">
    Запись успешно сохранена!
</div>
<div id="form">
    <form action="#form" method="POST">
        <p><input class="form-control" placeholder="Ваше имя"></p>
        <p><textarea class="form-control" placeholder="Ваш отзыв"></textarea></p>
        <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
    </form>
</div>
</div>
</body>
</html>
