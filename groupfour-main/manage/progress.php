<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
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

if (isset($_POST['submit'])){
  header('Location: manageCreateObj.php?userID='.$_GET['userID']);
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
<div class="progressCanvas col-md-6" style = "margin-bottom: 100px;">
  <main class="form-signin">
<link rel="stylesheet" href="/groupfour-main/site.css" />
  <form method="post">
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
    <h2 class="h3 mb-3 fw-normal" style="text-align: center">Appraisal Progress</h2>
<div style="text-align: center">
<hr style="border:3px solid #f1f1f1">
<?php

$db = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmt = $db->prepare('SELECT Number,AVGSCORE, AnswerID, AppraiseeID FROM ReviewsA WHERE AppraiseeID = :userID');
$stmt->bindParam(':userID', $_GET['userID'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];
$count = 0;
while ($row=$result->fetchArray())
{
    $count += 1;
    $rows_array[]=$row;
}

?>

<div class="row" style="overflow: auto">
<?php for($x = 0  ; $x < $count; $x+=1) {?>
<?php 
if($rows_array[$x][1] == 0){
  $avgscorePercent = 0;
}
else{
  $avgscorePercent = ($rows_array[$x][1] / 5) * 100;
}

?>
  <div class="side" style="margin-left:10px">
    <div><a href="/groupfour-main/reviews/viewAnswers.php?answersID=<?php echo $rows_array[$x][2]?>"> A <?php echo $x+1 ?></a></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div style="width:<?php echo $avgscorePercent?>%; height: 18px; background-color: #2196F3;"></div> 
    </div>
  </div>
  <div class="side right">
    <div><?php echo $avgscorePercent."%"?></div>
  </div>
  <br>
  <?php } ?>


  


  </form>
</main>
</div>






<div class="objectivesCanvas col-md-6" style = "position: relative;">
  <main class="form-signin">
  <link rel="stylesheet" href="/groupfour-main/site.css" />
  <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
  <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
  <div style="text-align: center">
      <h1>Objectives</h1>
  </div>
  <hr style="border:3px solid #f1f1f1">
  <table style="width: 100%; text-align: center;border: solid 2px black">
    <?php
    $userID = $_GET['userID'];
    $db = new SQLite3('/xampp/Data/ActemiumDB.db');
    $stmt = $db->prepare("SELECT objID,objName,Status, Assigned FROM Objectives WHERE userID = $userID  ");
    $result = $stmt->execute();
    $rows_array = [];
    $count = 0;
    while ($row=$result->fetchArray())
    {
      $count += 1;
      $rows_array[]=$row;
    }
    ?> 
    <?php if($count != 0){ ?>
    <tr class="tableHead">
      <th>Objective ID</th>
      <th>Objective Name</th>
      <th>Status</th>
      <th>Assigned By</th>
    </tr>

    <?php $_SESSION['reviewID'] =  $rows_array[0][0]; ?>
    <?php for($x = 0  ; $x < $count; $x+=1){?>
    <tr>
      <td><?php echo $rows_array[$x][0]?></a></td>
      <td><a href="userObjective.php?objID=<?php echo $rows_array[$x][0]?>"><strong><?php echo $rows_array[$x][1]?></strong></a></td>
      <td><?php echo $rows_array[$x][2]?></td>
      <td><?php echo $rows_array[$x][3]?></td>
    </tr>
    <?php } ?>
  <?php } 
    else { ?>
    <h1 style = "text-align: center">User has no objectives.</h1>
  <?php } ?>
  </table>
    <form  method="post">
      <button class="w-30 btn btn-lg btn-primary" style="margin-top:10px" type="submit" name="submit" value="User Login">Add Objective</button>
    </form>
</main>
    </div>











<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>