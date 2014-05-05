<?php 
require 'core/init.php';
$general->logged_out_protect();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>New Exercise</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/prettify.css">
	<link rel="shortcut icon" href="images/icon.ico">
	<script src="js/jquery-2.1.0.min.js"></script>
 	<script src="js/bootstrap.js"></script>
 	<script src="js/prettify.js"></script>
 	<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
 	<link rel="stylesheet" type="text/css" href="summernote/summernote.css">
 	<link rel="stylesheet" type="text/css" href="summernote/summernote-bs3.css">
 	<script type="text/javascript" src="summernote/summernote.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select/bootstrap-select.css">
	<script src="css/bootstrap-select/bootstrap-select.js"></script>
 	<style type="text/css">
 	.form-title {
 		padding-bottom: 10px;
 		border-bottom: 1px solid #eee;
 	}
 	label {
 		padding-right: 10px;
 		display: inline;
 	}
 	.sp {
 		margin-bottom: 0;
 		margin-top: 5px; 	
 	}

 	.form-btn {
 		padding-top: 10px;
 	}
 	.multiple {
 		padding-bottom: 10px;
 	}
 	</style>
</head>
<body>
<div class="container" style="width: 100%;">
	<h3 class="form-title">Create new exercises <span class="label label-danger pull-right">Close</span></h3>
	<form role="form" method="post">
		<div class="form-group sp">
			<label>Exercise title</label>
			<input type="text" class="form-control" name="exercise_title" id="exercise_title" placeholder="Exercise title"> 
		</div>
		<div class="form-group sp">
			<div class="row">
				<div class="col-md-6">
					<label>Exercise type</label><br>
					<select class="selectpicker" name="exercise_type" style="width: 100%">
						<option value="multiple">Multiple-choice exercise</option>
						<option value="written">Written exercise</option>
					</select>
				</div>
				<div class="col-md-3">
					<label>Score</label>
					<input type="text" class="form-control" name="score" id="score" placeholder="Exercise score" style="display: inline;"> 
				</div>
				<div class="col-md-3">
					<label>Maximum attempt</label>
					<input type="text" class="form-control" name="attempt_limit" id="attempt_limit" placeholder="Maximum attempt" style="display: inline;"> 
				</div>
			</div>
		</div>
		<div class="form-group sp">
			<label>Question</label>
			<div id="summernote"></div>
		</div>
		<div class="form-group sp" id="mul-answer">
			<label>Answers</label>
			<div class="input-group multiple">
			  <span class="input-group-addon">A</span>
			  <input type="text" class="form-control" name="multiple_one" id="multiple_one">
			</div>
			<div class="input-group multiple">
			  <span class="input-group-addon">B</span>
			  <input type="text" class="form-control" name="multiple_two" id="multiple_two">
			</div>
			<div class="input-group multiple">
			  <span class="input-group-addon">C</span>
			  <input type="text" class="form-control" name="multiple_three" id="multiple_three">
			</div>
			<div class="input-group multiple">
			  <span class="input-group-addon">D </span>
			  <input type="text" class="form-control" name="multiple_four" id="multiple_four">
			</div>
		</div>
		<div class="form-group sp">
			<label>Correct Answer</label>
			<select class="selectpicker" name="correct_answer" style="width: 100%">
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
			</select>
		</div>
		<div class="form-group form-btn">
			<button type="submit" name="create_exercise" class="btn btn-primary">Create</button>
			<button type="submit" name="discard" class="btn btn-default" id="discard">Discard</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	  $('.selectpicker').selectpicker();
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
	  $('#summernote').summernote({
	  	height: 100,
	  	focus: true
	  });
	});
</script>
</body>
</html>