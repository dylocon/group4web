<?php
function AnswerReviewFunc(){
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
    $_SESSION['userID'] = $rows_array[0][0];

    $userID = $_SESSION['userID'];
    $appraiserID = $_SESSION['appraiserID'];
    $revID = $_SESSION['reviewID'];
    $answerID = rand(1,100);
    $AVGSCORE = ($_POST['radio6'] + $_POST['radio7'] + $_POST['radio8']) / 3;
    $created = false;
    $db = new SQLite3('/xampp/Data/ActemiumDB.db'); 
    $sql = "INSERT INTO ReviewsA (AnswerID, ReviewID, AppraiseeID,QuestionID,A1,A2,A3,A4,A5,A6,
    A7,A8,A9,AVGSCORE) VALUES (:answerID,:rID,:appraiseeID,:qID,:a1,:a2,:a3,:a4,:a5,:a6,:a7,:a8,:a9,:AVGSCORE)";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(':answerID', $answerID, SQLITE3_INTEGER);
    $stmt->bindParam(':rID', $revID, SQLITE3_INTEGER);
    $stmt->bindParam(':appraiseeID', $userID, SQLITE3_INTEGER);
    $stmt->bindParam(':qID', $_SESSION['questionAnswerID'], SQLITE3_INTEGER);
    $stmt->bindParam(':a6', $_POST['radio6'], SQLITE3_INTEGER);
    $stmt->bindParam(':a7', $_POST['radio7'], SQLITE3_INTEGER);
    $stmt->bindParam(':a8', $_POST['radio8'], SQLITE3_INTEGER);
    $stmt->bindParam(':AVGSCORE', $AVGSCORE, SQLITE3_INTEGER);
    $questionArray = [$_POST['answer1'],$_POST['answer2'],$_POST['answer3'], $_POST['answer4'], $_POST['answer5'], 
    $_POST['answer6'], $_POST['answer7'], $_POST['answer8'], $_POST['answer9']];
    $valueArray = [':a1',':a2',':a3',':a4',':a5',':a6',':a7',':a8',':a9'];
    for($x = 0; $x <= 8; $x+=1){
        if ($questionArray[$x] != null){
            $stmt->bindParam($valueArray[$x], $questionArray[$x], SQLITE3_TEXT);
        }
        
    }
    $stmt->execute();
    $sql = "SELECT SumScore, ReviewAmount FROM User WHERE ID = :userID";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userID', $_SESSION['userID'], SQLITE3_INTEGER);
    $result = $stmt->execute();
    $rows_array = [];

    while ($row=$result->fetchArray())
    {
        $rows_array[]=$row;
    }

    $sumScore = $rows_array[0][0] + $AVGSCORE;
    $reviewAmount = $rows_array[0][1] + 1;

    $sql = "UPDATE User SET SumScore = :sumscore, ReviewAmount = :reviewAmount WHERE ID = :userID";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(':userID', $_SESSION['userID'], SQLITE3_INTEGER);
    $stmt->bindParam(':sumscore', $sumScore, SQLITE3_INTEGER);
    $stmt->bindParam(':reviewAmount', $reviewAmount, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $complete = "Complete";

    $sql = "UPDATE ReviewsQ SET Status = :complete WHERE AppraiseeID = :userID AND ReviewID = :revID";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(':userID', $_SESSION['userID'], SQLITE3_INTEGER);
    $stmt->bindParam(':revID', $revID, SQLITE3_INTEGER);
    $stmt->bindParam(':complete', $complete, SQLITE3_TEXT);

    $result = $stmt->execute();



}
   ?> 


