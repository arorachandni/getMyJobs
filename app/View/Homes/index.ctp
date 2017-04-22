<script type="text/javascript">	
	var ajaxUrl = '<?php echo SITE_PATH; ?>';
	$(document).ready(function(){
		$("#UserIndexForm").validationEngine();	
        //$("#loginForm").validationEngine();

        var checkState = '';
        checkState = '<?php echo $state; ?>';
        if(checkState.trim() == "login")
        {   
           $(".loginPop").addClass("open");
            $(".blackOverLay").addClass("open2");
            setTimeout(function(){ $("body").css("overflow" , "hidden"); }, 200);
        }
        
	});	

function showPage(pagename)
    {
       var login_url = "<?php echo SITE_PATH;?>homes/"+pagename;
       window.parent.location=login_url;
    }   

</script>
    <div class="bannerCon">
        <div class="bannerImg parallax" data-velocity="-.2" data-fit="0"></div>
        <div class="bannerTxt wow fadeInDown"  data-wow-delay="0.3s">
            <h1>Join The Fun</h1>
            <p>Meetscape is great for making friends,  chatting, sharing interests and dating !</p>
        </div>
        <div class="bannerForm wow fadeInDown" data-wow-delay="0.4s"> 
		
        <?php echo $this->Session->flash();?>
		
        <?php echo $this->Html->link(
						$this->Html->image("frontend/facebookicon.png", array("alt" => "Facebook Icon")).'<strong>Sign in with Facebook</strong>',
						"javascript:void(0)",array('class' => 'facebookBtn','escape' => false, 'onclick'=>"showPage('facebook_login_user')")); ?>
        	
            <h2>First Time On Meetscape</h2>
			<?php echo $this->Form->create('User', array('class'=>'bannerForms','url'=>array('controller' => 'homes', 'action' => 'register'))); ?>
                <ul>
                   <!--  <li>
                        <label>First Name</label>
                        <div class="inputBox">
							<?php echo $this->Form->input('first_name',array('class'=>'srchInput validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false)); ?>
                            
                        </div>
                    </li>
					<li>
                        <label>Last Name</label>
                        <div class="inputBox">
                            <?php echo $this->Form->input('last_name',array('class'=>'srchInput validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false)); ?>
                            
                        </div>
                    </li> -->
                    <li>
                        <label>Name</label>
                        <div class="inputBox">
                            <?php echo $this->Form->input('name',array('class'=>'srchInput validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false)); ?>
                            
                        </div>
                    </li>
                     <li>
                        <label>Gender</label>
						<div class="inputBox">
							
                            <label class="radio" for="radio1"><span class="selectionBox off">
                            <input type="radio" id="radio1" name="data[UserDetail][gender]" value="1" checked>
                            </span>Male</label>
                            <label class="radio" for="radio2"><span class="selectionBox">
                            <input type="radio" id="radio2" name="data[UserDetail][gender]" value="2">
                            </span>Female</label>
							
							 <!-- <?php $options=array('M'=>'Male', 'F'=>'Female');
							$attributes=array('label'=>array('class'=>'radio'),'class'=>'radio', 'div' => false, 'separator' => '','legend'=>false,'span'=>array('class'=>'selectionBox'));
							echo $this->Form->radio('gender',$options, $attributes);?> -->
						</div>
                     
                       
                    </li> 
                    <li>
                        <label>Birthday</label>
                        <div class="inputBox">
                            <div class="day">
                                <div class="selctFormBox">
                                    <?php echo $this->Form->input('days',array('class'=>'selectInput srchInput validate[required]', 'div' => false, 'label'=> false, 'placeholder' => 'day', 'readonly' => true)); ?>
                                    <?php echo $this->Form->day('UserDetail.day', array('class' => 'select','div' => false, 'label' => false,'required'=>false, 'error'=>false));?>
                      
                                </div>
                            </div>
                            <div class="month">
                                <div class="selctFormBox">
                                    <!-- <input type="text" value="Month" readonly class="selectInput srchInput">
                                    <select class="select validate[required]" name="data['UserDetail']['month']">
                                       
                                        <?php for($month = 1; $month<=12;$month++){

                                            ?>
                                            <option value="<?php if($month < 10) { echo '0'.$month; } else { echo $month; }?>"><?php echo $month;?></option>
                                        <?php } ?>
                                       
                                    </select> -->
                                    <?php echo $this->Form->input('months',array('class'=>'selectInput srchInput validate[required]', 'div' => false, 'label'=> false, 'placeholder' => 'Month', 'readonly' => true)); 
                                     echo $this->Form->month('UserDetail.month', array('class' => 'select','div' => false, 'label' => false, 'required'=>false, 'error'=>false)); ?>
                                </div>
                            </div>
                            <div class="year">
                                <div class="selctFormBox">
                                    <?php $maxYear = date('Y') - 18;
                                        $minYear = $maxYear - 60;?>
                                    <?php echo $this->Form->input('years',array('class'=>'selectInput srchInput  validate[required]', 'div' => false, 'label'=> false, 'placeholder' => 'Year', 'readonly' => true)); ?>
                                    <?php echo $this->Form->year('UserDetail.year', $minYear , $maxYear, array('class' => 'select','div' => false, 'label' => false, 'required'=>false, 'error'=>false)); ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    
                    <li>
                        <label>Email</label>
                        <div class="inputBox">
                           <?php echo $this->Form->input('email', array('class'=>'srchInput validate[required,custom[email]]', 'div' => false, 'label'=> false, 'error' =>false, 'required'=> false)); ?>
                        </div>
                    </li>
					<li>
                        <label>Password</label>
                        <div class="inputBox">
							<?php echo $this->Form->input('password',array('class'=>'srchInput validate[required, minSize[8]]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false)); ?>
                            
                        </div>
                    </li>
					<li>
                        <label>Confirm Password</label>
                        <div class="inputBox">
							<?php echo $this->Form->input('confirm_password',array('type'=>'password','class'=>'srchInput validate[required,equals[UserPassword], minSize[8]]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false)); ?>
                            
                        </div>
                    </li>
                    <li>
                        <label>Mobile</label>
                        <div class="inputBox">
                           <?php echo $this->Form->input('mobile_number', array('class'=>'srchInput validate[required,custom[phone]]', 'div' => false, 'label'=> false, 'error' =>false, 'required'=> false)); ?>
                        </div>
                    </li>
                    <li class="submitBtns">
						<?php echo $this->Form->input('SIGN UP FREE!', array('type'=>'submit', 'class'=> 'submitBts', 'div' => false, 'label'=> false)); ?>
                        
                    </li>
                </ul>
                <p>By continuing, you're confirming that you've read and agree  to our <?php echo $this->Html->link('Terms and Conditions',array('controller' => 'homes', 'action'=> 'terms_conditions'),array('escape' => false)); ?>, <?php echo $this->Html->link('Privacy',array('controller' => 'homes', 'action'=> 'privacy_policy'),array('escape' => false)); ?></p>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="meetscapeHd">Come Be A Part of Meetscape's Fun Community</div>
    <div class="aboutCon">
    	<div class="container">
        	<div class="aboutImage wow slideInLeft" data-wow-delay="0.2s"><?php echo $this->Html->image("frontend/aboutleft.png", array("alt" => ""));	?></div>
            <div class="aboutText wow slideInRight" data-wow-delay="0.3s">
            	<h2><?php echo $homeAbout['CmsPage']['title1']; ?></h2>
                <?php echo $homeAbout['CmsPage']['description1']; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="meetPeople">
    <div class="meetpeop parallax" data-velocity="-.2" data-fit="200"></div>
    	<div class="container" style="position:relative">
        	<div class="meetText wow fadeInUp" data-wow-delay=".6s">
                <strong>Meet people </strong>
                <h1>around you!</h1>
                <h2>Download the APP!</h2>
				<?php echo $this->Html->link($this->Html->image("frontend/appStore.png", array("alt" => "")),"#",array('escape' => false)); ?>
                <?php echo $this->Html->link($this->Html->image("frontend/googlePlay.png", array("alt" => "")),"#",array('escape' => false)); ?>
                
            </div>	
        </div>
    </div>
    
    <div class="newPeople">
    	<div class="peopleHd">The Best Place to meet New People</div>
        <a class="joinUs" href="javascipt:void(0)">Join us today free!</a>
    	<div class="peopleCon">
            <?php $countUser = count($userImage);
             foreach($userImage as $user) { ?>
            
        	<div class="peopleBx"> 
            <?php 
            $imagePath='../img/frontend/profileImage/'.$user['UserDetail']['image'];
                    echo $this->Image->resize($imagePath, 150, 150,$options);
            ?></div>
            <?php } 
            if($countUser < 10) {?>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                <div class="peopleBx"> 
                <?php $imagePath='../img/frontend/default.png';
                     echo $this->Image->resize($imagePath, 150, 150); 
                ?>
                </div>
                
                
            <?php } ?>
            
            
        </div>
        <div class="clearfix"></div>
    </div>
   
