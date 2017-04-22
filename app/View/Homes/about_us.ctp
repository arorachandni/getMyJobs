
    <div class="topHeadingAbout">About Meetscape</div>

    <div class="aboutus">
    	<div class="container">
        <div class="aboutCompany">
            <h1><?php echo $result['CmsPage']['title1']; ?></h1>
            
        </div> 
        <div class="about">
            <div class="aboutLeft"><?php echo $this->Html->image("cms/".$result['CmsPage']['image1'], array('fullBase' => true,'alt' => '')); ?> </div>

            <div class="aboutRight liststyle"><?php echo $result['CmsPage']['description1']; ?>
            </div>
            <div class="clearfix"></div>
        </div>
            
        </div>
    </div>

    <div class="ourVission liststyle">
        	<h1><?php echo $result['CmsPage']['title2']; ?></h1>
            <p><?php echo $result['CmsPage']['description2']; ?></p>
        </div>

   <!--  <div class="ourmison">
        	<h1><?php echo $result['CmsPage']['title3']; ?></h1>
            <p><?php echo $result['CmsPage']['description3']; ?></p>
        </div>
     
     <div class="aboutus jon">
    	<div class="container">
         
        <div class="about about2">
            <div class="aboutLeft"><?php echo $this->Html->image("cms/".$result['CmsPage']['image2'], array('fullBase' => true,'alt' => '')); ?>
             </div>
            <div class="aboutRight"><?php echo $result['CmsPage']['description4'];?>
            </div>
            <div class="clearfix"></div>
        </div>
            
        </div>
    </div> -->
   
</div>