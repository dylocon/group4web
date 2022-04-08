<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_once('manageDeleteObj.php');
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



if (isset($_POST['update'])) {
  $deleteObj = userDeleteObj($_GET['objID']);
  header('Location: /groupfour-main/admin/adminUsers.php?updateObj='.$deleteObj); 
  exit();
}
if (isset($_POST['finish'])) {
  $completeObj = userCompleteStatus($_GET['objID']);
  header('Location: userUpdateStatusConfirmation.php?completeObj='.$completeObj); 
  exit();
}




$countObj = 0;

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
    $objID = $_GET['objID'];
    $db = new SQLite3('/xampp/Data/StudentModule.db');
    $stmt = $db->prepare("SELECT objName,M1,M2,M3,M4,M1_Status,M2_Status,M3_Status,M4_Status  FROM Objectives WHERE objID = $objID ");
    $result = $stmt->execute();
    $rows_array = [];
    $count = 0;
    while ($row=$result->fetchArray())
    {
    $count += 1;
    $rows_array[]=$row;
    }
?> 
<main class="form-signin col-md-2 center">
<form method="post">
  <link rel="stylesheet" href="/groupfour-main/site.css" />
  <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
  <div style="text-align: center">
      <h1><?php echo $rows_array[0][0]?></h1>
  </div>
  
  <table style="width: 100%; text-align: center;border: solid 2px black">

    <tr>
      <th>Milestones</th>
      <th>Status</th>
    </tr>
    <?php for($x = 1  ; $x <= 4; $x+=1){?>
    <tr>
      <?php if ($rows_array[0][$x] != null) {
        $countObj += 1?>
        <td ><?php echo $rows_array[0][$x]?></td>
        <?php if($rows_array[0][$x+4] == "Complete"){?>
        <td bgcolor = "#bbf277">
            <h3><?php echo $rows_array[0][$x+4] ?> </h3>
        </td>
        <?php } else { ?>
          <td bgcolor = "#f0a665">
            <h3><?php echo $rows_array[0][$x+4] ?> </h3>
        </td>
          <?php } ?>
        <?php } ?>
    </tr>
    <?php } ?>
  </table>



  <?php
  $statusCount = 0;
    for($x = 0  ; $x <= 3; $x+=1){
        if ($rows_array[0][$x+5] == "Complete"){
            $statusCount += 1;
        }
    }
    if ($statusCount == $countObj){
      $avgscorePercent = 100;
    }
    else{
      $avgscorePercent = (100 / ($statusCount+1));
    }
    
  ?>
  <div class="row">
  <div class="side" style="margin-left:10px">
    <div>Objectives Percentage</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div style="width:<?php echo $avgscorePercent?>%; height: 18px; background-color: #2196F3;"></div>
      
    </div>
  </div>
  <div class="side right">
    <div><?php echo $avgscorePercent."%"?></div>
  </div>
</div>
</div>

  <div style="clear: both;text-align: center">
      <button class="w-30 btn btn-lg btn-primary" style="align: center;margin-top:20px" type="submit" name="update" value="User Login">Delete</button>
      <button class="w-30 btn btn-lg btn-primary" style="align: center;margin-top:20px;" type="submit" name="finish" value="User Login" <?php if($statusCount != 4){?>disabled <?php }?>>Finish Objective</button>
  </div>
  </form>




</main>

<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>