<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_once('/xampp/htdocs/groupfour-main/user/userCreateObjectiveSQL.php');
$db = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmt = $db->prepare('SELECT Role FROM User WHERE UserName = :username ');
$stmt->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];
$qID = null;
$errorobjt = $errormile ='';
$allFields = "yes";
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
    include('UserNavBar.php');
}
?>

<?php

if (isset($_POST['submit'])) {
  if ($_POST['objTitle']==""){
    $errorobjt = "Objective Title is mandatory";
    $allFields = "no";
  }
  if ($_POST['milestone1']=="" && $_POST['milestone2']==""  && $_POST['milestone3']==""  && $_POST['milestone4']==""){
    $errormile = "At least one milestone is needed";
    $allFields = "no";
  }

  else{
    $createUserSQL = userCreateObjectiveSQL();
    header('Location: userCreateObjConfirmation.php?createObj='.$createUserSQL); 
    exit();
  }

}

$qID = $_SESSION['questionsID'];
?>


<?php
if ($qID != null){
  $dbAppraisal = new SQLite3('/xampp/Data/ActemiumDB.db');
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



  <?php
  $dbUser = new SQLite3('/xampp/Data/ActemiumDB.db');
  $stmtUser = $dbUser->prepare('SELECT ID, firstName, lastName, Role FROM User WHERE ID = :userID');
  $stmtUser->bindParam(':userID', $_SESSION['userID'], SQLITE3_INTEGER);
  $resultUser = $stmtUser->execute();
  $usersArray = [];
  $count = 0;
  while ($rowUser=$resultUser->fetchArray())
  {
      $usersArray[]=$rowUser;
      $count += 1;
  }

  ?>





  <div class="reviewCanvas col-md-6" style = "margin-bottom: 20px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
        <form method="post">
          <div style="text-align: center">
          </div>
          <div style="text-align: center">
              <div>
                <label for="floatingInput"style="font-size:20px;margin-right:10px"class="loginFont reviewLabel">Objective Title</label>

                <input maxlength="80" type="text" style="" placeholder="Title"class="inputFields reviewInput" id="objTitle" name="objTitle"></input>
                <span class="text-danger"><?php echo $errorobjt; ?></span>
              </div>
          </div>
    </main>
  </div>




  <div class="reviewCanvas col-md-6" style = "margin-bottom: 100px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
          <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
          <div style="text-align: center">
            <h1 style="color: #004C89">Milestones</h1>
          </div>
          <br>
          <div style="text-align: center">
          <!-- for loop to generate the 5 questions from the Questions table -->
          <!-- If an appraisal has been selected; -->
          <?php if ($qID != null){ ?>
            <?php for ($x = 0; $x <= 3; $x+=1) {?>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Milestone"." ".($x+1)?></label>
                <input maxlength="80" style="padding: 20px",type="text" , class="inputFields reviewInput" id="username" name=<?php echo "milestone".($x+1)?>></input>
                <br>
                <span class="text-danger"><?php echo $errormile; ?></span>
              </div>
            <?php } ?>
        <?php } ?>
        


<br>
            <button class="w-50 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="User Login">Create Objective</button>
          </div>
        </form>
    </main>
  </div>

<?php require('/xampp/htdocs/groupfour-main/Footer.php');?>