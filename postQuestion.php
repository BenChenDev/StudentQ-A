<?php
global $conn;
//get current use's userId
$sql = "SELECT * from Users WHERE Username = '$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$userId = $row['UserId'];
$sql2 = "INSERT INTO Questions (UserId, Question, Date)VALUES ('$userId', '$post_string',current_date) ";
mysqli_query($conn,$sql2);
?>