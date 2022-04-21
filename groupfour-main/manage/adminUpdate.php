
<?php 
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_once('adminUpdateSQL.php');
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


$errorfname = $errorlname = $errorpwd = $errorrole ='';
$allFields = "yes";
if (isset($_POST['update'])) {
  if ($_POST['firstname']==""){
    $errorfname = "First name is mandatory";
    $allFields = "no";
}
if ($_POST['surname']==""){
    $errorlname = "Last name is mandatory";
    $allFields = "no";
}
if ($_POST['role']==""){
    $errorrole = "Role selection is mandatory";
    $allFields = "no";
}
if ($_POST['type']==""){
  $errorrole = "Type selection is mandatory";
  $allFields = "no";
}

if($allFields == "yes")
{
  $_SESSION['userID'] = $_GET['userID'];
  $updateUser = updateUser();
  header("Location: adminUpdateConfirmation.php?createUser='.$updateUser"); 
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
      <label for="floatingInput"class="loginFont"style="padding-right:172px">Role</label>
      <select class="inputFields reviewInput" name="role" id="role">
        <option value="Admin">Admin</option>
        <option value="Manager">Manager</option>
        <option value="User">User</option>
      </select>
    </div>
    <span class="text-danger"><?php echo $errorrole; ?></span>
    <br>
    <div class="form-floating">
      <label for="floatingInput"class="loginFont"style="padding-right:172px">Type</label>
      <select class="inputFields reviewInput" name="type" id="type">
        <option value="Aerospace">Aerospace</option>
        <option value="Civil">Civil</option>
        <option value="Mechanical">Mechanical</option>
      </select>
    </div>
    <span class="text-danger"><?php echo $errorrole; ?></span>

    </div>
    <br>
    <button style="margin-left: 180px" class="w-50 btn btn-lg btn-primary" type="submit" name="update" value="User Login">Update</button>
    



  </form>
</main>

<?php require('/xampp/htdocs/groupfour-main/Footer.php');?>