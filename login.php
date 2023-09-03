<!-- Első megtekintésre (közvetlen linkről) GET kérést kapok, ha pedig 
valaki a gombra kattint (Mentés), akkor POST kérés fut le --> 
<?php 
    include_once('./database.php');
    include_once('./loginhelper.php');

    
    $username = ''; // a username mező értéke
    $password = '';  // a név mező értéke
    $hibauzenetek = []; // validáció során a felmerül hibaüzenetek ebbe a tömbbe rakom
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        include("loginform.php");
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // adatok kiolvasása a form készítéhez 
        if(array_key_exists('username', $_POST)) $username = $_POST['username'];
        if(array_key_exists('password', $_POST)) $password = $_POST['password'];

        // username validáció
        if(!array_key_exists('username', $_POST)){ //  nem létezik a username kód
            $hibauzenetek[] = 'A username kötelező!';
        }
        else if(strlen($_POST['username']) < 6){ // típusell. ide nem kell, helyette rögtön érték validáció
            $hibauzenetek[] = 'A username 6 karakterből kell állnia!';
        }
        // password validáció
        if(!array_key_exists('password', $_POST)){
            $hibauzenetek[] = 'A password megadása kötelező!';
        }
        else if(strlen($_POST['password']) < 8){
            $hibauzenetek[] = 'A password legalább 8 karakter!';
        }
        if(count($hibauzenetek)>  0)
        {
            include("loginform.php");
            //hibaüzenet kiírás
        }
        else
        {
            $succesfulLogin = handleLogin($username,$password);
            if($succesfulLogin)
            {
                login($username, $password);
                header("Location: " . "Index.php");
            }
            else
            {
                $hibauzenetek[] = 'Hibás felhasználónév vagy jelszó';
            }
        }
    }
?>
<!-- ha van hibaüzenet, akkor jelenítsük meg -->
<?php if(count($hibauzenetek) != 0): ?>
    <p>A validálás során az alábbi hibák merültek fel:</p>
    <ul>
        <?php for($i = 0; $i < count($hibauzenetek); $i++): ?>
            <li><?=$hibauzenetek[$i]?></li>
        <?php endfor;?>
    </ul>
<?php endif; ?>
<?php
    function handleLogin($username,$password)
    {
        $records = get_record_list("SELECT * FROM USERS WHERE USERNAME = '$username' AND PASSWORD = '$password';");
        if(count($records) == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }


?>
