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

    $sql = "SELECT * FROM customer;";
    $data = mysqli_query ($link, $sql) or die();
  ?>
  <body>
    <table>
      <thead>
        <tr>
          <th><a style='color: white;' href='edit.php'>NEU</a></th>
          <th>Nachname</th>
          <th>Vorname</th>
          <th>Anschrift</th>
          <th>PLZ</th>
          <th>Ort</th>
          <th>Telefon</th>
        </tr>
      </thead>
      <tbody>
        <?php
          echo "<!-- PHP Data -->\n";
          $DatasetCounter = 0;
          while( $dataset = mysqli_fetch_array($data, MYSQLI_ASSOC) ) {
            echo "        <tr>\n";
              echo "          <td style='text-align: right;'><a href='edit.php?id=" . $dataset["ID"] . "'>" . $dataset["ID"] . "</a></td>\n";
              echo "          <td>" . $dataset["Surname"] . "</td>\n";
              echo "          <td>" . $dataset["GivenName"] . "</td>\n";
              echo "          <td>" . $dataset["Address"] . "</td>\n";
              echo "          <td>" . $dataset["PostalCode"] . "</td>\n";
              echo "          <td>" . $dataset["City"] . "</td>\n";
              echo "          <td>" . $dataset["Phone"] . "</td>\n";
            echo "        </tr>\n";
            $DatasetCounter++;
          }
        ?>
      </tbody>
    </table>
  </body>
  <?php
    echo "<!-- PHP Destruct>\n";
    mysqli_close($link);
  ?>
</html>