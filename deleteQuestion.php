<?php
global $conn;
$sql = "SELECT * from Users WHERE Username = '$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$userId = $row['UserId'];

$sql2 = "DELETE FROM Questions WHERE Question = '$question' and UserId = '$userId'";
mysqli_query($conn,$sql2);
?>