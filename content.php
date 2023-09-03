<?php
    $magyarszo = '';
    $idegenszo = '';
    include("newWordForm.php");

    $szoparok = get_record_list("SELECT ID, szotarID, magyar_szo, idegen_szo FROM szoparok WHERE szotarId = 1 /* pillanatnyilag nyelv alapján de majd user alapján (is) kell*/");

    drawtable($szoparok);
    function drawtable($collection) //meg be kell adni neki egy tömb formájában a szavakat hogy azt a for loop ki tudja írni
    {
        if(count($collection) == 0)
        {
            echo"Még nincsnek szavak hozzáadva a táblázatodhoz";
        }
        echo"<table border = '1'>";
        for ($x = 0; $x < count($collection); $x++) {
            echo
            "<tr>
                <th>".$collection[$x]['magyar_szo']."</th>
                <th>".$collection[$x]['idegen_szo']."</th>
                <th><button type='button'>Sor Frissítése</button></th>
                <th><button type='button'>Sor Törlése</button></th>
            </tr>";
          }
        echo"</table>";
    }
?>