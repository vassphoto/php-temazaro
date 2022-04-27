<?php

    //törlés
    if( isset($_GET['torles'])){

        // Kapcsolódás adatbázishoz
        $connection = mysqli_connect("localhost:3306", "root", "", "phpfeladat");
        mysqli_set_charset($connection, "utf8mb4");

        $errors = [];

        // Kapcsolódási hiba ellenőrzése
        $error = mysqli_error($connection);

        if ($error) {
            echo $error;
        }

        $id = $_GET['ID'];

        // Sorok kiválasztása az users táblából
        $query = "DELETE FROM users WHERE id =$id";
        $torles = mysqli_query($connection, $query);

        if($torles)
        {
            echo 'Sikeres törlés!';
        }else{
            echo 'Sikertelen törlés!';
        }
        mysqli_close($connection);
    }

?>