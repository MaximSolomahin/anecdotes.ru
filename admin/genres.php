<?php
	session_start();
	if ($_SESSION['auth'] && $_SESSION['admin'] == 'admin'){
		$title = 'Жанры';
		include_once '../functions/function.php';


		 $links =  ['На главную' => '../index.php', 'Пользователи' => 'users.php', 'Админка' => 'admin_page.php'];


		$link = connectDB();
			if(isset($_GET['del'])){
				mysqli_query($link, "DELETE FROM genre WHERE id = '$_GET[del]'");
			}

		$result = mysqli_query($link, "SELECT id, name FROM genre");
		for ($genres = []; $row = mysqli_fetch_assoc($result); $genres[] = $row);

		include_once '../blocks/header.php';
		include_once '../blocks/links.php';
		$table = '';
			$table .= "<table class='table'>
							<tr>
								<th>id</th>
								<th>name</th>
								<th>Удалить</th>
								<th>Редактировать</th>
							</tr>";
			foreach ($genres as $elem){
				$table .= "<tr>
								<td>$elem[id]</td>
								<td>$elem[name]</td>
								<td><a href='?del=$elem[id]'>Удалить</a></td>
								<td><a href='change.php?chenge=$elem[id]'>Изменить</a></td>
							</tr>";
			}
			$table .= '</table>';
	}
	echo $table;