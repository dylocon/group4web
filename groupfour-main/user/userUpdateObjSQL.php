<?php
function userUpdateStatus($objID,$M1,$M2,$M3,$M4){
    $StatusI = "Incomplete";
    $StatusC = "Complete";
    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "UPDATE Objectives SET M1_Status = :M1, M2_Status=:M2, M3_Status=:M3, M4_Status=:M4, Status = :S WHERE objID = $objID";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':M1', $M1 , SQLITE3_TEXT);
    $stmt->bindParam(':M2', $M2  , SQLITE3_TEXT);
    $stmt->bindParam(':M3', $M3  , SQLITE3_TEXT);
    $stmt->bindParam(':M4', $M4  , SQLITE3_TEXT);

    if (($M1 == 'Incomplete') || ($M2 == 'Incomplete') || ($M3 == 'Incomplete') || ($M4 == 'Incomplete')){
        $stmt->bindParam(':S', $StatusI  , SQLITE3_TEXT);
    }
    elseif (($M1 == 'On-Track') || ($M2 == 'On-Track') || ($M3 == 'On-Track') || ($M4 == 'On-Track')){
        $stmt->bindParam(':S', $StatusI  , SQLITE3_TEXT);
    }
    else{
        $stmt->bindParam(':S', $StatusC  , SQLITE3_TEXT);
    }
    $stmt->execute();
}

function userCompleteStatus($objID){
    $Status = "Complete";
    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "UPDATE Objectives SET Status = :Status WHERE objID = $objID";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':Status', $Status , SQLITE3_TEXT);
    $stmt->execute();
}




?>