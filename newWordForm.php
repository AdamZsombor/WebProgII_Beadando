<?php
        include_once("loginhelper.php");
        $logged_in = getLoggedInUser();
        if($logged_in == null)
        {
          // hibaüzenet sikertelen hozzáférésre
          echo "Nincs jogosultságod megtekinteni ezt az oldalt. <a href='login.php'>Vissza a belépéshez</a>";
          die();
        }
        $logged_in_user_id = $logged_in["ID"];
?>

<form   action=""
        method="POST">
    <input  name="Magyar" value="<?=$magyarszo?>"
            type="text" required placeholder="Magyar szó"><br>
    <input  name="Idegen" value="<?=$idegenszo?>"
            type="text" required placeholder="Idegen szó"><br>
            <label for="nyelvek">Válassz egy nyelvet:</label>

        <?php
        echo "<select id='nyelvlista' name='nyelvlista'>";
        $nyelvek = get_record_list("SELECT ID, idegen_nyelv_neve FROM szotar WHERE userID = $logged_in_user_id");
        for($i = 0; $i < count($nyelvek); $i ++)
        {
                $nyelvId = $nyelvek[$i]["ID"];
                $nyelvNev = $nyelvek[$i]["idegen_nyelv_neve"];
                echo "<option value='$nyelvId'>$nyelvNev</option>";
        }
        echo "</select>";
        ?>
    <button type="submit">Sor hozzáadása</button>
</form>