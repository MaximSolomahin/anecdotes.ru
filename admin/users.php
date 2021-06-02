<?php
    session_start();
    if($_SESSION['auth'] && $_SESSION['admin'] == 'user') {
        include_once '../functions/function.php';
        $link = connectDB();


        $result = mysqli_query($link, "SELECT users.id, users.login, users.email, users.ban_status, admin.name AS admin_status FROM
        users LEFT JOIN admin ON users.admin_Status = admin.id") or die(mysqli_error($link));
        for($users = []; $row = mysqli_fetch_assoc($result); $users[] = $row);


    var_dump($users);
        $table = '';
        $table .= "
            <table>
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
        foreach ($users as $elem) {
            foreach ($elem as $data){
                if ($data['ban_status'] == 1){
                    $ban_status = 'Забанен';
                    $banned = 'Рабанить';
                } else {
                    $ban = 'Активен';
                    $banned = 'Забанить';
                }

                if ($data['admin_status'] == 'user'){
                    $admin = 'Забрать админку';
                } else {
                    $admin = 'Дать админку';
                }
                    $table .= "
                    <tr>
                        <th>$data[id]</th>
                        <th>$data[login]</th>
                        <th>$data[email]</th>
                        <th>$data[admin_status]</th>
                        <th>$ban_status</th>
                        <th><a href='?admin=$data[id]'>$admin</a></th>
                        <th><a href='?ban=$data[id]'>$banned</th>
                    </tr>
                ";
             }
        }
        $table .= '</table>';
    }

    echo $table;
