<?php

function check_username($username){
	global $conn;
	$sql="SELECT Username From Users WHERE Username='$username'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) >= 1){
		return false;
	} else 
		return true;
}

function insert_row($username, $password, $fullname, $email){
	global $conn;
$sql = "INSERT INTO Users (Username, Password, Fullname, Email)
VALUES ('$username', '$password', '$fullname', '$email')";

if (mysqli_query($conn, $sql)) {
    echo "*Sign up successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	echo $username.$password.$fullname.$email;
}
}


function check_vali($username,$password){
	global $conn;
	
	$sql="SELECT Username From Users WHERE Username= '$username' and Password= '$password'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0){
		return true;
    }
    else {
		return false;
    }

}

function delete_row($username, $password){
	global $conn;
	if(check_vali($username,$password)){
	$sql = "DELETE FROM Users WHERE Username='$username'";

	if (mysqli_query($conn, $sql)) {
		echo "*Unsubscribed";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
	}}else{
		echo '*Wrong password or username';
	}
	
	
}

?>