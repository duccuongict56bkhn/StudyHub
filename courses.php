<?php 
    require 'core/init.php';
	require 'navbar.php';
 ?>
<div class="container" style="margin-top: -6px;">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><strong>Search for courses</strong></h4>
			<form method="post" action="" role="form" id="course-search-form">
				<div class="input-group">
			      <input type="text" class="form-control" name="keyword" placeholder="Enter a keyword here">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-search"></span></button>
			      </span>
			    </div>
			</form>
		</div>
	</div>
	<div class="col-md-4 catagories">
		<div class="nav-container">
			<ul class="nav-sidebarlist">
				<li class="emphasize">All topics</li>
				<?php 
				$cats = $courses->get_all_course_by_cat();

				foreach ($cats as $cat) { ?>
					<li><a href="#"><?php echo $cat['title'];?></a><span class="badge pull-right"><?php echo $cat['count']; ?>  </span></li>
				<?php }?>
			</ul>
		</div>
	</div>

	<div class="col-md-8 course-list">
		<div class="col-md-9 course-list-header">
			<div class="list-header">
				<!-- <p style="display: block; font-size: 12px;">Browsing</p> -->
				<?php 
				if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
					$keyword = $_POST['keyword'];
					if (strlen($keyword) > 16) { ?>
						<h2>Search results for &ldquo;<?php echo substr($keyword, 0, 15) . '...'; ?>&rdquo;</h2>
					<?php } else {?>
					<h2>Search results for &ldquo;<?php echo $keyword; ?>&rdquo;</h2>
				<?php } } else { ?>
					<h2>All topics</h2>
				<?php } ?>
			</div>
		</div>
		<div class="col-md-9 line-separator">
		</div>

		<div class="course-wrapper">
			<?php $v_courses = $courses->get_all_courses(); 
			foreach ($v_courses as $v_course) { ?>
			<div class="row">
				<div class="col-md-9 entry">
					<div class="entry-wrap">
						<div class="entry-thumbnail">
							<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>" title="Link to <?php echo $v_course['course_title']; ?>"></a>
							<img src="<?php echo $v_course['course_avatar'];?>">
						</div> <!-- end .entry-thumbnail-->
						<div class="entry-meta">
							<span class="school-name"><?php echo $v_course['school']; ?></span>
							<h2 class="course-title">
								<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>" title="Link to <?php echo $v_course['course_title']; ?>">
									<span><?php echo $v_course['course_title']; ?></span>
								</a>
							</h2>
							<div class="course-progress">
								<?php if ($v_course['course_type'] == 1) { ?>
									<span class="self-study">Self-study</span><br>
									<div class="go-to-course">
										<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>"><span>Course info</span></a> 
										<div class="pull-right">
											<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>" class="btn btn-success">Go to class</a>
										</div>										
									</div>
								
								<?php } else { ?>
									<?php $end_date = $v_course['start_date'] + $v_course['length']; ?>
									<span><?php echo date('M tS', strtotime($v_course['start_date'])); ?></span>
									<span class="pull-right"><?php echo date('M tS', strtotime($end_date)); ?></span>
									<div class="progress" style="height: 8px;">
									  <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
									    <span class="sr-only">40% Complete (success)</span>
									  </div>
									</div>
									<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>"><span>Course info</span></a> 
									<div class="pull-right">
										<?php if (($user['role'] == 'Teacher') && ($courses->is_created_by_me($user_id, $v_course['course_id']))): var_dump($courses->is_created_by_me($user_id, $v_course['course_id']));?>
											<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>" class="btn btn-warning">Edit</a>	
										<?php endif ?>
										<a href="courses/<?php echo $v_course['course_alias'] . '/' ;?>" class="btn btn-success">Go to class</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
</div>
</div>
<!-- ./Body -->

<?php 
	require_once 'footer.php';
 ?>