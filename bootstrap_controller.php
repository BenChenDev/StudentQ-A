<?php

/*
*   When controller.php is accessed for the first time
*/

if (empty($_POST['page'])) {
    $display_type = 'no-signin';
    include ('bootstrap_view_startpage.php');  // StartPage
    exit;
}

/*
*   When commands come from StartPage or MainPage
*/


require ('module.php');  // connect to MySQL database
require ('module_users.php');  // functions to use Users table
/**
require ('module_questions.php');  // functions to use Questions table
require ('module_answers.php');  // functions to use Answers table
**/

session_start();

$page = $_POST['page'];
$command = $_POST['command'];

if ($page == 'StartPage') 
{
    switch ($command) {
    case 'SignIn':
	$username1 = $_POST['username1'];
	$password1 = $_POST['password1'];
			
	if (!empty($_POST['username1']) && !empty($_POST['password1'])){
        if(check_vali($username1,$password1)){
			$display_type = 'signin';
					
			$username = $_POST['username1'];
			$password = $_POST['password1'];
			// For testing, let's assume that they are valid.
			// Session variables
			$_SESSION['signedin'] = 'YES';
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
					
			include('bootstrap_view_mainpage.php');
		}else {
				echo '*Wrong username or wrong password, please try again';
				$display_type = 'no-signin';  
				include('bootstrap_view_startpage.php');
			}

	}
	else
	{
		$display_type = 'no-SignIn';
		include('bootstrap_view_startpage.php');
	}
    break;
		
	case 'Join':  
			if (empty($_POST['username2']))  // If username is empty
                $error_msg_username2 = '*required'; 
            else  // username
                $username2 = $_POST['username2'];  // in order to redisplay
            
            // Get password
            if (empty($_POST['password2']))  // If password is empty
                $error_msg_password2 = '*required';  // error message for the missing password 
            else
                $password2 = $_POST['password2'];
			
			if (empty($_POST['fullname']))  // If password is empty
                $error_msg_fullname = '*required';  // error message for the missing password 
            else
                $fullname = $_POST['fullname'];
			
			if (empty($_POST['email']))  // If password is empty
                $error_msg_email = '*required';  // error message for the missing password 
            else
                $email = $_POST['email'];
            
            // If anyone of them is not missing
            if (empty($error_msg_username2) && empty($error_msg_password2)&& empty($error_msg_fullname) && empty($error_msg_email))  
			{
                if(check_username($username2)){
					insert_row($username2, $password2, $fullname, $email);
					include('bootstrap_view_startpage.php');
				}else{
					echo '*User name is already existed, please try another one'; 
					include('bootstrap_view_startpage.php');
					}		
            }else {
                include('bootstrap_view_startpage.php');  // Start page
            }
            exit(); 
			
	case 'Unsubscribe': 
           
            if (empty($_POST['username3'])) 
                $error_msg_username3 = '*required'; 
            else  
                $username3 = $_POST['username3']; 
           
            if (empty($_POST['password3'])) 
                $error_msg_password3 = '*required';  
            else
                $password3 = $_POST['password3'];
			
			if (empty($error_msg_username3) && empty($error_msg_password3))  
			{
				
				if(check_vali($username3,$password3))
				{
					delete_row($username3,$password3);
					$display_type = 'Unsubscribe';  // If anyone of them is missing, then redisplay the StartPage with the 'SignIn' form having error messages.
					include('bootstrap_view_startpage.php');
				}
				else
				{
					echo '*Wrong password or wrong username.';
					$display_type = 'Unsubscribe';  // If anyone of them is missing, then redisplay the StartPage with the 'SignIn' form having error messages.
					include('bootstrap_view_startpage.php');
				}
			}
			else
			{
				$display_type = 'unsubscribe';
				include('bootstrap_view_startpage.php');
			}		
    }
}

else if ($page == 'MainPage') 
{
    if (!isset($_SESSION['signedin'])) {
        $display_type = 'no-signin';
        include ('bootstrap_view_startpage.php');  // StartPage
        exit;
    }
    
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    switch ($command) {
    case 'SignOut':  // 'SignOut' menu item, or timeout
        session_unset();
        session_destroy();  // It does not unset session variables. session_unset() is needed.
        $display_type = 'no-signin';
        include ('bootstrap_view_startpage.php');  // StartPage
        break;
    case 'SearchQuestions':
        $string = $_POST['search-terms'];
        include('searchQuestions.php');
        break;
	case 'PostQuestions':
		$post_string = $_POST['post-question'];
		include('postQuestion.php');
		break;
	case 'ListQuestions':
		include('listQuestions.php');
		break;
	case 'DeleteQuestion':
		$question = $_POST['Question'];
		include('deleteQuestion.php');
		break;
	case 'AnswerQuestion':
		$question = $_POST['Question'];
		$answer = $_POST['Answer'];
		include('answerQuestion.php');
		break;
	case 'ShowAllAnswers':
		$question = $_POST['Question'];
		include('showAllAnswers.php');
		break;
	case 'ListAnswers':
		include('listAnswers.php');
		break;
	case 'DeleteAnswers':
		$answer = $_POST['Answer'];
		include('deleteAnswers.php');
		break;
    defalut:
        echo 'Unknown command = ' . $command . '<br>';
    }
}
else {
    echo 'Unknow page = ' . $page . '<br>';
}

?>