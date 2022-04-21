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

<div>
  <main class="form-signin col-md-2 appraisalAnswered">
    <link rel="stylesheet" href="/groupfour-main/site.css" />
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
    <div style="text-align: center">
        <h1>Answered</h1>
    </div>
    <?php
      $db = new SQLite3('/xampp/Data/ActemiumDB.db');
      $stmt = $db->prepare("SELECT ReviewsA.AnswerID, Appraisals.Name, User.firstName, User.lastName FROM ReviewsA 
      INNER JOIN Appraisals ON ReviewsA.QuestionID = Appraisals.QuestionID
      INNER JOIN User ON ReviewsA.AppraiseeID = User.ID");
      $result = $stmt->execute();
      $rows_array = [];
      $count = 0;
      while ($row=$result->fetchArray())
      {
        $count += 1;
        $rows_array[]=$row;
      }
      ?>
    <?php if ($count != 0){ ?>
    <table style="width: 100%; text-align: center; border: solid 2px black">
      <tr class="tableHead">
        <th>AnswerID</th>
        <th>Appraisal</th>
        <th>Engineer</th>
        
      </tr>
      <?php for($x = 0  ; $x < $count; $x+=1){?>
      <tr>
        <td><strong><?php echo $rows_array[$x][0]?></strong></td>
        <td><a href="viewAnswers.php?answersID=<?php echo $rows_array[$x][0]?>"><strong><?php echo $rows_array[$x][1]?></strong></a></td>
        <td><strong><?php echo $rows_array[$x][2]." ".$rows_array[$x][3]?></strong></td>
      </tr>
      <?php } ?>
    <?php } 
    else{ ?>
    <h1 style="text-align: center"> You have no Appraisals Answered. </h1>
    <?php }?>

    </table>
  </main>
</div>










<div>
  <main class="form-signin col-md-2 appraisalPending">
    <link rel="stylesheet" href="/groupfour-main/site.css" />
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
    <div style="text-align: center">
        <h1>Pending</h1>
    </div>
    <?php
      $db = new SQLite3('/xampp/Data/ActemiumDB.db');
      $stmt = $db->prepare("SELECT ReviewID, Appraisal_Name, Engineer_Name, Date, DateDue FROM ReviewsQ");
      $result = $stmt->execute();
      $rows_array = [];
      $count = 0;
      while ($row=$result->fetchArray())
      {
        $count += 1;
        $rows_array[]=$row;
      }
      ?>
    <?php if ($count != 0){ ?>
    <table style="width: 100%; text-align: center; border: solid 2px black">
      <tr class="tableHead">
        <th>ReviewID</th>
        <th>Appraisal</th>
        <th>Engineer</th>
        <th>Date</th>
        <th>Next Appraisal</th>
        <th>Options</th>
        
      </tr>
      <?php for($x = 0  ; $x < $count; $x+=1){?>
      <tr>
        <td><strong><?php echo $rows_array[$x][0]?></strong></td>
        <td><strong><?php echo $rows_array[$x][1]?></strong></td>
        <td><strong><?php echo $rows_array[$x][2]?></strong></td>
        <td><strong><?php echo $rows_array[$x][3]?></strong></td>
        <td><strong><?php echo $rows_array[$x][4]?></strong></td>
        <td><a href="delReviewOnly.php?reviewID=<?php echo $rows_array[$x][0]?>"><strong>Delete</strong></a></td>
      </tr>
      <?php } ?>
    <?php } 
    else{ ?>
    <h1 style="text-align: center"> You have no Appraisals Pending. </h1>
    <?php }?>

    </table>
  </main>
</div>

<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>