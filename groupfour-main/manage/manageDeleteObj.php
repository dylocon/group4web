<?php
function userDeleteObj($objID){
    $db1 = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql1 = "DELETE FROM Objectives WHERE objID = $objID";
    $stmt1 = $db1->prepare($sql1);
    $stmt1->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
    $stmt1->execute();
}

?>