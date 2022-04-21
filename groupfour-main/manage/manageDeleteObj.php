<?php
function userDeleteObj($objID){
    $db1 = new SQLite3('/xampp/Data/ActemiumDB.db'); 
    $sql1 = "DELETE FROM Objectives WHERE objID = $objID";
    $stmt1 = $db1->prepare($sql1);
    $stmt1->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
    $stmt1->execute();
}

?>