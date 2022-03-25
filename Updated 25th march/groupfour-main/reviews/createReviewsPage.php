<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_ONCE("createReviewSQL.php");
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
    include('NavBar.php');
}

if (isset($_POST['submit'])) {
  $createReview = CreateReviewFunc();
  header('Location: createReviewConfirmation.php?createUser='.$createReview); 
  exit();
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
<div style = "">

<div class="reviewCanvas col-md-6" style = "margin-bottom: 20px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
        <form method="post">
          <div style="text-align: center">
          </div>
          <div style="text-align: center">
              <div>
                <label for="floatingInput"style="font-size:20px"class="loginFont reviewLabel">Enter the Appraisee's ID</label>
                <input type="text" placeholder="Appraisee ID"class="inputFields reviewInput" id="engineerID" name="engineerID">
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
            <?php for ($x = 1; $x <= 12; $x+=1) {?>
              <div>
                <label for="floatingInput"class="loginFont reviewLabel"><?php echo "Question"." ".$x?></label>
                <input type="text" placeholder="Question ..."class="inputFields reviewInput" id="username" name=<?php echo "question".$x?>>
              </div>
            <?php } ?>
            <button class="w-50 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="User Login">Publish the Review</button>
          </div>
        </form>
    </main>
  </div>
</div>





















<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>