<?php
function AnswerReviewFunc(){
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

    $userID = $_SESSION['userID'];
    $appraiserID = $_SESSION['appraiserID'];
    $revID = $_SESSION['reviewID'];
    $answerID = rand(1,100);
    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "INSERT INTO ReviewsA (AnswerID, ReviewID, AppraiseeID,AppraiserID,A1,A2,A3,A4,A5,A6,
    A7,A8,A9,A10,A11,A12) VALUES (:answerID,:rID,:appraiseeID,:appraiserID,:a1,:a2,:a3,:a4,:a5,:a6,:a7,:a8,:a9,:a10,:a11,:a12)";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':answerID', $answerID, SQLITE3_INTEGER);
    $stmt->bindParam(':rID', $revID, SQLITE3_INTEGER);
    $stmt->bindParam(':appraiseeID', $userID, SQLITE3_INTEGER);
    $stmt->bindParam(':appraiserID', $appraiserID, SQLITE3_INTEGER);

    $questionArray = [$_POST['answer1'],$_POST['answer2'],$_POST['answer3'], $_POST['answer4'], $_POST['answer5'], 
    $_POST['answer6'], $_POST['answer7'], $_POST['answer8'], $_POST['answer9'], $_POST['answer10'], $_POST['answer11'], $_POST['answer12']];
    $valueArray = [':a1',':a2',':a3',':a4',':a5',':a6',':a7',':a8',':a9',':a10',':a11',':a12'];

    for($x = 0; $x <= 11; $x+=1){
        if ($questionArray[$x] != null){
            $stmt->bindParam($valueArray[$x], $questionArray[$x], SQLITE3_TEXT);
        }
        
    }
    $stmt->execute();

}
   ?> 


