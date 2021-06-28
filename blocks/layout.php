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
        foreach ($links as $key => $anch ){
            echo "<li><a href='$anch'>$key</a></li>";
        }
?>
				  </ul>
				</nav>
			</div>
<?php

    // Include pagination
    $status = '1';
    include_once 'pagination.php';

        foreach ($data as  $value) {
		?>
        <div>
		  			<div class="note">
				<br>
                    <div class="date"><?=$value['data_created']?></div>
					<div class="date"><?=$value['genre']?></div>
					<div class="name"><?=$value['name']?></div>
				</p>
				<p>
					<?=$value['text']?>
				</p>
			</div>
		</div>	
<?php
		}
            if ($_SESSION['auth']){
        ?>
            <div class="info alert alert-info">
                <?= $_SESSION['massage']['text_anecdot']?>
            </div>
			<div id="form_main">
				<form action="index.php" method="POST">
					<p><input name="genre" class="form-control" placeholder="Название категорий"></p>
					<p><textarea name="text" class="form-control" placeholder="Напишите свой анекдот"></textarea></p>
					<p><input type="submit" class="btn btn-info btn-block" value="Отправить"></p>
				</form>
			</div>
        <?php
             }
        ?>
            </div>
	</body>
</html>

