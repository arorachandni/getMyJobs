<div class="blackOverLay open2"></div>
<div class="resetPassword open">
        <?= $this->Session->flash();?>
	<div class="inerReset">
        <?= $this->Html->image("frontend/expired.jpeg", array("alt" => "",'class'=>'loginHd','width' => "100px" , 'height' => "100px")); ?>

        <p>The page you requested was created using information you submitted in a form. This page is no longer available. As a security precaution, Browser does not automatically resubmit your information for you. </p>

    </div>
</div>