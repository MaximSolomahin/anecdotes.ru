<?php
       // Провряем есть ли категория и подсчитываем кол-в записей в ней, если нет категориии товыбираем все записи и елим на количество страниц
        if (!empty($_POST['genre'])){
            $result = mysqli_query($link, "SELECT COUNT(*) AS count FROM anecdotes LEFT JOIN genre 
                ON anecdotes.genre_id = genre.id WHERE genre.name = '$_POST[genre]' AND  anecdotes.status_id = '$status'");
            $count = ceil(mysqli_fetch_assoc($result)['count']);
        } else {
            $result = mysqli_query($link, "SELECT COUNT(*) AS count FROM anecdotes WHERE status_id = '$status'");
            $count = ceil(mysqli_fetch_assoc($result)['count']);
        }

    $result = mysqli_query($link, "SELECT DISTINCT genre.name FROM genre LEFT JOIN anecdotes ON anecdotes.genre_id = genre.id
        WHERE anecdotes.genre_id IS NOT NULL AND anecdotes.status_id = $status ORDER BY genre.name ");
    for($genre = []; $row = mysqli_fetch_assoc($result); $genre[] = $row);

        if (isset($_GET['page'])) {
        $page = $_GET['page'];
        } else {
        $page = 1;
        }

        $anecOnPage = 5;
?>
    <div>
        <div class="selects">
            <form action="" method="POST">
                <select name="genre">
                    <option selected value="">Все категории</option>
                        <?php
                            foreach($genre as $elem){
                                ?>
                                 <option name="<?=$elem['name']?>"><?=$elem['name']?></option>
                        <?php
                            }
                        ?>
                </select>
                <input type="submit" name="submit" value="Выбрать">
            </form>
        </div>

        <nav>
            <ul class="pagination">
                <?php
                    for ($i = 1; $i <= ceil($count/ $anecOnPage); $i++ ){
                        echo "<li><a href=\"?page=$i\">$i</a></li>";
                        // Тутнужно поправить количество страниц
                    }
                ?>
            </ul>
        </nav>
    </div>
<?php
        if(!empty($_POST['genre'])){
           $selGenre = " and genre.name = '$_POST[genre]'";
        } else {
            $selGenre = '';
        }

        $from = ($page - 1) * $anecOnPage;

        $result = mysqli_query($link, "SELECT users.login as name, genre.name as genre, anecdotes.text, anecdotes.data_created,
                        anecdotes.id 
                        FROM anecdotes INNER JOIN users ON anecdotes.author_id = users.id
                        INNER JOIN genre ON anecdotes.genre_id = genre.id 
                        WHERE anecdotes.status_id = '$status' $selGenre ORDER BY anecdotes.id DESC LIMIT $from, $anecOnPage");

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);