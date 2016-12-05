<?php
global $conn;

$sql = "SELECT Question, Date from Questions WHERE Question like '%$string%'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)<1){
	echo false;
}
else{
    $table = array();  // []
    $table["Questions"] = array();  // {"caption" => []}
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {  // eof: end of file
        
        
            $table["Questions"][$i] = $row;  // add it 
			$i = $i+1;
	
    }

    echo json_encode($table);  // Convert the associative array to a JSON string, and send it back to the client
}
?>