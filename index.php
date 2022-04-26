<?php 
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP zárófeladat - Userek listázása</title>
</head>

<body>

    <?php
    // Kapcsolódás adatbázishoz
    $connection = mysqli_connect("localhost:3306", "root", "", "phpfeladat");
    mysqli_set_charset($connection, "utf8mb4");

    // Sorok kiválasztása az users táblából
    $sql = "SELECT name, email, created_at FROM users";
    $result = $connection->query($sql);

    // Kapcsolódási hiba ellenőrzése
    $error = mysqli_error($connection);

    if ($error) {
        echo $error;
    }

    // // Táblázat létrehozása
    // if ($result->num_rows > 0) {
    //     echo "<table><tr><th>Név</th><th>E-mail</th><th>Regisztráció dátuma</th><th>Művelet</th></tr>";
    //     // Sorok feltöltése tartalommal
    //     while ($row = $result->fetch_assoc()) {
    //         echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["created_at"] . "</td><td>" . $row["name"] . "</td></tr>";
    //     }
    //     echo "</table>";
    // } else {
    //     echo "Nincs találat!";
    // }

    ?>

    <!-- Táblázat létrehozása Bootstrap-el kezdete -->

        <div class="container">
            <div class="row row-cols-4">

            <?php

            $adatok = $_GET;

            extract($adatok);
            // szerkesztés és törlés gombok

            //szerkesztés
            
            if( isset($szerkesztes)){
                header("Location: szerkesztes.php");
                exit;
                $nev = 'nev';
                $email = 'email';
                $regisztracio_datuma = 'regisztracio_datuma';

                $query = "UPDATE users SET name='$nev', email='$email',created_at='$regisztracio_datuma' ";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Sikeresen szerkesztve!";
                    header("location: szerkesztes.php");
                }
                
                else{
                    $_SESSION['status'] = "Sikertelen szerkesztés!";
                    header("location: szerkesztes.php");
                }


                }       

            //törlés
            if( isset($torles)){
                $nev = 'nev';
                $email = 'email';
                $regisztracio_datuma = 'regisztracio_datuma';

                $query = "UPDATE users SET name='$nev', email='$email',created_at='$regisztracio_datuma' ";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Sikeresen törölve!";
                }
                
                else{
                    $_SESSION['status'] = "Sikertelen törlés!";
                }

                }

            ?>
            
            <h2 class="col-12 text-center">Userek listázása</h2>

                <?php

                // Táblázat létrehozása
                if ($result->num_rows > 0) {
                    echo    '<div class="p-2 col border border-dark text-white bg-dark text-center">Név</div>
                            <div class="p-2 col border border-dark text-white bg-dark text-center">E-mail</div>
                            <div class="p-2 col border border-dark text-white bg-dark text-center">Regisztráció dátuma</div>
                            <div class="p-2 col border border-dark text-white bg-dark text-center">Művelet</div>';

                    // Sorok feltöltése tartalommal
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="d-flex flex-column justify-content-center align-items-center border border-dark text-center" name="nev">' . $row["name"] . 
                             '</div><div class="d-flex flex-column justify-content-center align-items-center border border-dark text-center" name="email">' . $row["email"] . 
                             '</div><div class="d-flex flex-column justify-content-center align-items-center border border-dark text-center" name="regisztracio_datuma">' . $row["created_at"] . 
                             '</div><div class="col border border-dark text-center">' . 
                             
                             '<div class="p-2 d-flex justify-content-around">
                             <button type="submit" name="szerkesztes" class="btn btn-success">szerkesztés</button>
                             <button type="submit" name="torles" class="btn btn-danger" >törlés</button>
                             </div>'
                             . '</div>';
                    }
                    echo "</div><br>";
                } else {
                    echo "Nincs találat!";
                }

                ?>

        </div>
        <!-- Táblázat létrehozása Bootstrap-el vége -->

        <!-- Bootstrap javascript meghívása -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>