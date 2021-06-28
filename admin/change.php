<?php 
	session_start();
	if ($_SESSION['auth'] && $_SESSION['admin'] == 'admin'){
		include_once '../functions/function.php';

		$link = connectDB();
		$id = $_GET['chenge'];

		$result = mysqli_query($link, "SELECT * FROM genre WHERE id = '$id'");
		$genre_change = mysqli_fetch_assoc($result);

		if ($_POST['name'] != $genre_change['name'] && isset($_POST['submit'])){
			mysqli_query($link, "UPDATE genre SET name = '$_POST[name]' WHERE id = '$id'");
			$_SESSION['massage']['text'] = 'Изменения успешно сохранены';
			header ('Location: /admin/genres.php'); die();
		}
		include_once '../blocks/header.php';

?>
<div id="change">
	<form action="" method="POST">
		<p><input  class="form-control" name="name"  value="<?=$genre_change['name']?>"></p>

        <p><input type="submit" name="submit" class="btn btn-info btn-block" value="Изменить"></p>
    </form> 
</div>
<?php
	}