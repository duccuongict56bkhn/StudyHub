<?php 
$title = $course_data['course_title'];
$filename = basename($_SERVER['SCRIPT_NAME']);
$is_teacher = ($users->get_role($user_id) == 'Teacher') ? true : false;
$is_owner   = $courses->is_created_by_me($user_id, $id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>StudyHub | <?php echo $title; ?></title>
	<!-- Global CSS-->
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<link rel="stylesheet" href="../../css/prettify.css">
	<!-- CSS for course page-->
	<link rel="stylesheet" href="../course.css">
	<link rel="stylesheet" href="../../css/dashboard.css">
	<link rel="stylesheet" href="../../css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-select/bootstrap-select.css">
	<script src="../../js/jquery-2.1.0.min.js"></script>
	<script src="../../js/bootstrap.js"></script>
	<script src="../../js/prettify.js"></script>
	<script src="../../js/bootstrap-datepicker.js"></script>
	<script src="../../js/bootstrap-select.js"></script>
</head>
<body>
<!-- Navbar-->
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="../../index.php" class="navbar-brand">StudyHub</a>
		</div>

		<div class="collpase navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a style="color: #eee; font-weight: bold;"><?php echo $course_data['course_title']; ?></a>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<?php 
				if ($general->logged_in()) {
					# if he/she creates the course, he/she can edit its content
					if ($users->get_role($user['user_id']) == 'Teacher' && $courses->is_created_by_me($user['user_id'], $id) === true) { 
						# Show the edit, create menu ?>
						<li class="drowndown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="option-btn">
								<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm">Tools <b class="caret"></b></button>
								</div>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li role="representation" class="dropdown-header">Edit course</li>
								<li>
									<a href="#">Add new unit</a>
									<a href="#">Add new announcement</a>
									<a href="#">Add new materials</a>
								</li>
								<li role="representation" class="divider"></li>
								<li role="representation" class="dropdown-header">Exercises</li>
								<li>
									<a href="#">Correct student's submits</a>
								</li>
								<li role="representation" class="divider"></li>
								<li role="representation" class="dropdown-header">Create course</li>
								<li>
									<a href="../../createcourse.php">Create a new course</a>
								</li>
							</ul>
						</li>
					<?php } else { ?>
						<!--Show the course_register-->
						<li>
							<a href="#" id="register-btn">
								<button class="btn btn-primary btn-sm">Register for this course</button>
							</a>
						</li>
					<?php } # get_role() 
						# Show normal menu for logged in users ?>
						<li>
							<div class="avatar">
								<?php if (!empty($user['avatar'])) { ?>
									<img src="../../<?php echo $user['avatar'];?>" alt="User avatar" ?>
								<?php } ?>
							</div>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $user['display_name']; ?></strong><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="../../course.php?username=<?php echo $user['username'];?>"><span class="glyphicon glyphicon-list"></span>My courses</a></li>
								<li><a href="../../profile.php?username=<?php echo $user['username'];?>"><span class="glyphicon glyphicon-user"></span>My profile</a></li>
								<li><a href="../../settings.php"><span class="glyphicon glyphicon-wrench"></span>Settings</a></li>
								<li><a href="../../signout.php"><span class="glyphicon glyphicon-off"></span>Sign out</a></li>
							</ul>
						</li>
				<?php } else {	?>
					<li><a href="../../signup.php">Sign up</a></li>
					<li><a href="../../signin.php">Sign in</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<!-- End of .navbar-->

<!-- Main content-->
<div class="container admin-panel">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<img src="../../<?php echo $course_data['course_avatar']; ?>" class="sidebar-logo">
			<ul class="nav nav-sidebar">
				<!-- Dynamically create active section based on what page we are in-->
				<?php if ($filename == 'index.php') {?>
				<li><a href="index.php" class="active"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<?php } else { ?>
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<?php }?>
				<?php if ($filename == 'lecture.php') {?>
				<li><a class="active" href="lecture.php"><span class="glyphicon glyphicon-film"></span>Video Lectures</a></li>
				<?php } else { ?>
				<li><a href="lecture.php"><span class="glyphicon glyphicon-film"></span>Video Lectures</a></li>
				<?php }?>
				<?php if ($filename == 'exercise.php') {?>
				<li><a class="active" href="exercise.php"><span class="glyphicon glyphicon-tasks"></span>Exercises</a></li>
				<?php } else { ?>
				<li><a href="exercise.php"><span class="glyphicon glyphicon-tasks"></span>Exercises</a></li>
				<?php }?>
				<li class="spacer"></li>
				<?php if ($filename == 'syllabus.php') {?>
				<li><a class="active" href="syllabus.php"><span class="glyphicon glyphicon-pencil"></span>Syllabus</a></li>
				<?php } else { ?>
				<li><a href="syllabus.php"><span class="glyphicon glyphicon-pencil"></span>Syllabus</a></li>
				<?php }?>
				<?php if ($filename == 'forum.php') {?>
				<li><a class="active" href="forum.php"><span class="glyphicon glyphicon-screenshot"></span>Discussion Forum</a></li>
				<?php } else { ?>
				<li><a href="forum.php"><span class="glyphicon glyphicon-screenshot"></span>Discussion Forum</a></li>
				<?php }?>
				<li class="spacer"></li>
				<?php if ($is_teacher && $is_owner): ?>
					<?php if ($filename == 'studentlist.php'): ?>
						<li><a class="active" href="studentlist.php"><span class="glyphicon glyphicon-list"></span>Student list</a></li>
					<?php else : ?>
						<li><a href="studentlist.php"><span class="glyphicon glyphicon-list"></span>Student list</a></li>
					<?php endif ?>
					<?php if ($filename == 'studentsubmit.php'): ?>
						<li><a class="active" href="studentsubmit.php"><span class="glyphicon glyphicon-circle-arrow-up"></span>Student submittals</a></li>
					<?php else : ?>
						<li><a href="studentsubmit.php"><span class="glyphicon glyphicon-circle-arrow-up"></span>Student submittals</a></li>
					<?php endif ?>
				<?php endif ?>
				<li class="spacer"></li>
				<?php if ($filename == 'about.php') {?>
				<li><a href="about.php"><span class="glyphicon glyphicon-user"></span>Course staff</a></li>
				<?php } else { ?>
				<li><a href="about.php"><span class="glyphicon glyphicon-user"></span>Course staff</a></li>
				<?php }?>
			</ul>
		</div> <!-- End of .sidebar-->

		<!-- Content for each page - depends on which page we are in-->
		<?php if ($filename == 'index.php'): ?>		
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-content">
			<div class="row announcement">
			<div class="col-lg-12 col-md-12" style="padding-left: 0; padding-right: 0;">
				<h2 class="page-header">Announcements</h2>
				<?php if ($is_owner): ?>
					<div class="pull-right">
						<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-flash"></span>Create new</a>
					</div>
				<?php endif ?>
			</div>
						<!-- Announcement holder-->
			<div class="col-lg-12 col-md-12" >
				<?php foreach ($annos as $anno) { ?>
					<div class="row">
						<?php if ($anno['anno_type'] == '1'): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<span class="panel-title"><strong><?php echo $anno['anno_title'] ?></strong></span>
									<span class="label label-default pull-right"><?php echo $anno['valid_from'] . ' - ' . $anno['valid_to']; ?></span>
								</div>
								<div class="panel-body">
									<?php echo $anno['anno_content']; ?>
								</div>
							</div>
						<?php endif ?>
						<?php if ($anno['anno_type'] == '2'): ?>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<span class="panel-title"><strong><?php echo $anno['anno_title'] ?></strong></span>
									<span class="label label-warning pull-right"><?php echo $anno['valid_from'] . ' - ' . $anno['valid_to']; ?></span>
								</div>
								<div class="panel-body">
									<?php echo $anno['anno_content']; ?>
								</div>
							</div>
						<?php endif ?>
						<?php if ($anno['anno_type'] == '3'): ?>
							<div class="panel panel-danger">
								<div class="panel-heading">
									<span class="panel-title"><strong><?php echo $anno['anno_title'] ?></strong></span>
									<span class="label label-danger pull-right"><?php echo $anno['valid_from'] . ' - ' . $anno['valid_to']; ?></span>
								</div>
								<div class="panel-body">
									<?php echo $anno['anno_content']; ?>
								</div>
							</div>
						<?php endif ?>
					</div>
				<?php } ?>
			</div>
			</div>
		</div>
		<?php endif ?>

		<!-- For lecture.php-->
		<?php if ($filename == 'lecture.php'): ?>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-content">
			<div class="row announcement">
				<div class="col-lg-12 col-md-12" style="padding-left: 0; padding-right: 0;">
					<h2 class="page-header">Video Lectures</h2>
					<?php if ($is_owner): ?>
					<div class="pull-right">
						<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-flash"></span>Create new</a>
					</div>
					<?php endif ?>
				</div>
							<!-- Announcement holder-->
				<div class="col-lg-12 col-md-12" >
					<!-- Video dialog-->
					<div class="modal fade" id="vid-modal">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <div class="modal-title">
					        		<h4 id="modal-title">Modal title</h4>
					        </div>
					      </div>
					      <div class="modal-body">
					        <div class="modal-video">
					        		<iframe src="" id="video-frame" sandbox="allow-same-origin allow-scripts allow-forms"></iframe>
					        </div>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- End video dialog-->
					<div class="panel-group" id="accordion"> 
					<?php 
					$v_units = $courses->get_distinct_unit($id);
					foreach ($v_units as $v_unit) { ?>
							<div class="panel-info">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collpase<?php echo $v_unit['unit_id'];?>">L<?php echo $v_unit['unit_id'] . ' - ' . $v_unit['unit_name']; ?></a>
									</h4>
								</div> <!-- End of .panel-heading-->
								<div id="collpase<?php echo $v_unit['unit_id'];?>" class="panel-collapse collapse in">
									<div class="panel-body">
										 <?php $v_vids = $courses->get_unit_video($v_unit['unit_id']); ?>
										 <?php foreach ($v_vids as $v_vid): ?>
										 	<a class="show-vid-modal" videosrc="<?php echo str_replace('watch?v=','embed/', $v_vid['vid_link']); ?>" videotitle="<?php echo $v_vid['vid_title']; ?>" href="#"><?php echo $v_vid['vid_title'] ?></a>
										 	<a href="#" class="pull-right slide"><span class="glyphicon glyphicon-list-alt"></span>Slides</a>
										 	<br>
									 <?php endforeach ?>
									</div> <!-- End of .panel-body -->
								</div> <!-- End of .panel-collapse -->
							</div> <!-- End of .panel-default-->
					<?php }?>
					</div> <!-- End of #accordion-->
				</div>
			</div>
		</div>
		<?php endif ?>		
		<!-- End lecture.php-->

		<!-- Exercise.php-->
		<?php if ($filename == 'exercise.php'): ?>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-content">
			<div class="row announcement">
				<div class="col-lg-12 col-md-12" style="padding-left: 0; padding-right: 0;">
					<h2 class="page-header">Course Exercises</h2>
					<select class="selectpicker" name="ex_filter" id="ex_filter">
						<option>All</option>
						<?php $v_units = $courses->get_distinct_unit($id); ?>
						<?php foreach ($v_units as $v_unit): ?>
							<option>L<?php echo $v_unit['unit_id'] . ' - ' . $v_unit['unit_name'];?></option>
						<?php endforeach ?>
					</select>
					<?php if ($is_owner): ?>
					<!-- <div class="pull-right">
						<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-flash"></span>Create new</a>
					</div> -->
					<?php endif ?>
				</div>
							<!-- Announcement holder-->
				<div class="col-lg-12 col-md-12" >
					<?php foreach ($variable as $key => $value): ?>
						
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<?php endif ?>
		<!-- End of exercise.php-->
	</div>
</div>
<!-- End .main content -->
<!-- Javascript-->
<script type="text/javascript">
 $(document).ready(function(e) {
     $('.selectpicker').selectpicker();
 });
</script>
<script>
	$('a.show-vid-modal').click(function(e) { 
	 var vidsrc = $(this).attr('videosrc');
     var title = $(this).attr('videotitle');

	 e.preventDefault();

	 var options = {
	   "backdrop" : "static"
	 }

	$("#vid-modal").on('shown.bs.modal', function(e) {
	    //here the attribute video-src is helpfull
	     $("h4#modal-title").text(title);
	    // //here the id for the iframe is helpfull
	     $('#video-frame').attr('src', vidsrc);
	  });

	$("#vid-modal").on('hide.bs.modal', function(e) {
	    // //here the id for the iframe is helpfull
	     $('#video-frame').attr('src', '');
	  });

    $("#vid-modal").modal(options);

});
// Debug
// $('a.show-vid-modal').click(function(e) {
// 	e.preventDefault();
// 	alert($('a.show-vid-modal').text());
// });
</script>
</body>
</html>