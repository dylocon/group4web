<?php
$created = false;//this variable is used to indicate the creation is successful or not
$db = new SQLite3('/xampp/Data/ActemiumDB.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
$sql = "DELETE FROM ReviewsQ wHERE ReviewID = :rID";
$stmt = $db->prepare($sql); //prepare the sql statement
$stmt->bindParam(':rID', $_GET['reviewID'], SQLITE3_INTEGER);
$stmt->execute();

Header("Location: viewReviews.php")
?>