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
$role = $rows_array[0][0];
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

    <link rel="stylesheet" href="/groupfour-main/site.css" />
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>


<?php
$dbUser = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmtUser = $dbUser->prepare('SELECT ID, firstName, lastName, Role FROM User WHERE Role = "User"');
$stmtUser->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
$resultUser = $stmtUser->execute();
$usersArray = [];
$count = 0;
while ($rowUser=$resultUser->fetchArray())
{
    $usersArray[]=$rowUser;
    $count += 1;
}
?>








<main class="form-signin col-md-2 center">
<link rel="stylesheet" href="/groupfour-main/site.css" />
<link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
  <form method="post">
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
<div style="text-align: center">
<table style="width: 100%;text-align: center ;border: solid 2px black;">
          <tr class="tableHead">
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Options</th>
          </tr>
          <?php for ($x = 0; $x < $count; $x+=1) {?>
                <tr style=""class = "questionsFont">
                    <td class = "questionsFont"><?php echo $usersArray[$x][0]." "?> </td>
                    <td><?php echo $usersArray[$x][1]." "?></td>
                    <td><?php echo $usersArray[$x][2]." "?></td>
                    <td><?php echo $usersArray[$x][3]." "?></td>
                    
                    <td bgcolor = "#bdfcff" style = ""><a href="appraiseUser.php?userID=<?php echo $usersArray[$x][0]?>"><strong>Appraise</strong></a>
                    <a><strong>|</strong></a>
                    <a href="/groupfour-main/manage/progress.php?userID=<?php echo $usersArray[$x][0]?>"><strong>Progress</strong></a> 
                    <?php if($role == "Admin"){ ?>
                    <a><strong>|</strong></a>
                    <a href="/groupfour-main/manage/adminUpdate.php?userID=<?php echo $usersArray[$x][0]?>"><strong>Update</strong></a> 
                    <a><strong>|</strong></a>
                    <a href="/groupfour-main/manage/adminDeleteSQL.php?userID=<?php echo $usersArray[$x][0]?>"><strong>Delete</strong></a> </td>
                    <?php }?>
                </tr>
          <?php } ?>

</table>
</div>

  </form>
</main>

<?php require('/xampp/htdocs/groupfour-main/Footer.php');?>