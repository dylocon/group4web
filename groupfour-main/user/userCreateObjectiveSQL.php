<?php

function userCreateObjectiveSQL(){
    $db1 = new SQLite3('/xampp/Data/ActemiumDB.db'); 
    $sql1 = "SELECT ID FROM User WHERE UserName = :username";
    $stmt1 = $db1->prepare($sql1);
    $stmt1->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
    $stmt1->execute();
    $result1 = $stmt1->execute();
    $rows_array = [];
    while ($row=$result1->fetchArray())
    {
        $rows_array[]=$row;
    }

    $objID = rand(1,100);
    $Status = "Incomplete" ;
    $Assigned = "Engineer" ;
    $created = false;
    $db = new SQLite3('/xampp/Data/ActemiumDB.db');
    $sql = "INSERT INTO Objectives(objID,userID,objName,M1,M1_Status,M2,M2_Status,M3,M3_Status,M4,M4_Status,Status,Assigned) VALUES (:objID,:userID,:objName,:M1,:M1S,:M2,:M2S,:M3,:M3S,:M4,:M4S,:Status,:assigned)";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(':objID', $objID , SQLITE3_INTEGER);
    $stmt->bindParam(':userID', $rows_array[0][0], SQLITE3_INTEGER);
    $stmt->bindParam(':objName', $_POST['objTitle'], SQLITE3_TEXT);
    $stmt->bindParam(':M1', $_POST['milestone1'], SQLITE3_TEXT);
    $stmt->bindParam(':M2', $_POST['milestone2'], SQLITE3_TEXT);
    $stmt->bindParam(':M3', $_POST['milestone3'], SQLITE3_TEXT);
    $stmt->bindParam(':M4', $_POST['milestone4'], SQLITE3_TEXT);
    $stmt->bindParam(':M1S', $Status, SQLITE3_TEXT);
    $stmt->bindParam(':M2S', $Status, SQLITE3_TEXT);
    $stmt->bindParam(':M3S', $Status, SQLITE3_TEXT);
    $stmt->bindParam(':M4S', $Status, SQLITE3_TEXT);
    
    $stmt->bindParam(':Status', $Status, SQLITE3_TEXT);
    $stmt->bindParam(':assigned', $Assigned, SQLITE3_TEXT);

    $stmt->execute();
}




?>