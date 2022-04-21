<?php
function appraiseUserSQL(){
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

    $Status = "Incomplete";
    $monthDue = date("m") + 3;
    $date = date("d.m.y");   
    $dateDue = date("d.".sprintf("%02d",$monthDue).".y");   
    $created = false;
    $db = new SQLite3('/xampp/Data/ActemiumDB.db'); 
    $sql = "INSERT INTO ReviewsQ (ReviewID, QuestionID, AppraiseeID,Appraisal_Name,Engineer_Name,AppraiserID,Status,Date,DateDue) VALUES (:rID,:qID,:appraiseeID,:appraisalName,:engineerName,:appraiserID,:Status,:date,:dateDue)";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(':rID', rand(1,100), SQLITE3_INTEGER);
    $stmt->bindParam(':qID', $_SESSION['questionsID'], SQLITE3_INTEGER);
    $stmt->bindParam(':appraiseeID', $_SESSION['userID'], SQLITE3_TEXT);
    $stmt->bindParam(':appraisalName', $_SESSION['appraisalName'], SQLITE3_TEXT);
    $stmt->bindParam(':engineerName', $_SESSION['appraiseeName'], SQLITE3_TEXT);
    $stmt->bindParam(':appraiserID', $rows_array[0][0], SQLITE3_TEXT);
    $stmt->bindParam(':Status', $Status, SQLITE3_TEXT);
    $stmt->bindParam(':date', $date, SQLITE3_TEXT);
    $stmt->bindParam(':dateDue', $dateDue, SQLITE3_TEXT);
    $stmt->execute();
}
   ?> 


