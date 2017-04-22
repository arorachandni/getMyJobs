


<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>Job Details</h3>

	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>
		
		
		<div class="row">
		<div class="col-50">abc</div>
		<div class="col-50">abc</div>
		</div>
		
	<div class="dashfrmBx">
	<fieldset>
		
		
		<div class="fielddiv">
			<span class="titleStart">Job Title :</span>
			<strong><?php echo $JobDetails['Job']['job_title']; ?></strong>
		</div><br />
		
		<div class="fielddiv">
			<span class="titleStart">Job Description :</span>
			<strong><?php echo $JobDetails['Job']['job_description']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Operating System :</span>
			<strong><?php   if($JobDetails['Job']['operating_system']==1){echo "Windows";} else if($JobDetails['Job']['operating_system']==2) {echo "Mac";} else { echo "Linux";} ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Project Type :</span>
			<strong><?php if($JobDetails['Job']['projectType']==1) {echo "Hourly"; } else {echo "Fixed Price";} ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Software frameworks :</span>
			<strong><?php echo $JobDetails['Job']['software_frameworks']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Category :</span>
			<strong><?php echo $this->My->getCategoryName($JobDetails['Job']['category']); ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Sub category :</span>
			<strong><?php echo $this->My->getSubCategoryName($JobDetails['Job']['sub_category']); ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Required freelancer :</span>
			<strong><?php  if($JobDetails['Job']['requiredfreelancer']==1){echo "One";} else {echo "More then one";} ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Skill needed :</span>
			<strong><?php $this->My->getSkill($JobDetails['Job']['skillneeded']); ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Where are you in life cycle:</span>
			<strong><?php echo $JobDetails['Job']['where_are_you_in_life_cycle']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Type of project :</span>
			<strong><?php echo $JobDetails['Job']['typeofproject']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Pay type :</span>
			<strong><?php echo $JobDetails['Job']['paytype']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Experience level :</span>
			<strong><?php echo $JobDetails['Job']['exp_level']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Job finish time last :</span>
			<strong><?php echo $JobDetails['Job']['job_finish_time_last']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Optional skills :</span>
			<strong><?php echo $JobDetails['Job']['optional_skills']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Time commitment requirement :</span>
			<strong><?php echo $JobDetails['Job']['time_commitment_requirement']; ?></strong>
		</div><br />
		
		<div><h2>Job Prefrence</h2></div>
		<div class="fielddiv">
			<span class="titleStart">Job view settings :</span>
			<strong><?php echo $JobDetails['Job']['job_view_settings']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Project questions :</span>
			<div class="question_div">
			<?php
					$job_question=explode("$$$",$JobDetails['Job']['project_questions']);
					foreach($job_question as $jobQuest){ ?>
					<li><?php echo $jobQuest; ?></li>
						
				<?php	} ?>
			</div>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Freelancer Type :</span>
			<strong><?php echo $JobDetails['Job']['Freelancer_Type']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Rising Talent :</span>
			<strong><?php echo $JobDetails['Job']['Rising_Talent']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Hours Billed on site :</span>
			<strong><?php echo $JobDetails['Job']['Hours_Billed_on_site']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Location Required :</span>
			<strong><?php echo $JobDetails['Job']['Location_required']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Freelancer Type :</span>
			<strong><?php echo $JobDetails['Job']['Freelancer_Type']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">English Level :</span>
			<strong><?php echo $JobDetails['Job']['English_Level']; ?></strong>
		</div><br />
		
		<div><h2>Job Group</h2></div>
		<div class="fielddiv">
			<span class="titleStart">Job Group :</span>
			<strong><?php echo $JobDetails['Job']['job_Group']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Job status:</span>
			<strong><?php echo $JobDetails['Job']['job_status']; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Created :</span>
			<strong><?php echo $JobDetails['Job']['created']; ?></strong>
		</div><br />
		<div class="clear"></div>
       
		
		<div class="clear"></div>
		<div class="clear"></div>
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>