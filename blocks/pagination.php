<?php
    $result = mysqli_query($link, "SELECT COUNT(*) AS count FROM anecdotes WHERE status_id = '$status'");
    $count = ceil(mysqli_fetch_assoc($result)['count']);



        if (isset($_GET['page'])) {
        $page = $_GET['page'];
        } else {
        $page = 1;
        }

        $anecOnPage = 5;
?>
    <div>
        <nav>
            <ul class="pagination">
                <?php
                    for ($i = 1; $i <= ceil($count/ $anecOnPage); $i++ ){
                        echo "<li><a href=\"?page=$i\">$i</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>
<?php
        $from = ($page - 1) * $anecOnPage;

        $result = mysqli_query($link, "SELECT users.login as name, genre.name as genre, anecdotes.text, anecdotes.data_created,
                        anecdotes.id 
                        FROM anecdotes INNER JOIN users ON anecdotes.author_id = users.id
                        INNER JOIN genre ON anecdotes.genre_id = genre.id 
                        WHERE anecdotes.status_id = '$status' ORDER BY anecdotes.id DESC LIMIT $from, $anecOnPage");

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);