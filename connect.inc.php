<?PHP
/*
     Allgemeine Daten fuer die Datenbankanbindung
     und direkter Connect zur Datenbank. Nach
     Einbindung dieses Segments kann direkt mit
     MySQL-Befehlen auf die Datenbank zugegriffen
     werden.
*/

/* Datenbankserver - In der Regel die IP */
$db_server = 'localhost';

/* Datenbankname */
$db_name = 'barbershop';

/* Datenbankuser */
$db_user = 'barbershop';

/* Datenbankpasswort */
$db_password = 'barbershop';
         
/* Stellt Connect zu Datenbank her */
$link = mysqli_connect($db_server, $db_user, $db_password, $db_name);

// Prüfe Link zur Datenbank
if (!$link) {
    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else
{
	mysqli_query($link, "SET NAMES 'utf8'") or die();
}
?>