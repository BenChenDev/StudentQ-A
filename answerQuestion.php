<?php
global $conn;
$sql = "SELECT * from Users WHERE Username = '$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$userId = $row['UserId'];

$sql2 = "SELECT * from Questions WHERE Question = '$question'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$questionId = $row2['QuestionId'];

$sql3 = "INSERT INTO Answers (QuestionId, UserId, Answer, Date)VALUES('$questionId','$userId','$answer',current_date)";
mysqli_query($conn,$sql3);


?>