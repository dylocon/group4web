<?php
function CreateReviewFunc(){
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


    $_SESSION['engineerID'] = $_POST['engineerID'];
    $revID = rand(1,100);
    $created = false;//this variable is used to indicate the creation is successful or not
    $db = new SQLite3('/xampp/Data/StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = "INSERT INTO ReviewsQ (ReviewID,AppraiseeID,AppraiserID,Question_1,Question_2,Question_3,Question_4,Question_5,Question_6,
    Question_7,Question_8,Question_9,Question_10,Question_11,Question_12) VALUES (:rID,:appraiseeID,:appraiserID,:q1,:q2,:q3,:q4,:q5,:q6,:q7,:q8,:q9,:q10,:q11,:q12)";
    $stmt = $db->prepare($sql); //prepare the sql statement
    $stmt->bindParam(':rID', $revID, SQLITE3_INTEGER);
    $stmt->bindParam(':appraiseeID', $_POST['engineerID'], SQLITE3_INTEGER);
    $stmt->bindParam(':appraiserID', $rows_array[0][0], SQLITE3_INTEGER);

    $questionArray = [$_POST['question1'],$_POST['question2'],$_POST['question3'], $_POST['question4'], $_POST['question5'], 
    $_POST['question6'], $_POST['question7'], $_POST['question8'], $_POST['question9'], $_POST['question10'], $_POST['question11'], $_POST['question12']];
    $valueArray = [':q1',':q2',':q3',':q4',':q5',':q6',':q7',':q8',':q9',':q10',':q11',':q12'];

    for($x = 0; $x <= 11; $x+=1){
        if ($questionArray[$x] != null){
            $stmt->bindParam($valueArray[$x], $questionArray[$x], SQLITE3_TEXT);
        }
        
    }
    $stmt->execute();

}
   ?> 


