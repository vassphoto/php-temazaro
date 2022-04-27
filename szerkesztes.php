<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP zárófeladat - User szerkesztése</title>
</head>

<body>

    <?php
    // Kapcsolódás adatbázishoz
    $connection = mysqli_connect("localhost:3306", "root", "", "phpfeladat");
    mysqli_set_charset($connection, "utf8mb4");

    $errors = [];

    // Sorok kiválasztása az users táblából
    $sql = "SELECT name, email, created_at FROM users";
    $result = $connection->query($sql);

    // Kapcsolódási hiba ellenőrzése
    $error = mysqli_error($connection);

    if ($error) {
        echo $error;
    }

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

    if (isset($_GET["mentes"])) {

        $length = strlen($_GET["name"]);
        $id = $_GET['id'];
        $name = $_GET['nev'];
        $email = $_GET['email'];

    if (count($errors) === 0) {
        //update
        mysqli_query($connection, "update users set content
                                                name = '" . $_GET["nev"] . "', 
                                                email = '" . $_GET["email"] . "', 
                                                WHERE id = $id
                                                ");
        echo mysqli_error($connection);

        echo '<div class="alert alert-success col-md-8 col-lg-6 mx auto" role="alert">
        Sikeres adatmódosítás!
      </div>';
        }
    }

    ?>

    <!-- Táblázat létrehozása Bootstrap-el kezdete -->

    <div class="container">
        <div class="row">

            <h2 class="col-12 text-center">User szerkesztése</h2>

            <?php

            // if($isset($_SESSION['status'])){
            //     echo "<h4>".$_SESSION['status']."</h4>";
            //     unset($_SESSION['status']);
            // }

            echo '<div class="d-flex align-items-center flex-column">';

                      // User adatok megjelenítése és szerkesztése
            echo            '<div class="col-3 p-2">
                                <label for="nev" class="form-label">Név</label>
                                <input type="text" class="form-control" id="nev" name="nev" method="get">
                            </div>
                            
                            <div class="col-3 p-2">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" method="get">
                            </div>
                             
                             <button type="submit" name="mentes" method="get" class="col-3 btn btn-success">Mentés</button>';

            echo '</div>';
            ?>

        </div>
    </div>
    <!-- Táblázat létrehozása Bootstrap-el vége -->

    <!-- Bootstrap javascript meghívása -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>