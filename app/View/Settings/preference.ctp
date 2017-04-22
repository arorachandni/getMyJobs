<div class="rightCon">
     <div class="innerContainer">
     	<div class="topMainHd">
        <?php echo $this->Session->flash();?>
        	<div class="mainHd2">
            	<h1>Settings</h1>
                <span>Change your privacy settings</span>
            </div>
    <!-- Call to element for Setting Navigation --   -->
    <?php echo $this->element('frontend/setting_navigation');?>

            <div class="clearfix"></div>
        </div>
        <?php echo $this->Form->create("User"); ?>
        	<div class="preferenceBx">
            	
                
               <!--  <div class="preBox">
                	<h2>Show Online Status</h2>           
                    <?php $online=array('1'=>'Online', '2'=>'Offline');
                    $attributes=array('label'=>array('class'=>'prebx'),'div' => false, 'separator' => '','legend'=>false);
                    echo $this->Form->radio('User.online_status',$online, $attributes);?>

                </div> -->
                
                <div class="preBox">
                	<h2>Show In Public Searches</h2>
                    <?php $options=array('1'=>'Yes', '2'=>'No');
                    $attributes=array('label'=>array('class'=>'prebx'),'div' => false, 'separator' => '','legend'=>false);
                    echo $this->Form->radio('User.public_search_status',$options, $attributes);?>
                    
                </div>
                <div class="preBox bdr1">
                    <h2>Users View</h2>           
                    <?php $options=array('0'=>'All', '1'=>'Male', '2'=> 'Female');
                    $attributes=array('label'=>array('class'=>'prebx'),'div' => false, 'separator' => '','legend'=>false);
                    echo $this->Form->radio('User.user_view',$options, $attributes);?>

                </div>
                <?php echo $this->Form->submit('Submit', array('div'=>false, 'label'=>false, 'class'=>'btns pref'));?>
            </div>
        <?php echo $this->Form->end();?>
     </div>
</div>