<?php

    //törlés
    if( isset($torles)){
        $nev = 'nev';
        $email = 'email';
        $regisztracio_datuma = 'regisztracio_datuma';

        $query = "DELETE FROM users WHERE id=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
             $_SESSION['status'] = "Sikeresen törölve!";
        }
                
        else{
            $_SESSION['status'] = "Sikertelen törlés!";
            }

            }

?>