
<?php 
include("NavBar.php");

$errorappID = $invalidMesg = "";

$nameErr = $pwderr = $invalidMesg = "";

function verifyUsers () {
if (!isset($_POST['appID']) and !isset($_POST['lastname']) and !isset($_POST['postcode'])) {
    echo "Error";  // <-- return null;  
}

$db = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmt = $db->prepare('SELECT UserName, Password FROM User WHERE UserName = :username');
$stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);

$result = $stmt->execute();

$rows_array = [];
while ($row=$result->fetchArray())
{
    $rows_array[]=$row;
}
return $rows_array;
}
if (isset($_POST['submit'])) {
    if($_POST['username'] != null && $_POST['password'] !=null)
    {
        $array_user = verifyUsers(); 
        if ($array_user != null){
            if ($array_user[0][0]==$_POST['username'] && $array_user[0][1]==$_POST['password'])
            {
                session_start();
                $_SESSION['username'] = $array_user[0][0];
                header("Location: loginLandingPage.php"); 
                exit();
            }
        }
        }
        else{
          $nameErr = "Please enter your Username correctly.";
          $pwderr = "Please enter your Password correctly.";
    }
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
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:100px">Username</label>
      <input type="text" placeholder="Username"class="inputFields" id="username" name="username" >
      <br>
      <span class="text-danger"><?php echo $nameErr; ?></span>
      
    </div>
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:108px">Password</label>
      <input type="password" placeholder="Password" class="inputFields"  id="password" name="password" >
      <br>
      <span class="text-danger"><?php echo $pwderr; ?></span>
    </div>

    <br>
    <button class="w-50 btn btn-lg btn-primary" type="submit" name="submit" value="User Login">Sign in</button>
    <?php echo "$invalidMesg"?>

    

</div>

  </form>
</main>

<?php require("Footer.php");?>