<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					
	<h3>Job Details</h3>

	  <div class="row">
			<div class="col-sm-2">Job Title</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $JobDetails['Job']['job_title']; ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Job Description</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $JobDetails['Job']['job_description']; ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Operating System</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php   if($JobDetails['Job']['operating_system']==1){echo "Windows";} else if($JobDetails['Job']['operating_system']==2) {echo "Mac";} else { echo "Linux";} ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Project Type</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php if($JobDetails['Job']['projectType']==1) {echo "On Going"; } else if($JobDetails['Job']['projectType']==2) { echo "One time"; } else {echo "Not Sure";} ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Category</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $this->My->getCategoryName($JobDetails['Job']['category']); ?> >> <?php echo $this->My->getSubCategoryName($JobDetails['Job']['sub_category']); ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Required freelancer</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php  if($JobDetails['Job']['requiredfreelancer']==1){echo "One";} else {echo $JobDetails['Job']['freelancer_count'];} ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Skill needed</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php 
			$skillList=$this->My->getSkill($JobDetails['Job']['skillneeded']);
		
			foreach($skillList as $skill) {
			echo "<div>".$skill['Skill']['skill_name']."</div>";
			}
			
			?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Where are you in life cycle</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php if($JobDetails['Job']['where_are_you_in_life_cycle']==1){ echo "I have Design";} else if($JobDetails['Job']['where_are_you_in_life_cycle']==2){ echo "I have specification";} else if($JobDetails['Job']['where_are_you_in_life_cycle']==3){ echo "N/A"; } else if($JobDetails['Job']['where_are_you_in_life_cycle']==4) { echo "I have an idea"; } ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Pay type</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php if($JobDetails['Job']['paytype']==1){ echo "Hourly"; } else { echo "Fixed(".$JobDetails['Job']['paytype'].")"; } ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Experience level</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php if($JobDetails['Job']['exp_level']==1){ echo "Entry Level";} else if($JobDetails['Job']['exp_level']==2) { echo "Intermidiate";} else { echo "Expert"; } ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Job finish time last(How long user expect this job to last?)</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php 
			if($JobDetails['Job']['job_finish_time_last']==1) {
				echo "More than 6 months";
			} else if($JobDetails['Job']['job_finish_time_last']==2) {
				echo "3 to 6 months";
			} else if($JobDetails['Job']['job_finish_time_last']==3) {
				echo "1 to 3 months";
			} else if($JobDetails['Job']['job_finish_time_last']==4) {
				echo "Less than 1 month";
			} else if($JobDetails['Job']['job_finish_time_last']==5) {
				echo "More than 6 months";
			} 
				
			?></div>	
	</div>
	<div><h2>Job Prefrence</h2></div>
	<div class="row">
			<div class="col-sm-2">Job view settings</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"> 
			<?php 
			if($JobDetails['Job']['job_view_settings']==1){
				echo "Public search";
			} else if($JobDetails['Job']['job_view_settings']==2){
				echo "Only website users";
			} if($JobDetails['Job']['job_view_settings']==3){
				echo "Invited users";
			}
			
			?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Project questions</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><div class="question_div">
			<?php
					$job_question=explode("$$$",$JobDetails['Job']['project_questions']);
					foreach($job_question as $jobQuest){ ?>
					<li><?php echo $jobQuest; ?></li>
						
				<?php	} ?>
			</div></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Freelancer Type</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php 
			if($JobDetails['Job']['Freelancer_Type']==1){
				echo "Independent - work with your freelancer directly";
			} else if($JobDetails['Job']['Freelancer_Type']==2) {
				echo "Agency - work through an agency that manages freelancers and jobs";
			} else {
				echo "N/A";
			}
			
			?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Rising Talent</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $JobDetails['Job']['Rising_Talent']; ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Hours Billed on site</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php 
			
			if($JobDetails['Job']['Hours_Billed_on_site']==1){
				echo "Atleast 1 hour";
			} else if($JobDetails['Job']['Hours_Billed_on_site']==2) {
				echo "Atleast 100 hour";
			} else if($JobDetails['Job']['Hours_Billed_on_site']==3) {
				echo "Atleast 500 hour";
			} else if($JobDetails['Job']['Hours_Billed_on_site']==4) {
				echo "Atleast 1000 hour";
			}
			
			?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Location Required</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $this->My->fetchCountryName($JobDetails['Job']['Location_required']); ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">English Level</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php 
			
			if($JobDetails['Job']['English_Level']==1){
				echo "Basic";
			} else if($JobDetails['Job']['English_Level']==2) {
				echo "Convenstional";
			} else if($JobDetails['Job']['English_Level']==3) {
				echo "Fluent";
			} else if($JobDetails['Job']['English_Level']==4) {
				echo "Native";
			}

			?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Job Group</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $JobDetails['Job']['job_Group']; ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Job status</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $JobDetails['Job']['job_status']; ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Created</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $JobDetails['Job']['created']; ?></div>	
	</div>
	</div>
  </div>
 </div>