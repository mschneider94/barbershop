<!DOCTYPE html>
<html>
  <head>
    <title>Kundenkartei</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <?php
    echo "<!-- PHP Construct -->\n";

    include("connect.inc.php");

    $id = null;
    $Surname = null;
    $GivenName = null;
    $Address = null;
    $PostalCode = null;
    $City = null;
    $Phone = null;
    $Birthday = null;
    $Haircut = null;
    $Color = null;
    $Perm = null;
    $Miscellaneous = null;

    if ($_POST) {
      if (isset($_POST["id"])) {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
      }
      if (isset($_POST["Surname"])) {
        $Surname = mysqli_real_escape_string($link, $_POST["Surname"]);
      }
      if (isset($_POST["GivenName"])) {
        $GivenName = mysqli_real_escape_string($link, $_POST["GivenName"]);
      }
      if (isset($_POST["Address"])) {
        $Address = mysqli_real_escape_string($link, $_POST["Address"]);
      }
      if (isset($_POST["PostalCode"])) {
        $PostalCode = mysqli_real_escape_string($link, $_POST["PostalCode"]);
      }
      if (isset($_POST["City"])) {
        $City = mysqli_real_escape_string($link, $_POST["City"]);
      }
      if (isset($_POST["Phone"])) {
        $Phone = mysqli_real_escape_string($link, $_POST["Phone"]);
      }
      if (isset($_POST["Birthday"])) {
        $Birthday = mysqli_real_escape_string($link, $_POST["Birthday"]);
      }
      if (isset($_POST["Haircut"])) {
        $Haircut = mysqli_real_escape_string($link, $_POST["Haircut"]);
      }
      if (isset($_POST["Color"])) {
        $Color = mysqli_real_escape_string($link, $_POST["Color"]);
      }
      if (isset($_POST["Perm"])) {
        $Perm = mysqli_real_escape_string($link, $_POST["Perm"]);
      }
      if (isset($_POST["Miscellaneous"])) {
        $Miscellaneous = mysqli_real_escape_string($link, $_POST["Miscellaneous"]);
      }

      if ($id) {
        // UPDATE
        $sql = "UPDATE customer SET Surname = '" . $Surname . "', GivenName = '" . $GivenName . "', Address = '" . $Address . "', PostalCode = '" . $PostalCode . "', City = '" . $City . "', Phone = '" . $Phone . "', Birthday = '" . $Birthday . "', Haircut = '" . $Haircut . "', Color = '" . $Color . "', Perm = '" . $Perm . "', Miscellaneous = '" . $Miscellaneous . "'";
        $sql = $sql . "WHERE ID = " . $id . ";";

        // Preventing ReInsertion (may be caused by Page-Reload)
        // (Create a hash of the SQL-Statement, save it as a session cookie, and compare hashes every session)
        $sql_hash = md5($sql);
        if (session_start()) {
          $ReInsert = isset($_SESSION['sql_hash']) && $_SESSION['sql_hash'] == $sql_hash;
          $_SESSION[ 'sql_hash' ] = $sql_hash;
          session_write_close();
        } else {
          $ReInsert = false;
        }

        if (!$ReInsert) {
          $data = mysqli_query ($link, $sql) or die();
          
          $data = mysqli_query ($link, "SELECT LAST_INSERT_ID() AS 'ID';") or die();
        }
      } else {
        // INSERT
        $sql = "INSERT INTO customer (Surname, GivenName, Address, PostalCode, City, Phone, Birthday, Haircut, Color, Perm, Miscellaneous) ";
        $sql = $sql . "Values ('" . $Surname . "', '" . $GivenName . "', '" . $Address . "', '" . $PostalCode . "', '" . $City . "', '" . $Phone . "', '" . $Birthday . "', '" . $Haircut . "', '" . $Color . "', '" . $Perm . "', '" . $Miscellaneous . "');";

        // Preventing ReInsertion (may be caused by Page-Reload)
        // (Create a hash of the SQL-Statement, save it as a session cookie, and compare hashes every session)
        $sql_hash = md5($sql);
        if (session_start()) {
          $ReInsert = isset($_SESSION['sql_hash']) && $_SESSION['sql_hash'] == $sql_hash;
          $_SESSION[ 'sql_hash' ] = $sql_hash;
          session_write_close();
        } else {
          $ReInsert = false;
        }

        if (!$ReInsert) {
          $data = mysqli_query ($link, $sql) or die();
          
          $data = mysqli_query ($link, "SELECT LAST_INSERT_ID() AS 'ID';") or die();

          $id = mysqli_fetch_array($data, MYSQLI_ASSOC)["ID"];
        } else {
          die();
        }
      }
    } else if (isset($_GET["id"])) {
      $id = $_GET["id"];
    }

    if ($id) {
      $sql = "SELECT * FROM customer WHERE id = " . $id . ";";
      $data = mysqli_query ($link, $sql) or die();

      $dataset = mysqli_fetch_array($data, MYSQLI_ASSOC);

      $Surname = $dataset["Surname"];
      $GivenName = $dataset["GivenName"];
      $Address = $dataset["Address"];
      $PostalCode = $dataset["PostalCode"];
      $City = $dataset["City"];
      $Phone = $dataset["Phone"];
      $Birthday = $dataset["Birthday"];
      $Haircut = $dataset["Haircut"];
      $Color = $dataset["Color"];
      $Perm = $dataset["Perm"];
      $Miscellaneous = $dataset["Miscellaneous"];
    }
  ?>
  <body>
    <form method='post'>
      <div class='row'>
        <div class='column'>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>ID:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: ID -->\n";
                if ($id) {
                  echo "                " . $id . "\n";
                  echo "                <input type='hidden' name='id' value='" . $id . "'>\n";
                } else {
                  echo "                NEU\n";
                }
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Nachname:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Surname -->\n";
                echo "                <input type='text' style='width: 100%; background-color: lightskyblue;' name='Surname' value='" . $Surname . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Vorname:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: GivenName -->\n";
                echo "                <input type='text' style='width: 100%; background-color: lightskyblue;' name='GivenName' value='" . $GivenName . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Anschrift:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Address -->\n";
                echo "                <input type='text' style='width: 100%; background-color: lightskyblue;' name='Address' value='" . $Address . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>PLZ:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: PostalCode -->\n";
                echo "                <input type='text' style='width: 100%; background-color: lightskyblue;' name='PostalCode' value='" . $PostalCode . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Ort:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: City -->\n";
                echo "                <input type='text' style='width: 100%; background-color: lightskyblue;' name='City' value='" . $City . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Telefon:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Phone -->\n";
                echo "                <input type='text' style='width: 100%; background-color: lightskyblue;' name='Phone' value='" . $Phone . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Geburtstag:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Birthday -->\n";
                echo "                <input type='date' name='Birthday' value='" . $Birthday . "'>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Haarschnitt:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Haircut -->\n";
                echo "                <textarea rows='20' style='width: 100%; background-color: plum;' name='Haircut'>" . $Haircut . "</textarea>\n";
              ?>
            </div>
          </div>
        </div>
        <div class='column'>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Farbe:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Color -->\n";
                echo "                <textarea rows='15' style='width: 100%; background-color: lightgreen;' name='Color'>" . $Color . "</textarea>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>Dauerwelle:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Perm -->\n";
                echo "                <textarea rows='8' style='width: 100%; background-color: lightsalmon;' name='Perm'>" . $Perm . "</textarea>\n";
              ?>
            </div>
          </div>
          <div class='mask-wrapper clearfix'>
            <div class='mask-key'>sonstiges:&nbsp;</div>
            <div class='mask-value'>
              <?php
                echo "<!-- PHP Mask: Miscellaneous -->\n";
                echo "                <textarea rows='8' style='width: 100%; background-color: lightcoral;' name='Miscellaneous'>" . $Miscellaneous . "</textarea>\n";
              ?>
            </div>
          </div>
        </div>
      </div>
      <p>
        <a href='index.php'>Zurück zur Kartei</a> oder &nbsp;<input type='submit' value='Eintrag speichern'>
      </p>
    </form>
  </body>
  <?php
    echo "<!-- PHP Destruct>\n";
    mysqli_close($link);
  ?>
</html>