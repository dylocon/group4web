
<?php 
include("NavBar.php");
include_ONCE("createUserSQL.php");

$errorfname = $errorlname = $errorpwd = $errorrole ='';
$allFields = "yes";

if (isset($_POST['submit'])){
    if ($_POST['firstname']==""){
        $errorfname = "First name is mandatory";
        $allFields = "no";
    }
    if ($_POST['surname']==""){
        $errorlname = "Last name is mandatory";
        $allFields = "no";
    }
    if ($_POST['password']==""){
        $errorpwd = "Password is mandatory";
        $allFields = "no";
    }
    if ($_POST['role']==""){
        $errorrole = "Role selection is mandatory";
        $allFields = "no";
    }

    if($allFields == "yes")
    {
        $createUser = CreateAnAccountFunc();
        header('Location: userLogin.php?createUser='.$createUser);
    }
    echo $_POST['firstname'];
    echo "\n";
    echo $_POST['surname'];
    echo "\n";
    echo $_POST['password'];
    echo "\n";
    echo $_POST['role'];
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
      <label for="floatingInput"class="loginFont"style="padding-right:100px">Firstname</label>
      <input type="text" placeholder="Firstname"class="inputFields" id="firstname" name="firstname" >
      
    </div>
    <span class="text-danger"><?php echo $errorfname; ?></span>
<br>
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:108px">Surname</label>
      <input type="text" placeholder="Surname" class="inputFields"  id="surname" name="surname" >
      
    </div>
    <span class="text-danger"><?php echo $errorlname; ?></span>
<br>
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:108px">Password</label>
      <input type="password" placeholder="password" class="inputFields"  id="password" name="password" >
      
    </div>
    <span class="text-danger"><?php echo $errorpwd; ?></span>
<br>
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:172px">Role</label>
      <input type="text" placeholder="Role" class="inputFields"  id="role" name="role" >
    </div>
    <span class="text-danger"><?php echo $errorrole; ?></span>

    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <br>
    <button class="w-50 btn btn-lg btn-primary" type="submit" name="submit" value="User Login">Register</button>

    

</div>

  </form>
</main>

<?php require("Footer.php");?>