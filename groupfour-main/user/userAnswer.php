<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_ONCE("UserAnswerSQL.php");
$db = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmt = $db->prepare('SELECT Role FROM User WHERE UserName = :username ');
$stmt->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];



while ($row=$result->fetchArray())
{
    $rows_array[]=$row;
}
if($rows_array[0][0] == "Admin")
{
    include('/xampp/htdocs/groupfour-main/admin/AdminNavBar.php');
}
else if($rows_array[0][0] == "Manager"){
    include('/xampp/htdocs/groupfour-main/manager/ManagerNavBar.php');
}
else{
    include('/xampp/htdocs/groupfour-main/user/UserNavBar.php');
}

if (isset($_POST['submit'])) {
  $answerReview = AnswerReviewFunc();
  header('Location: userAnswerConfirmation.php?createUser='.$answerReview); 
  exit();
}


?>


<?php
$dbID = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmtID = $dbID->prepare("SELECT QuestionID FROM ReviewsQ WHERE ReviewID = :revID ");
$stmtID->bindParam(':revID', $_GET['revieID'], SQLITE3_TEXT);
$resultID = $stmtID->execute();
$rows_arrayID = [];
while ($rowID=$resultID->fetchArray())
{
    $rows_arrayID[]=$rowID;
}


$_SESSION['questionAnswerID'] = $rows_arrayID[0][0];
$reviewID = $_SESSION['reviewID'];
$userID = $_SESSION['userID'];
$dbQ = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmtQ = $db->prepare("SELECT Q1, Q2, Q3, Q4, Q5, Q6, 
Q7, Q8 FROM Appraisals WHERE QuestionID = :qID ");
$stmtQ->bindParam(':qID', $rows_arrayID[0][0], SQLITE3_TEXT);
$resultQ = $stmtQ->execute();
$rows_arrayQ = [];
while ($rowQ=$resultQ->fetchArray())
{
    $rows_arrayQ[]=$rowQ;
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/groupfour-main/site.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <form method="post">
  <div class="reviewCanvas col-md-6" style = "margin-bottom: 100px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
          <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
          <div style="text-align: center">
            <h1 style="color: #004C89">Answer Reviews Page</h1>
          </div>
          <div style="text-align: center">
          <table style="width: 100%;text-align: center ;border: solid 2px black;">
          <tr style="">
          <th>Questions</th>
          <th>Answers</th>
          </tr>
            <?php for ($x = 1; $x < 9; $x+=1) {?>
                <tr style="border: solid 2px black">
                  <?php if($rows_arrayQ[0][($x-1)] != null){ ?>
                    <?php if($x < 6){?>
                    <td> <label for="floatingInput"class="questionsFont reviewLabel"><?php echo $rows_arrayQ[0][($x-1)]." "?></label> </td>
                    <td style="width:70% "> <textarea maxlength="150"rows="4" cols="50"  placeholder="Answer ..."class="inputFields reviewInput" id="answer" name=<?php echo "answer".$x?>></textarea> </td>
                    <?php } else {?>
                      <td> <label for="floatingInput"class="questionsFont reviewLabel"><?php echo $rows_arrayQ[0][($x-1)]." "?></label> </td>
                      <td style="width:50%; "> 
                        <input style = "margin: 25px" name = <?php echo "radio".$x?> type="radio" value="1">1</input>
                        <input style = "margin: 25px" name = <?php echo "radio".$x?> type="radio" value="2">2</input>
                        <input style = "margin: 25px" name = <?php echo "radio".$x?> type="radio" value="3">3</input>
                        <input style = "margin: 25px" name = <?php echo "radio".$x?> type="radio" value="4">4</input>
                        <input style = "margin: 25px" name = <?php echo "radio".$x?> type="radio" value="5">5</input>
                      </td>
                    <?php } ?>
                  <?php } ?>
                  </tr>
            <?php } ?>
            <td> <label for="floatingInput"class="questionsFont reviewLabel">Future Wishes / Training Requests </label> </td>
              <td style="width:70% "> <textarea maxlength="150"rows="4" cols="50"  placeholder="Answer ..."class="inputFields reviewInput" id="answer" name=<?php echo "answer".$x?>></textarea> </td>
            </table>
            <button class="w-50 btn btn-lg btn-primary" style="align: center;margin-top:20px" type="submit" name="submit" value="User Login">Publish the Review</button>
          </div>
        </form>
    </main>
  </div>

<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>