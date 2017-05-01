<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					
	<h3>Proposal Details</h3>

	  <div class="row">
			<div class="col-sm-2">Proposal Price</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $ProposalDetails['Proposal']['price']; ?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Answers</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><ul><?php 
			$answer=explode("$$$" ,$ProposalDetails['Proposal']['answers']); 
			$questions=$this->My->getJobQuestions($ProposalDetails['Proposal']['job_id']);
			$i=0;
			$j=1;
			foreach($answer as $ans) {
				echo "<b>".$j."- ".$questions[$i]."</b>";
				echo "<li ><b>Answer:</b>".$ans."</li>";
				$i++;
				$j++;
			}
			?></ul></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Date</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php  
					$timestamp=strtotime($ProposalDetails['Proposal']['created']); 
					echo date('Y-m-d h:i:s A', $timestamp);
			?></div>	
	</div>
	<div class="row">
			<div class="col-sm-2">Proposal Description</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8"><?php echo $ProposalDetails['Proposal']['proposal']; ?></div>	
	</div>
	
	
	
	</div>
  </div>
 </div>