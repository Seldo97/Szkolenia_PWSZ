
<?php
    require 'vendor/autoload.php';
        //pobranie danych
	try {

        $main = new \Controllers\Main();

	} catch(PDOException $e) {
        echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
	}

?>
