<?php 
// блок инициализации
try {
	$pdoSet = new PDO('mysql:host=localhost', 'root', '');
	$pdoSet->query('SET NAMES utf8;');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// код для "неубиваемой" базы данных
$sqlTM = "CREATE DATABASE IF NOT EXISTS bank_db;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "USE bank_db;";
$stmt = $pdoSet->query($sqlTM);

$sqlTM = "CREATE TABLE IF NOT EXISTS Brrowers (id int(11) NOT NULL auto_increment, text text NOT NULL, description text NOT NULL, keywords text NOT NULL, PRIMARY KEY (id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "CREATE TABLE IF NOT EXISTS files (id_file int(11) NOT NULL auto_increment, id_my int(11) NOT NULL, description text NOT NULL, name_origin text NOT NULL, path text NOT NULL, date_upload text NOT NULL, PRIMARY KEY (id_file), FOREIGN KEY (id_my) REFERENCES myarttable(id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
// конец кода для "неубиваемой" базы данных

if (isset($_POST['bt1'])) { // Изменение проверки на POST
    $taxId = $_POST["taxId"];
    $lastName = $_POST["entityType"];
    $addressName = $_POST["addressName"];
    $amount = $_POST["amount"];
    $conditions = $_POST["conditions"];
    $legalNotes = $_POST["legalNotes"];
    $contractsList = $_POST["contractsList"];

    try {
        $sqlTM = "INSERT INTO Brrowers (taxId, entityType, addressName, amount, conditions, legalNotes, contractsList) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdoSet->prepare($sqlTM);

        // Привязка параметров
        $stmt->bindParam(1, $taxId);
        $stmt->bindParam(2, $entityType);
        $stmt->bindParam(3, $addressName);
        $stmt->bindParam(4, $amount);
        $stmt->bindParam(5, $conditions);
        $stmt->bindParam(6, $legalNotes);
        $stmt->bindParam(7, $contractsList);

        
		$result = $stmt->execute(); 

		if ($result === false) { 
			$errorInfo = $stmt->errorInfo(); 
			echo "Ошибка базы данных: " . $errorInfo[2]; 
		} else {
			echo "Новая сущность успешно добавлена!";
		}
        
    } catch (PDOException $e) {
		if ($e->errorInfo[1] == 1062) { 
			echo "Ошибка: Эта запись уже существует.";
		} else {
			echo "Ошибка базы данных: " . $e->getMessage();
		}
	}
}




// начало вставки для UPDATE
if (isset($_POST['textId'])) {
    $textId = $_POST['textId'];
    $taxId = $_POST['taxId'];
    $entityType = $_POST['entityType'];
    $addressName = $_POST['addressName'];
    $amount = $_POST['amount'];
    $conditions = $_POST['conditions'];
    $legalNotes = $_POST['legalNotes'];
    $driverLicense = $_POST['contractsList'];

    $sqlTM = "UPDATE Brrowers SET taxId='$taxId', entityType='$entityType', addressName='$addressName', amount='$amount', conditions='$conditions', legalNotes='$legalNotes', contractsList='$contractsList' WHERE id = $textId";

    try {
        $stmt = $pdoSet->query($sqlTM);
        if (!$stmt) {
            throw new Exception($pdoSet->errorInfo()[2]);
        } else {
            echo "Сущность успешно обновлена";
        }
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
// конец вставки для UPDATE

// начало вставки для DELETE
if (isset($_GET['delid'])) {
	$sqlTM = "DELETE FROM files WHERE id_my = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
	$sqlTM = "DELETE FROM Brrowers WHERE id = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
}
// конец вставки для DELETE


	$sqlTM="SELECT * FROM Brrowers WHERE id>0 ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
//echo $sqlTM;
	$stmt = $pdoSet->query($sqlTM);
	$resultMF = $stmt->fetchAll();
	
//var_dump($resultMF);
?>
