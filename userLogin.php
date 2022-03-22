
<?php 
include("NavBar.php");

$errorappID = $invalidMesg = "";

$nameErr = $pwderr = $invalidMesg = "";



if (isset($_POST['submit'])) {


    if($_POST['appID'] != null && $_POST['lastname'] !=null && $_POST['postcode'])
    {
        $array_user = verifyUsers(); 
        if ($array_user != null) {

      
            if ($array_user[0]['appID']=="$appID")
            {
                session_start();
                $_SESSION['appID'] = $array_user[0][$appID];
                $_SESSION['lastname'] = $array_user[0]['lastname'];
                $_SESSION['postcode'] = $array_user[0]['postcode'];
               
                header("Location: viewUser.php"); 
                exit();
            }
 
        }
        else{
            echo "Invalid credentials!";
        }
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
      <input type="text" placeholder="Username"class="inputFields" id="appID" name="appID" >
      <span class="text-danger"><?php echo $errorappID; ?></span>
    </div>
<br>
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:108px">Password</label>
      <input type="password" placeholder="Password" class="inputFields"  id="lastname" name="lastname" >
      <span class="text-danger"><?php echo $errorappID; ?></span>
    </div>

    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <br>
    <button class="w-50 btn btn-lg btn-primary" type="submit" name="submit" value="User Login">Sign in</button>
    <?php echo "$invalidMesg"?>

    

</div>

  </form>
</main>

<?php require("Footer.php");?>