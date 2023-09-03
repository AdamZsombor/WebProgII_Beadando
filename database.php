<?php // db kezeléshez szükséges segédfüggvények

/*
Az adatbázis szerkezete amiből a program dolgozik:

SZOPAROK(ID(PK),szotarID(FK),magyar_szo,idegen_szo)
SZOTAR(ID(PK),userID(FK),idegen_nyelv_neve)
USERS(ID(PK),username,password,session,sessionEND)
*/


// segédkonstansok a db csatlakozás leírásához 
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'beadando');
define('DB_PASS', 'VOPQroONhZEotQl!');
define('DB_NAME', 'beadando');
// mivel pdo-t használunk, így azonosítani kell a db típusát 
define('DB_TYPE', 'mysql');

// db csatlakozáshoz szükséges függvény 
function get_connection(){
    // mi pdo-t használunk a db kapcsolathoz
    $conn_string = DB_TYPE.':host='.DB_HOST.':'.DB_PORT.';dbname='.DB_NAME.';';
    // létrehozom a pdo példányt 
    $conn = new PDO($conn_string, DB_USER, DB_PASS); // létrehozza és megynyitja a kapcsolatot 
    // visszadom a nyitott kapcsolatot 
    return $conn;
}

// rekordlisták lekérdezése 
function get_record_list($query_string){
    // 1) nyitott db kapcsolat kérése 
    $connection = get_connection(); 
    // 2) létrehozok egy utasítást a szövegesen megfog. lekérdezésből 
    $statement = $connection->prepare($query_string); 
    // 3) lefuttatom a lekérdezést, válasz: igaz/hamis (sikerült-e?)
    $success = $statement->execute();
    // 4) feldolgozom a rekordokat
    // ha nem sikerült a lekérdezés üres rekordhalmazzal térek vissza AZONNAL
    if(!$success) return []; 

    $result = $statement->fetchAll(); // minden rekord visszaolvasása egy lépésben 
    // a result egy olyan tömb, amely olyan asszoc tömböket tartalmaz, ahol a mező
    // nevével tudjuk kivenni az értéket 

    // 5) lezárom a kapcsolatot 
    $statement->closeCursor();
    $connection = null; //pdo-ban így zárjuk le 
    // 6) visszadom a rekordokat a hívás helyére 
    return $result;
}
//új funkciók(nem óraiak)
function update_record($table_name, $where, $updates)
{
  $updateJoined = implode(", ", array_map(function($key, $val) { return "$key = '$val'"; }, array_keys($updates), $updates));
  $whereJoined =  implode(" AND ", array_map(function($key, $val) { return "$key = '$val'"; }, array_keys($where), $where));
  $query_string = "UPDATE $table_name SET $updateJoined WHERE $whereJoined";
  $connection = get_connection(); 
  $statement = $connection->prepare($query_string); 
  $success = $statement->execute();

  return $success;
}
function insert_record($table_name, $values)
{
  $query_string = "INSERT INTO $table_name VALUES ($values)";
  $connection = get_connection(); 
  $statement = $connection->prepare($query_string); 
  $success = $statement->execute();
}
function delete_record($table_name, $where)
{
  $where_sql = "";
  if (count($where) > 0)
  {
    $where_sql = implode(" AND ",  array_map(function($key, $val) { return "$key = '$val'"; }, array_keys($where), $where));
  }
  $query_string = "DELETE FROM $table_name $where_sql";
  
  $connection = get_connection(); 
  $statement = $connection->prepare($query_string); 
  $success = $statement->execute();

  return $success;
}