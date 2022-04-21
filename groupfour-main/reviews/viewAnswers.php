<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_once('deleteReview.php');
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
  $deleteReview = DeleteReviewFunc();
  header('Location: viewReviews.php?deleteReview='.$deleteReview); 
  exit();
}
?>

<?php
$dbA = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmtA = $dbA->prepare("SELECT A1, A2, A3, A4, A5, A6, 
A7, A8, QuestionID, A9 FROM ReviewsA WHERE AnswerID = :answers");
$stmtA->bindParam(':answers', $_GET['answersID'], SQLITE3_INTEGER);
$resultA = $stmtA->execute();
$rows_arrayA = [];
while ($rowA=$resultA->fetchArray())
{
    $rows_arrayA[]=$rowA;
};
$_SESSION['questID'] = $rows_arrayA[0][8];
$questionID = $_SESSION['questID'];
?>

<?php
$dbQ = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmtQ = $db->prepare("SELECT Q1, Q2, Q3, Q4, Q5, Q6, 
Q7, Q8 FROM Appraisals WHERE QuestionID = $questionID ");
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
            <?php for ($x = 0; $x < 8; $x+=1) {?>
                <tr style="border: solid 2px black">
                    <?php if($rows_arrayQ[0][$x] != null){ ?>
                    <td style="text-align: left;border: solid 2px black"><?php echo $rows_arrayQ[0][$x]." "?> </td>
                    <td style="text-align: left;"><?php echo $rows_arrayA[0][$x]." "?></td>
                  <?php } ?>
                  </tr>
            <?php } ?>
            <td style="text-align: left;"class="">Future Wishes / Training Requests </label> </td>
            <td style="text-align: left;border: solid 2px black"><?php echo $rows_arrayA[0][9]?></td>
            </table>
          </div>
          <button class="w-10 btn btn-lg btn-primary" style="margin-top:10px" type="submit" name="submit" value="Delete Appraisal">Delete </button>
        </form>
    </main>
  </div>
  

<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>