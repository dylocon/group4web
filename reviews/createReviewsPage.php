<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_ONCE("createReviewSQL.php");
$db = new SQLite3('/xampp/Data/StudentModule.db');
$stmt = $db->prepare('SELECT Role FROM User WHERE UserName = :username ');
$stmt->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];
$qID = null;
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
    include('NavBar.php');
}

if (isset($_POST['submit'])) {
  $createReview = CreateReviewFunc();
  header('Location: createReviewConfirmation.php?createUser='.$createReview); 
  exit();
}

if (isset($_POST['update'])) {
  $_SESSION['questionsID'] = $_POST['appraisalBox'];
  header('Location: createReviewsPage.php'); 
}
else{

}
?>




<!-- SQL to iterate through the Questions table to display the questions. -->
<?php


$qID = $_SESSION['questionsID'];
echo $qID;
if ($qID != null){
  $dbAppraisal = new SQLite3('/xampp/Data/StudentModule.db');
  $stmtAppraisal = $dbAppraisal->prepare('SELECT Q1,Q2,Q3,Q4,Q5,Name FROM Appraisals WHERE QuestionID = :questionID');
  $stmtAppraisal->bindParam(':questionID', $qID, SQLITE3_TEXT);
  $result1 = $stmtAppraisal->execute();
  $rows_array1 = [];
  while ($row1=$result1->fetchArray())
  {
      $rows_array1[]=$row1;
  }
  $Q1 = $rows_array1[0][0];
  $Q2 = $rows_array1[0][1];
  $Q3 = $rows_array1[0][2];
  $Q4 = $rows_array1[0][3];
  $Q5 = $rows_array1[0][4];
  $questionsArray = [$Q1,$Q2,$Q3,$Q4,$Q5];
}
else{
  $Q1 = "";
  $Q2 = "";
  $Q3 = "";
  $Q4 = "";
  $Q5 = "";
  $questionsArray = [$Q1,$Q2,$Q3,$Q4,$Q5];
}
// Variables to assign each input with the questions.
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
<div style = "">

<div class="reviewCanvas col-md-6" style = "margin-bottom: 20px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
        <form method="post">
          <div style="text-align: center">
          </div>
          <div style="text-align: center">
              <div>
                <label for="floatingInput"style="font-size:20px"class="loginFont reviewLabel">Select the Appraisal</label>
                <!-- <input type="text" placeholder="Appraisee ID"class="inputFields reviewInput" id="engineerID" name="engineerID"> -->
                <select class="inputFields reviewInput" name="appraisalBox" id="appraisalBox">
                  <option selected="true" value="1">Aerospace Eng. Appraisal</option>
                  <option <?php if ($_SESSION['questionsID'] == '2') { ?>selected="true" <?php } ?>value="2">Civil Eng. Appraisal</option>
                  <option <?php if ($_SESSION['questionsID'] == '3') { ?>selected="true" <?php } ?>value="3">Mechanical Eng. Appraisal</option>
                </select>
                <button class="w-10 btn btn-lg btn-primary" style="align: center" type="submit" name="update" value="User Login">Update</button>
              </div>
          </div>
    </main>
  </div>

  <div class="reviewCanvas col-md-6" style = "margin-bottom: 100px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
          <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
          <div style="text-align: center">
            <h1 style="color: #004C89">Create Reviews</h1>
          </div>
          <div style="text-align: center">
          <!-- for loop to generate the 5 questions from the Questions table -->
          <!-- If an appraisal has been selected; -->
          <?php if ($qID != null){ ?>
            <?php for ($x = 0; $x <= 4; $x+=1) {?>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question"." ".($x+1)?></label>
                <input type="text", value = "<?php echo "$questionsArray[$x]" ?>" , class="inputFields reviewInput" id="username" name=<?php echo "question".($x+1)?>>
              </div>
            <?php } ?>
            <!-- If an appraisal has not been selected; -->
            <?php }else { ?>
              <?php for ($x = 0; $x <= 4; $x+=1) {?>
                <div>
                  <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question"." ".($x+1)?></label>
                  <input type="text", value = "" , class="inputFields reviewInput" id="username" name=<?php echo "question".($x+1)?> readonly>
                </div>
              <?php } ?>
            <?php } ?>
            

            <!-- These three questions can't be changed, and will be used to create the bar chart; performance based questions to create value -->
            <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question 6"?></label>
                <input type="text" value="Question ..."class="inputFields reviewInput" id="username" name=<?php echo "question6"?> readonly>
                <span> 
              </div>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question 7"?></label>
                <input type="text" value="Question ..."class="inputFields reviewInput" id="username" name=<?php echo "question7"?> readonly>
                <span> 
              </div>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question 8"?></label>
                <input type="text" value="Question ..."class="inputFields reviewInput" id="username" name=<?php echo "question8"?> readonly>
                <span> 
              </div>



            <button class="w-50 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="User Login">Publish the Review</button>
          </div>
        </form>
    </main>
  </div>
</div>





















<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>