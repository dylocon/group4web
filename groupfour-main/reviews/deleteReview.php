<?php
function DeleteReviewFunc(){
    $db1 = new SQLite3('/xampp/Data/ActemiumDB.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
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
    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/ActemiumDB.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "SELECT ReviewID FROM ReviewsA wHERE AnswerID = :aID";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':aID', $_GET['answersID'], SQLITE3_INTEGER);
    $result1 = $stmt->execute();
    $rows_array = [];
    while ($row=$result1->fetchArray())
    {
        $rows_array[]=$row;
    }

    $reviewID = $rows_array[0][0];


    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/ActemiumDB.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "DELETE FROM ReviewsQ wHERE ReviewID = :rID";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':rID', $reviewID, SQLITE3_INTEGER);
    $stmt->execute();


    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/ActemiumDB.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "DELETE FROM ReviewsA wHERE AnswerID = :aID";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':aID', $_GET['answersID'], SQLITE3_INTEGER);
    $stmt->execute();

}
   ?> 


