<?php
    include_once 'header.php';
?>
<div id="wrapper">
    <div id="form">
        <form action="../register.php" method="POST">

            <p><input class="form-control" name="login" placeholder="Ваш логин"></p>
            <p><input type="password" class="form-control" name="password" placeholder="Ваш пароль"></p>
            <p><input type="password" class="form-control" name="confirm" placeholder="Повторите Ваш пароль"></p>
            <p><input type="email" class="form-control" name="email" placeholder="Введите Вашу электронную почту"></p>

            <p><input type="submit" name="submit" class="btn btn-info btn-block" value="Зарегистрировать"></p>
        </form>
    </div>
</div>
</body>
</html>

