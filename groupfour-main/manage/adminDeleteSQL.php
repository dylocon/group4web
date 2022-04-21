
<?php

$db1 = new SQLite3('/xampp/Data/ActemiumDB.db');
$q = "DELETE FROM User WHERE ID = :userID";
$cq = $db1->prepare($sql1);
$cq->bindValue(':userID', $_GET['userID']);
$res = $cq->execute();



header("Location: adminDeleteConfirmation.php");
?>
