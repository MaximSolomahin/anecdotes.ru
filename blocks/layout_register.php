<?php
    include_once 'header.php';
?>
<div id="wrapper">
    <div id="form">
        <form action="" method="POST">
            <?php
             if (isset($validError['login'])){echo "<div class=\"info alert alert-info\">$validError[login]</div>";
             } else {
                echo "<div class=\"info alert alert-info\" background-color=\"red\">".$_SESSION['massage']['text']."</div>";
             }
             ?>
            <p><input class="form-control" name="login" placeholder="Введите ваш логин" value="<?=$login?>"></p>
            <?php if (isset($validError['password'])){echo "<div class=\"info alert alert-info\">
                $validError[password]</div>";}?>
            <p><input type="password" class="form-control" name="password" placeholder="Введите ваш пароль"></p>
            <p><input type="password" class="form-control" name="confirm" placeholder="Подтвердите пароль"></p>
            <?php if (isset($validError['email'])){echo "<div class=\"info alert alert-info\">$validError[email]</div>";}?>
            <p><input type="email" class="form-control" name="email" placeholder="Введите вашу электронную почту" value="<?=$email?>"></p>

            <p><input type="submit" name="submit" class="btn btn-info btn-block" value="Зарегистрироваться"></p>
        </form>
    </div>
</div>
</body>
</html>

