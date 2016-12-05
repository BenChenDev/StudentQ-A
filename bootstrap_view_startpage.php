<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class='container'>
        <div class='row'style='background-color:Lavender'>
            <div class='col-md-1'>
                <div class="dropdown" style='top: 20px'>  <!-- dropdown -->
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                        Menu
                    </button>
                    <ul class="dropdown-menu">  <!-- dropdown-menu  -->
                        <li><a href='#modal-signin' data-toggle='modal'>Sign In</a></li>  <!-- modal -->
                        <li><a href='#modal-join' data-toggle = 'modal'>Join</a></li>
                        <li><a href='#modal-unsubscribe' data-toggle = 'modal'>Unsubscribe</a></li>
                        <li class='divider'></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
            </div>
            
            <div class='col-md-11'>
                <h1 style='text-align: center'>TRU Questions & Answers</h1>	
            </div>
        </div>
    </div>

    <!-- Modal for SignIn -->
    <div id="modal-signin" class="modal fade">
    
        <div class="modal-dialog">
        
            <div class="modal-content">
                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign In</h4>
                </div>
                              
                <div class="modal-body">
                    <form id='form-signin' method='POST' action='bootstrap_controller.php'>
                            <div class="form-group">
                                <label for="username1">Username:</label>
                                <input type="text" class="form-control" id="username1" name='username1'required>
                            </div>
                            <div class="form-group">
                                <label for="password1">Password:</label>
                                <input type="password" class="form-control" id="password1" name='password1'required>
                            </div>
							<input type='hidden' name='page' value='StartPage'>
							<input type='hidden' name='command' value='SignIn'>
                            <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
	<div id="modal-join" class="modal fade">
    
        <div class="modal-dialog">
        
            <div class="modal-content">
                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Join</h4>
                </div>
                              
                <div class="modal-body">
                    <form id='form-join' method='POST' action='bootstrap_controller.php'>
                        <input type='hidden' name='page' value='StartPage'>
                        <input type='hidden' name='command' value='Join'>
                            <div class="form-group">
                                <label for="username2">Username:</label>
                                <input type="text" class="form-control" id="username2" name='username2'required>
                            </div>
                            <div class="form-group">
                                <label for="password2">Password:</label>
                                <input type="password" class="form-control" id="password2" name='password2'required>
                            </div>
							<div class="form-group">
                                <label for="fullname">Fullname:</label>
                                <input type="text" class="form-control" id="fullname" name='fullname'required>
                            </div>
							<div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" class="form-control" id="email" name='email'required>
                            </div>
                            <button type="submit" class="btn btn-default">Join</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
	<div id="modal-unsubscribe" class="modal fade">
    
        <div class="modal-dialog">
        
            <div class="modal-content">
                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Unsubscribe</h4>
                </div>
                              
                <div class="modal-body">
                    <form id='form-signin' method='POST' action='bootstrap_controller.php'>
                        <input type='hidden' name='page' value='StartPage'>
                        <input type='hidden' name='command' value='Unsubscribe'>
                            <div class="form-group">
                                <label for="username3">Username:</label>
                                <input type="text" class="form-control" id="username3" name='username3'required> 
                            </div>
                            <div class="form-group">
                                <label for="password3">Password:</label>
                                <input type="password" class="form-control" id="password3" name='password3'required>
                            </div>
                            <button type="submit" class="btn btn-default">Unsubscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
