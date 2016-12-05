<?php
global $conn;
$sql = "SELECT * from Users WHERE Username = '$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$userId = $row['UserId'];
$sql2 = "SELECT Question, Date FROM Questions WHERE UserId = '$userId'";
$result2 = mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2) < 1){
	echo false;
}
else{
$table = array();  
$table["Questions"] = array();
$i = 0;
    while($row2 = mysqli_fetch_assoc($result2)) {// eof: end of file
        
        
            $table["Questions"][$i] = $row2;
			$i = $i+1;
	
    }

    echo json_encode($table); 
}
?>	