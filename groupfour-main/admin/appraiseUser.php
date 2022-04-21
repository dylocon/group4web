<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_once('/xampp/htdocs/groupfour-main/admin/appraiseUserSQL.php');
$db = new SQLite3('/xampp/Data/ActemiumDB.db');
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
    include('UserNavBar.php');
}
?>

<?php

if (isset($_POST['submit'])) {
  $appraiseUserSQL = appraiseUserSQL();
  header('Location: appraiseUserConfirmation.php?appraiseUser='.$appraiseUserSQL); 
  exit();
}
if (isset($_POST['update'])) {
  $_SESSION['questionsID'] = $_POST['appraisalBox'];
  header("Location: appraiseUser.php?userID=".$_GET['userID']); 
  exit();
}

$qID = $_SESSION['questionsID'];
$_SESSION['userID'] = $_GET['userID'];
?>


<?php
if ($qID != null){
  $dbAppraisal = new SQLite3('/xampp/Data/ActemiumDB.db');
  $stmtAppraisal = $dbAppraisal->prepare('SELECT Q1,Q2,Q3,Q4,Q5,Name,Q6,Q7,Q8 FROM Appraisals WHERE QuestionID = :questionID');
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
  $Q6 = $rows_array1[0][6];
  $Q7 = $rows_array1[0][7];
  $Q8 = $rows_array1[0][8];
  $questionsArray = [$Q1,$Q2,$Q3,$Q4,$Q5,$Q6,$Q7,$Q8];
}
// Variables to assign each input with the questions.
?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/groupfour-main/site.css" />
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>



  <?php
  $dbUser = new SQLite3('/xampp/Data/ActemiumDB.db');
  $stmtUser = $dbUser->prepare('SELECT ID, firstName, lastName, Role, Type FROM User WHERE ID = :userID');
  $stmtUser->bindParam(':userID', $_SESSION['userID'], SQLITE3_INTEGER);
  $resultUser = $stmtUser->execute();
  $usersArray = [];
  $count = 0;
  while ($rowUser=$resultUser->fetchArray())
  {
      $usersArray[]=$rowUser;
      $count += 1;
  }

  $_SESSION['appraiseeName'] = $usersArray[0][1];
  $_SESSION['appraisalName'] = $rows_array1[0][5];
  ?>





  <div class="reviewCanvas col-md-6" style = "margin-bottom: 20px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
        <form method="post">
          <div style="text-align: center">
          </div>
          <div style="text-align: center">
              <div>
                <label for="floatingInput"style="font-size:20px"class="loginFont reviewLabel">Select the Appraisal</label>
                <select class="inputFields reviewInput" name="appraisalBox" id="appraisalBox">
                  <option <?php if ($_SESSION['questionsID'] == '1') { ?>selected="true" <?php } ?>value="1">Aerospace Eng. Appraisal</option>
                  <option <?php if ($_SESSION['questionsID'] == '2') { ?>selected="true" <?php } ?>value="2">Civil Eng. Appraisal</option>
                  <option <?php if ($_SESSION['questionsID'] == '3') { ?>selected="true" <?php } ?>value="3">Mechanical Eng. Appraisal</option>
                </select>
                <button class="w-10 btn btn-lg btn-primary" style="align: center" type="submit" name="update" value="User Login">Update</button>
              </div>
          </div>
          <div style="text-align: center">
          <table style="width: 100%;text-align: center ;border: solid 2px black;">
          <tr style="">
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Type</th>
          </tr>
          <?php for ($x = 0; $x < $count; $x+=1) {?>
                <tr style="border: solid 2px black" class = "questionsFont">
                    <td><?php echo $usersArray[0][0]." "?> </td>
                    <td><?php echo $usersArray[0][1]." "?></td>
                    <td><?php echo $usersArray[0][2]." "?></td>
                    <td><?php echo $usersArray[0][3]." "?></td>
                    <td><?php echo $usersArray[0][4]." "?></td>
                </tr>
          <?php } ?>
            </table>
</div>
    </main>
  </div>




  <div class="reviewCanvas col-md-6" style = "margin-bottom: 100px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
          <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
          <div style="text-align: center">
            <h1 style="color: #004C89"><?php echo $rows_array1[0][5]?></h1>
          </div>
          <br>
          <div style="text-align: center">
          <!-- for loop to generate the 5 questions from the Questions table -->
          <!-- If an appraisal has been selected; -->
          <?php if ($qID != null){ ?>
            <?php for ($x = 0; $x <= 4; $x+=1) {?>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question"." ".($x+1)?></label>
                <input style="padding: 20px",type="text", value = "<?php echo "$questionsArray[$x]" ?>" , class="inputFields reviewInput" id="username" name=<?php echo "question".($x+1)?> readonly>
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
                <input style="padding: 20px", type="text" value="On a scale of one to five, how would you rate the workload you recieve? (1 = minimal, 5 = alot)"class="inputFields reviewInput" id="username" name=<?php echo "question6"?> readonly>
                <span> 
              </div>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question 7"?></label>
                <input style="padding: 20px", type="text" value="On a scale of one to five, how competent are you with the task(s) given? (1 = not very Competent, 5 = Very Competent)" class="inputFields reviewInput" id="username" name=<?php echo "question7"?> readonly>
                <span> 
              </div>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question 8"?></label>
                <input style="padding: 20px", type="text" value="<?php echo $questionsArray[7] ?>"class="inputFields reviewInput" id="username" name=<?php echo "question8"?> readonly>
                <span> 
              </div>



            <button class="w-50 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="User Login">Appraise the Engineer</button>
          </div>
        </form>
    </main>
  </div>

<?php require('/xampp/htdocs/groupfour-main/Footer.php');?>