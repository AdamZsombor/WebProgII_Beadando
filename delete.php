<?php 
/*
    //ez az egész fájl egy órai munkából van kivágva, még sehol nincs hasznosítva
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        // ez a fájl csak post kéréseket fogad, így visszairánytom a listára 
        header('Location: http://localhost/RE1D25_1/0424/urlap2.php');
        exit;
    }

    // ha nem létezik a post tömbben a student_neptun bejegyzés, vagy üres, akkor 
    // vissza megyünk a listára 
    if(!array_key_exists('student_neptun', $_POST) || 
        empty($_POST['student_neptun'])){
        header('Location: http://localhost/RE1D25_1/0424/urlap2.php');
        exit;
    }

    require_once './database.php'; // betöltöm a db kezelő függvényeket
    // a lekrédezés végrehajtásához egy nc nevű dinamikus paramétert kell kapni 
    $query = "SELECT * FROM students WHERE neptun = :nc";
    // a dinamikus paramétereket egy asszoc. tömbbe kell rakni név orinetáltan 
    $query_params = [':nc' => $_POST['student_neptun']];
    $record = get_record($query, $query_params);
    if(empty($record)){ // adott nk-val nem találtam rekordot
        // visszairányítom a lista oldalra 
        header('Location: http://localhost/RE1D25_1/0424/urlap2.php');
        exit;
    }

    $delete_query = 'DELETE FROM students WHERE neptun = :del_neptun';
    $delete_params = [ ':del_neptun' => $_POST['student_neptun']];
    $delete_result = dml($delete_query, $delete_params);
    if($delete_result){ // ha sikerül a törlés, vissza a lista oldalra 
        header('Location: http://localhost/RE1D25_1/0424/urlap2.php');
        exit;
    }
    */
    include_once("loginhelper.php");
    $logged_in = getLoggedInUser();
    if($logged_in == null)
    {
      echo "Nincs jogosultságod megtekinteni ezt az oldalt. <a href='login.php'>Vissza a belépéshez</a>";
    }
    require_once './database.php';

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      // itt reagálsz a válaszra, opcionális
    }
    xhttp.open("POST", "delete.php");

    // ez azt jelenti, hogy a nrv=ertek&nev2=ertek2 formátumban küldesz adatot xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("szoparId=" + szoparId); // a szoparId változót kiszeded a data-ból amit a táblázatra raktál vagy a gombra
    ?>
