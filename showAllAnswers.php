<?php
global $conn;
$sql = "SELECT * FROM Questions WHERE Question = '$question'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$questionId = $row['QuestionId'];

$sql2 = "SELECT Answer, Date FROM Answers WHERE QuestionId = '$questionId'";
$result2 = mysqli_query($conn, $sql2);

$table = array();
$table["Question:'$question'"] = array();
$i = 0;
while($row2 = mysqli_fetch_assoc($result2)){
	$table["Question:'$question'"][$i] = $row2;
	$i = $i + 1;
}
echo json_encode($table);
?>