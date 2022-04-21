<?php
function CreateAnAccountFunc(){
    $created = false;
    $db = new SQLite3('/xampp/Data/ActemiumDB.db'); 
    $sql = "INSERT INTO User (ID,UserName, firstName,lastName,Password,Role,Type) VALUES (:id, :username, :firstname, :lastname, :password, :role,:type)";
    $stmt = $db->prepare($sql); 


    $idNumber = rand(000,100);
    $lastname = substr($_POST['surname'], 0, 2);
    $firstname = substr($_POST['firstname'], 0, 2);
    $randomNumber = rand(10000, 99999);
    $uname = $firstname.$lastname.$randomNumber;
    session_start();
    $_SESSION['navID'] = $idNumber;
    $_SESSION['regUsername'] = $uname;
    $stmt->bindParam(':id', $idNumber, SQLITE3_INTEGER); 
    $stmt->bindParam(':username', $uname, SQLITE3_TEXT); 
    $stmt->bindParam(':firstname', $_POST['firstname'], SQLITE3_TEXT); 
    $stmt->bindParam(':lastname', $_POST['surname'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
    $stmt->bindParam(':role', $_POST['role'], SQLITE3_TEXT);
    $stmt->bindParam(':type', $_POST['type'], SQLITE3_TEXT);

    $stmt->execute();
}
   ?>
   
   

<?php include("Footer.php"); ?>


