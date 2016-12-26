
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Academic Records</a></li>
    <li><a href="#tabs-2">Check Graduation Eligibility</a></li>
  </ul>
  <div id="tabs-1">

		  	<?php 
			  		echo message();
			?>
  	<div class="academic-info">
  		<table class="info-table">
			<tr>
				<td class="caption"><p>Faculty Name:</p></td>
				<td><p> <?php echo $student["faculty"] ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Course Name:</p></td>
				<td><p> <?php echo get_courseName($student["course_code"],$conn)?></p></td>
			</tr>
		</table>
		<table class="info-table">
			<tr>
				<td class="caption"><p>CGPA:</p></td>
				<td><p> <?php echo $student["cgpa"] ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Student Status:</p></td>
				<td><p> <?php echo $student["status"] ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Earned Credit Hours:</p></td>
				<td><p> <?php echo (($passed_credits) ? $passed_credits : "0") ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Remaining Credit Hours:</p></td>
				<td><p> <?php echo (($remaining_credits) ? $remaining_credits : "0") ?></p></td>
			</tr>
		</table>
  	</div>
  	<?php if (mysqli_num_rows($registered_subjects) === 0): ?>
	  		<div class="message"><p>No subject taken.</p></div>
	 <?php else: ?>
  	<p class="table-title">Passed Subjects: </p>
    <table class="subjects-table">
					<thead>
						<tr>
						  <th class="th-subject-name">Subject Name</th>
						  <th class="th-course-code">Subject Code</th>
						  <th class="th-credit-hours">Credit Hours</th>
						  <th class="th-mark">Grade</th>
					</thead>
					<tbody>
						<?php foreach ($registered_subjects as $subject): ?>
							<tr>
								  <td><p><?php echo $subject["subject_name"] ?></p></td>
								  <td><p><?php echo $subject["subject_code"] ?></p></td>
								  <td><p><?php echo $subject["credit_hours"] ?></p></td>
								  <td><p><?php echo mark_to_grade($subject["mark"]) ?></p></td>
							</tr>	
		  				<?php endforeach ?>
					</tbody>			
			</table>
	  <?php endif ?>
	  <form action="view_student_profile.php?id=<?php echo $student["student_id"] ?>" method="POST">
	  </form>

  </div>
  <!--  add subject -->
  <div id="tabs-2">
  		<br>
  		<?php if ($student["status"] === "Eligible for Graduation"): ?>
  			<p class="table-title"> You are eligible to graduate.</p>
  			<p class="table-title"> You can now apply for graduation</p>
  			<form action="student_academic_records.php?id=<?php echo $student["student_id"] ?>" method="POST">
	  					<input type="submit" name="apply" value="Apply For Graduation" />
	 		</form>
  		<?php elseif ($student["status"] === "Active"): ?>
  			<p class="table-title">You are not eligible to graduate.</p>
  		<?php elseif ($student["status"] === "Applied for Graduation"): ?>
  			<p class="table-title"> You have applied for graduation.</p>
  			<script type="text/javascript">$( "#tabs" ).tabs({ active: 1 });</script>
  			<p class="table-title"> Your graduation will be examined by graduation community and your status will change soon. </p>
  		<?php elseif ($student["status"] === "Graduated"): ?>
  			<p class="table-title"> Congratulations, You can now apply for convocation.</p>
  		<?php endif ?>
  		<br><br>
  		<?php if (mysqli_num_rows($failed_subjects) !== 0): ?>
	  		<p class="table-title">You need to acheive grade of C or higher for following subjects: </p>
			  	<table class="subjects-table">
						<thead>
							<tr>
							  <th class="th-subject-name">Subject Name</th>
							  <th class="th-course-code">Subject Code</th>
							  <th class="th-credit-hours">Credit Hours</th>
							  <th class="th-mark">Grade</th>
						</tr>
						</thead>
						<tbody>
							<?php foreach ($failed_subjects as $subject): ?>
								<tr>
									  <td><p><?php echo $subject["subject_name"] ?></p></td>
									  <td><p><?php echo $subject["subject_code"] ?></p></td>
									  <td><p><?php echo $subject["credit_hours"] ?></p></td>
									  <td><p><?php echo mark_to_grade($subject["mark"]) ?></p></td>
								</tr>	
			  				<?php endforeach ?>
						</tbody>			
				</table>
				<br><br>
  		<?php endif ?>
  		<?php if (mysqli_num_rows($remaining_subjects) !== 0): ?>
			<p class="table-title">You need to pass the following subjects: </p>
		  	<table class="subjects-table">
					<thead>
						<tr>
						  <th class="th-subject-name">Subject Name</th>
						  <th class="th-course-code">Subject Code</th>
						  <th class="th-credit-hours">Credit Hours</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($remaining_subjects as $subject): ?>
							<tr>
								  <td><p><?php echo $subject["subject_name"] ?></p></td>
								  <td><p><?php echo $subject["subject_code"] ?></p></td>
								  <td><p><?php echo $subject["credit_hours"] ?></p></td>
							</tr>	
		  				<?php endforeach ?>
					</tbody>			
			</table>
		<?php endif ?>
  </div>
</div>
<script type="text/javascript">$( "#tabs" ).tabs({ });</script>

 

