<!DOCTYPE html>
<?php
include_once("loginhelper.php");
$logged_in = getLoggedInUser();
if($logged_in == null)
{
  // hibaüzenet sikertelen hozzáférésre, pl.:
  echo "Nincs jogosultságod megtekinteni ezt az oldalt. <a href='login.php'>Vissza a belépéshez</a>";
}
?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOVXX_beadando</title>
</head>
<body>
    <header><?php require'./header.php'?></header><!--állandó-->
    <nav><?php require'./nav.php'?></nav><!--állandó-->
    <article><?php require'./content.php'?></article><!--url függő így külön állományba kerül-->
    <footer><?php require'./footer.php'?></footer><!--állandó-->
</body>
</html>