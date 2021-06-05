<?php
    session_start();

    echo '<a href="admin_page.php">nen</a>';
    if($_SESSION['auth'] && $_SESSION['admin'] == 'admin') {
        include_once '../functions/function.php';
        $link = connectDB();
        //Start command

        if (isset($_GET)){
            if (isset($_GET['ban'])){
                mysqli_query($link, "UPDATE users SET ban_status = 1 WHERE id = '$_GET[ban]' ");
            }
            if (isset($_GET['unban'])){
                mysqli_query($link, "UPDATE users SET ban_status = 0 WHERE id = '$_GET[unban]' ");
            }

            if (isset($_GET['del_admin'])){
                mysqli_query($link, "UPDATE users SET admin_status = 1 WHERE id = '$_GET[del_admin]' ");
            }
            if (isset($_GET['add_admin'])){
                mysqli_query($link, "UPDATE users SET admin_status = 2 WHERE id = '$_GET[add_admin]' ");
            }
        }


        $result = mysqli_query($link, "SELECT users.id, users.login, users.email, users.ban_status, admin.name AS admin_status FROM
        users LEFT JOIN admin ON users.admin_Status = admin.id") or die(mysqli_error($link));
        for($users = []; $row = mysqli_fetch_assoc($result); $users[] = $row);


        $table = '';
        $table .= "
            <table border='1px'>
                <tr>
                    <th>id</th>
                    <th>Логин</th>
                    <th>Email</th>
                    <th>Админка</th>
                    <th>Статус</th>
                    <th>Дать/отнять админку</th>
                    <th>Дать бан/ разбанить</th>
                <tr>
        ";

            foreach ($users as $data){

                if ($data['ban_status'] == 1){
                    $ban_status = 'Забанен';
                    $banned = 'Рабанить';
                    $href = '?unban';
                } else {
                    $ban_status = 'Активен';
                    $banned = 'Забанить';
                    $href = '?ban';
                }

                if ($data['admin_status'] == 'admin'){
                    $admin = 'Забрать админку';
                    $href_admin = '?del_admin';
                } else {
                    $admin = 'Дать админку';
                    $href_admin = '?add_admin';
                }
                    $table .= "
                    <tr>
                        <th>$data[id]</th>
                        <th>$data[login]</th>
                        <th>$data[email]</th>
                        <th>$data[admin_status]</th>
                        <th>$ban_status</th>
                        <th><a href='$href_admin=$data[id]'>$admin</a></th>
                        <th><a href='$href=$data[id]'>$banned</th>
                    </tr>
                ";
             }

        $table .= '</table>';
    }

    echo $table;
