<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
        var timer = setTimeout(timeout, 10 * 60 * 1000);  // one time timer
        window.addEventListener('mousemove', function() {
            clearTimeout(timer);
            timer = setTimeout(timeout, 10 * 60 * 1000);
        });
        window.addEventListener('keydown', function() {  // 
            clearTimeout(timer);
			timer = setTimeout(timeout, 10  * 60 * 1000);
        });
        window.addEventListener('unload', function() {
            clearTimeout(timer);
			timer = setTimeout(timeout, 10 * 60 * 1000);
        });
        function timeout() {
            document.getElementById('form-signout').submit();  // send the form
        }
    </script>
</head>

<body>
    <!-- for sending commands -->
    <div style='display:none'> 
        <!-- form for SignOut -->
        <form id='form-signout' method='post' action='bootstrap_controller.php'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='SignOut'>
            <input type='submit' value='Submit'>
        </form>
    </div>
    
	<!--operation menu-->
	<div class='container'>
        <div class='row' style='background-color:Lavender'>
            <div class='col-md-1'>
                <div class="dropdown" style='top: 20px' style='background-color:Lavender'>  <!-- dropdown -->
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                        Menu
                    </button>
                    <ul class="dropdown-menu">  <!-- dropdown-menu  -->
                        <li><a href='#modal-post-questions' data-toggle='modal'>Post a question</a></li>  <!-- modal -->
                        <li id='list-questions'><a href = '#'>List my questions</a></li>
						<li id='list-answers'><a href = '#'>List my answers</a></li>
                        <li><a href='#modal-search-questions' data-toggle = 'modal'>Search questions</a></li>
						<li id='menu-signout'><a href='#'>Signout</a></li>
                    </ul>
                </div>
            </div>
			
			<div class='col-md-11' >
				<h1 style='text-align:center'>TRU Questions & Answers</h1>
			</div>
		</div>
    
        
        <div class='row'> 
            <!-- main content -->
            <div id='result-pane' class='col-md-12'>  
            </div>
        </div>
    </div>


    <!-- Modal for SearchQuestions --> 
    <div id="modal-search-questions" class="modal fade"> 
    
        <div class="modal-dialog">
        
            <div class="modal-content">
                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Search Questions</h4>
                </div>
                              
                <div class="modal-body">
                    <form id='form-search-questions'>
                        <div class="form-group">
                            <label for = "input-search-questions-terms">Search terms:</label>
                            <input type="text" class="form-control" id="input-search-questions-terms">
                        </div>
                        <button type="button" class="btn btn-default" id="button-search-questions">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<!--modal for post questions-->
	<div id="modal-post-questions" class="modal fade">  <!-- modal -->
    
        <div class="modal-dialog">
        
            <div class="modal-content">
                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Post a Question</h4>
                </div>
                              
                <div class="modal-body">
                    <form id='form-post-questions'  >
                        <div class="form-group">
                            <label for = "input-post-questions-terms">Post question:</label>
                            <textarea type="text" class="form-control" rows = "5" id="input-post-questions-terms" required></textarea>
                        </div>
                        <button type="button" class="btn btn-default" id="button-post-questions">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
	<!--modal for answer questions-->
	<div id="modal-answer-questions" class="modal fade">  <!-- modal -->
    
        <div class="modal-dialog">
        
            <div class="modal-content">
                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Answer Question</h4>
                </div>
                              
                <div class="modal-body">
                    <form id='form-answer-questions'  >
                        <div class="form-group">
                            <label for = "input-answer-questions-terms">Your Ansewr:</label>
                            <textarea type="text" class="form-control" rows = "5" id="input-answer-questions-terms"></textarea>
                        </div>
                        <button type="button" class="btn btn-default" id="button-answer-questions">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
	<!--sign out-->
    <script>
        $('#menu-signout').click(function() {  // click
            $('#form-signout').submit();  // submit the form
        });
    </script>
	
	<!--buttons action-->
	<script>
	<!--delete question button-->
	$(document).on('click','.my_btn',function(){
		var question = $(this).closest('tr').find('td:first').text();
		$.post('bootstrap_controller.php',
		{
			page:"MainPage",
			command:"DeleteQuestion",
			'Question':question
		},
		function(result){
				alert("Question is deleted successfully.");
		});
		$('#result-pane').empty();
		$.post('bootstrap_controller.php',
			{
				page:"MainPage",
				command:"ListQuestions"
			},
			function(result){
				$('#result-pane').html(construct_list_table(result));
			});
	});
	
	<!--delete my answers button-->
	$(document).on('click','.deleteMyAnswers',function(){
		var answer = $(this).closest('tr').find('td:first').text();
		$.post('bootstrap_controller.php',
		{
			page:"MainPage",
			command:"DeleteAnswers",
			'Answer':answer
		},
		function(result){
				alert("Answer is deleted successfully.");
		});
		
		$('#result-pane').empty();
		$.post('bootstrap_controller.php',
			{
				page:"MainPage",
				command:"ListAnswers"
			},
			function(result){
				$('#result-pane').html(construct_list_answers_table(result));
			});
	});
	
	<!--answer button-->
	$('#modal-answer-questions').on('hidden.bs.modal', function () {
			$(this).find('form').trigger('reset');
		});
	
	var answer_question;
	$(document).on('click','.answerBtn',function(){
		answer_question = $(this).closest('tr').find('td:first').text();
		$('#modal-answer-questions').modal('toggle');
	});
	
		$('#button-answer-questions').click(function(){
			var answer = $('#input-answer-questions-terms').val();
			$('#modal-answer-questions').modal('toggle');
			if(answer == ''){
				alert("Please fill your answer.");
			}
			else{
			$.post('bootstrap_controller.php',
			{
				page:"MainPage",
				command:"AnswerQuestion",
				'Question':answer_question,
				'Answer':answer
			},
			function(result){
				alert("Your answer is posted successfully.");
			});
			}
		});
	
	<!--show all answers button-->
	$(document).on('click','.showAllBtn', function(){
		var question = $(this).closest('tr').find('td:first').text();
		$('#result-pane').empty();
		$.post('bootstrap_controller.php',
		{
			page:"MainPage",
			command:"ShowAllAnswers",
			'Question':question
		},
		function(result){
			if(result == false){
				alert("No answers for the question.");
			}
			else{
			$('#result-pane').html(construct_all_answers(result));
			}
		});
	});
	
	
	function construct_all_answers(data){
		var obj = JSON.parse(data);  
            
        // table tag
        var table = '<table class="table">';
        // table caption
        var caption;
        for (caption in obj) {
            table += '<caption>' + '<h3 style="text-align:center">'+ caption + '</h3>' + '</caption>';
            break;
        }
        // table head
        table += '<tr>';
		for(var p in obj[caption][0])
			table+='<th>' + p + '</th>';
        table += '</tr>';
        // table data
        for (var i = 0; i < obj[caption].length; i++) {
            table += '<tr>';
            for (var p in obj[caption][i])
                table += '<td>' + obj[caption][i][p] + '</td>';
            table += '</tr>';
        }
        // table end tag
        table += '</table>';

        return table;
	}
	</script>
	
	<script>
       function construct_table(data) 
        {
            // Convert the JSON string to an object
            var obj = JSON.parse(data);  
            
            // table tag
            var table = '<table class="table">';
            // table caption
            var caption;
            for (caption in obj) {
                table += '<caption>' + '<h3 style="text-align:center">'+ caption + '</h3>' + '</caption>';
                break;
            }
            // table head
            table += '<tr>';
			for(var p in obj[caption][0])
				table+='<th>' + p + '</th>';
			table += '<th class="col-md-2">' + 'Button' + '</th>';
			table += '<th class="col-md-2">' + 'Button' + '</th>';
            table += '</tr>';
            // table data
            for (var i = 0; i < obj[caption].length; i++) {
                table += '<tr>';
                for (var p in obj[caption][i])
                    table += '<td>' + obj[caption][i][p] + '</td>';
				table += '<td><button type = "button" class="answerBtn">Answer this question</button></td>';
				table += '<td><button type = "button" class="showAllBtn">Show all answers</button></td>';
                table += '</tr>';
            }
            // table end tag
            table += '</table>';

            return table;
        }

        // when the search question button is clicked
		
		//clear the content of the text area
		$('#modal-search-questions').on('hidden.bs.modal', function () {
			$(this).find('form').trigger('reset');
		});
		
        $('#button-search-questions').on('click', function() {
            $('#modal-search-questions').modal('toggle');  // Open/close a modal window; 
                                                           // Somehow 'button' button does not close the modal window.
            // get the search terms
            var search_terms = $('#input-search-questions-terms').val();
			$('#result-pane').empty();
            // send ajax POST request
            $.post('bootstrap_controller.php',
                {
                    page: "MainPage",
                    command: "SearchQuestions",
                    'search-terms': search_terms  // the property named search-terms should be a string here. Otherwise, syntax error.
                },
                // result comes back here
                function(result, status) {
					if(result == false){
						alert("No match result.");
					}
					else{
					$('#result-pane').html(construct_table(result));
					}
                });
        });
		
		//post question submit button is clicked
		$('#modal-post-questions').on('hidden.bs.modal', function () {
			$(this).find('form').trigger('reset');
		});
		
		$('#button-post-questions').click(function(){
			$('#modal-post-questions').modal('toggle');
			var post_question = $("#input-post-questions-terms").val();
			if ($("#input-post-questions-terms").val()== '')
			{
				alert("Please ask a question.");
			}
			else
			{
				$.ajax({
					url:"bootstrap_controller.php",
					type:"POST",
					data:{
						page : "MainPage",
						command:"PostQuestions",
						'post-question':post_question
						},
						success: function(result){
							alert("Question is successfully posted.");
						}
				});
			}
		});
		
		<!--list-questions is clicked-->
		$('#list-questions').click(function(){
			$.post('bootstrap_controller.php',
			{
				page:"MainPage",
				command:"ListQuestions"
			},
			function(result){
				if(result == false){
					alert("You have not posted any questions yet.");
				}else{
				$('#result-pane').html(construct_list_table(result));
				}
			});
		});
		
		function construct_list_table(data)  
        {
            // Convert the JSON string to an object
            var obj = JSON.parse(data);  
            
            // table tag
            var table = '<table class="table">';
            // table caption
            var caption;
            for (caption in obj) {
                table += '<caption>' + '<h3 style="text-align:center">'+ caption + '</h3>' + '</caption>';
                break;
            }
            // table head
            table += '<tr>';
			for(var p in obj[caption][0])
				table+='<th class="col-md-5">' + p + '</th>';
			table += '<th class="col-md-2">' + 'Button' + '</th>';
            table += '</tr>';
            // table data
            for (var i = 0; i < obj[caption].length; i++) {
                table += '<tr>';
                for (var p in obj[caption][i])
                    table += '<td>' + obj[caption][i][p] + '</td>';
				table += '<td><button class = "my_btn" type = "button">Delete</button></td>';
                table += '</tr>';
            }
            // table end tag
            table += '</table>';

            return table;
        }
		
		<!--list my answers-->
		$('#list-answers').click(function(){
			$.post('bootstrap_controller.php',
			{
				page:"MainPage",
				command:"ListAnswers"
			},
			function(result){
				if(result == false){
					alert("You have not posted any anwsers yet.");
				}
				else{
				$('#result-pane').html(construct_list_answers_table(result));
				}
			});
		});
		
		function construct_list_answers_table(data)  
        {
            // Convert the JSON string to an object
            var obj = JSON.parse(data);  
            
            // table tag
            var table = '<table class="table">';
            // table caption
            var caption;
            for (caption in obj) {
                table += '<caption>' + '<h3 style="text-align:center">'+ caption + '</h3>' + '</caption>';
                break;
            }
            // table head
            table += '<tr>';
			for(var p in obj[caption][0])
				table+='<th class="col-md-3">' + p + '</th>';
			table += '<th class="col-md-2">' + 'Button' + '</th>';
            table += '</tr>';
            // table data
            for (var i = 0; i < obj[caption].length; i++) {
                table += '<tr>';
                for (var p in obj[caption][i])
                    table += '<td>' + obj[caption][i][p] + '</td>';
				table += '<td><button class = "deleteMyAnswers" type = "button">Delete</button></td>';
                table += '</tr>';
            }
            // table end tag
            table += '</table>';

            return table;
        }
    </script>
</body>
</html>
