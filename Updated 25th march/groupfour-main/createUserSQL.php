<?php
function CreateAnAccountFunc(){
    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "INSERT INTO User (ID,UserName, firstName,lastName,Password,Role) VALUES (:id, :username, :firstname, :lastname, :password, :role)";
    $stmt = $db->prepare($sql); //prepare the sql statement
    //give the values for the parameters
     //we use SQLITE3_TEXT for text/varchar. You can use SQLITE3_INTEGER or SQLITE3_REAL for numerical values

    $idNumber = rand(000,100);
    $lastname = substr($_POST['surname'], 0, 2);
    $firstname = substr($_POST['firstname'], 0, 2);
    $randomNumber = rand(10000, 99999);
    $uname = $firstname.$lastname.$randomNumber;

    $stmt->bindParam(':id', $idNumber, SQLITE3_INTEGER); 
    $stmt->bindParam(':username', $uname, SQLITE3_TEXT); 
    $stmt->bindParam(':firstname', $_POST['firstname'], SQLITE3_TEXT); 
    $stmt->bindParam(':lastname', $_POST['surname'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
    $stmt->bindParam(':role', $_POST['role'], SQLITE3_TEXT);

    $stmt->execute();
}
   ?>
   
   

<?php include("Footer.php"); ?>


