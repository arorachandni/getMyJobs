<?php
    $protocol = 'http';
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
		$protocol = 'https';
        define('PAGING_SIZE', '20');
    if($_SERVER['HTTP_HOST']=='localhost'){
	    define('SITE_PATH', $protocol.'://localhost/getMyJobs/');
	}else if(($_SERVER['HTTP_HOST']=='flexsin.org')||($_SERVER['HTTP_HOST']=='www.flexsin.org')){
	    define('SITE_PATH', $protocol.'://flexsin.org/lab/mobilewebservice/cakephp/');
	}else{
	    define('SITE_PATH', $protocol.'://orber.com/');
	}
		define('ADMIN_EMAIL', 'info@orber.com');
		
		define('EMAIL_ADMIN_FROM', 'orber <support@orber.com>');
		define('ALLOWED_IMAGE_TYPES', serialize(array('image/jpeg', 'image/pjpeg', 'image/png','image/gif')));
		define('ALLOWED_DOCUMENT_TYPES', serialize(array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/txt', 'text/plain', 'image/doc', 'image/docs'))); 
		
		
	// define('TWILLIO_SID', 'AC078a80668b676cd52c1acae5940c4e5d');
	// define('TWILLIO_TOKEN', '83d45129bb8de82428583417d087fd9e');  
	// define('TWILLIO_FROM_PHONE_NUMBER','+14842224411'); 
	
	/*Running*/
	// // define('TWILLIO_SID', 'AC1526503156555c39188f221e72e5253c'); 
	// // define('TWILLIO_TOKEN', '57cac81829b6420967941adb3666d0c9');  
	// // define('TWILLIO_FROM_PHONE_NUMBER','+14093163097');
	
	define('TWILLIO_SID', 'AC01d0104a5f9f66cf53d69e5f6cce3137'); 
	define('TWILLIO_TOKEN', '20412363804cf00ed06b903d7418a82d');  
	define('TWILLIO_FROM_PHONE_NUMBER','+14842224411');
?>  