
<?php
function updateUser()
{


    $db1 = new SQLite3('/xampp/Data/ActemiumDB.db'); 
	$q = "UPDATE User SET firstName=:fName, lastName=:lName, Role =:role, Type= :type where ID = :ID";
	$cq = $db1->prepare($q);
	$cq->bindValue(':fName',$_POST['firstname']);
	$cq->bindValue(':lName',$_POST['surname']);
	$cq->bindValue(':role',$_POST['role']);
    $cq->bindValue(':type',$_POST['type']);
	$cq->bindValue(':ID',$_SESSION['userID']);
	$res = $cq->execute();
}
?>