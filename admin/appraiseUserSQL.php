<?php
function appraiseUserSQL(){
    $db1 = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
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
    $db = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "INSERT INTO ReviewsQ (ReviewID, QuestionID, AppraiseeID,Appraisal_Name,Engineer_Name) VALUES (:rID,:qID,:appraiseeID,:appraisalName,:engineerName)";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':rID', rand(1,100), SQLITE3_INTEGER);
    $stmt->bindParam(':qID', $_SESSION['questionsID'], SQLITE3_INTEGER);
    $stmt->bindParam(':appraiseeID', $_SESSION['userID'], SQLITE3_TEXT);
    $stmt->bindParam(':appraisalName', $_SESSION['appraisalName'], SQLITE3_TEXT);
    $stmt->bindParam(':engineerName', $_SESSION['appraiseeName'], SQLITE3_TEXT);
    $stmt->execute();
}
   ?> 


