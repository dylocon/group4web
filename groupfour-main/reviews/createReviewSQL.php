<?php
function CreateReviewFunc(){
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
    $sql = "UPDATE Appraisals SET Q1 = :q1, Q2 = :q2, Q3 = :q3, Q4 = :q4, Q5 = :q5, Q6 = :q6, Q7 = :q7, Q8 = :q8 WHERE QuestionID = :qID";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':qID', $_SESSION['questionsID'], SQLITE3_INTEGER);
    $stmt->bindParam(':q1', $_POST['question1'], SQLITE3_TEXT);
    $stmt->bindParam(':q2', $_POST['question2'], SQLITE3_TEXT);
    $stmt->bindParam(':q3', $_POST['question3'], SQLITE3_TEXT);
    $stmt->bindParam(':q4', $_POST['question4'], SQLITE3_TEXT);
    $stmt->bindParam(':q5', $_POST['question5'], SQLITE3_TEXT);
    $stmt->bindParam(':q6', $_POST['question6'], SQLITE3_TEXT);
    $stmt->bindParam(':q7', $_POST['question7'], SQLITE3_TEXT);
    $stmt->bindParam(':q8', $_POST['question8'], SQLITE3_TEXT);
    $stmt->execute();

}
   ?> 


