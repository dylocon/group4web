<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
$db = new SQLite3('/xampp/Data/StudentModule.db');
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

<main class="form-signin col-md-2 center">
<link rel="stylesheet" href="/groupfour-main/site.css" />
  <form method="post">
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
<div style="text-align: center">
<hr style="border:3px solid #f1f1f1">
<?php



$db = new SQLite3('/xampp/Data/StudentModule.db');
$stmt = $db->prepare('SELECT SumScore, ReviewAmount FROM User WHERE ID = :userID');
$stmt->bindParam(':userID', $_GET['userID'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];
while ($row=$result->fetchArray())
{
    $rows_array[]=$row;
}
if ($rows_array[0][0] == 0){
  $avgscorePercent = 0;
}
else{
  $avgscorePercent = (($rows_array[0][0] / $rows_array[0][1]) / 5)*100 ;
}

?>
<div class="row">
  <div class="side" style="margin-left:10px">
    <div>Engineer's Score Average</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div style="width:<?php echo $avgscorePercent?>%; height: 18px; background-color: #2196F3;"></div>
      
    </div>
  </div>
  <div class="side right">
    <div><?php echo $avgscorePercent."%"?></div>
  </div>
  <div class="side" style="margin-left:10px">
    <div>Whole Team's Average</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo "60%" ?></div>
  </div>
</div>
</div>














  </form>
</main>
<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>