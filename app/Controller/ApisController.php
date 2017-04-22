<?php
header('Access-Control-Allow-Origin: *');
App::uses('AppController', 'Controller'); 
App::import('Vendor', 'messages');


class ApisController extends AppController {

	public $name = 'Apis';
	public $components = array('Session','Cookie','Auth','Api','Resize');
	function beforeFilter() {
		parent::beforeFilter();
		if (!empty($this->Auth))
			$this->Auth->allowedActions = array('login','register','getCategories','getSubCategories','postJob','getSkil');
			$this->key = 'cd521716c97d34c793e5d17ab58007c5';
		//$this->Security->csrfCheck = false;
	}
	/* 
	 *Login function for app
	*/
	
	function login(){
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			$this->loadModel('User');
			$error = '';
			
			if(empty($this->data['username'])){
				$error='Username should not blank.';
			}else if(empty($this->data['password'])){
				$error='Please enter password.';
			} else  { 
				
				$password=$this->Auth->password($this->data['password']);
				$usersList = $this->User->find("all", array(
					'fields' => array('User.id', 'User.username','User.firstname','User.email'),
					'conditions' => array('User.password' => $password,'OR'=>array('User.username' => $this->data['username'],'User.email' => $this->data['username'])
					)
				));
				if(!empty($usersList)){
					$token = $this->Api->generateToken(40);
					$result['User']['id'] = $usersList[0]['User']['id'];
					$result['User']['token'] = $token;
					$this->User->save($result, false);
					echo json_encode(array('error_code'=> 0,'status'=> 1, 'data'=> $usersList[0]['User'],'token'=>$token)); exit;
				}else{
					$error='Invalid username or password';
				}
			}
		}else{
			$error='Request data is required';
		}
		if(!empty($error)){
			echo json_encode(array('error_code'=> 1,'status'=> 0, 'message'=> $error)); exit;
		}
	}
	
	/* 
	 *Registration function for app
	 *Created by Kamlesh on 26 July
	*/
	
	function register(){
		
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			if(empty($this->data['username'])){
				$error='Please enter username .';
			} else if(!empty($this->Api->checkExitsUser($this->data['username']))){
				  $error='Username already exist';
			} else if(empty($this->data['firstname'])){
				$error='Please enter first name.';
			} else if(empty($this->data['lastname'])){
				$error='Please enter last name.';
			} else if(empty($this->data['email'])){
				$error='Please enter email.';
			} else if(!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)){
				$error='Please enter valid email.';
			} else if(!empty($this->Api->checkExitsEmail($this->data['email']))){
				  $error='Email already exist';
			} else if(empty($this->data['country'])){
				$error='Please select country.';  
			} else if(empty($this->data['country']) || $this->data['country']==0){
				$error='Please select country.';
			} else if(empty($this->data['password'])){
				$error='Please enter password.';  
			} else if(empty($this->data['usertype'])){
				$error='Please enter usertype.';  
			} else {
				if($this->data['usertype']==2) {
					if(empty($this->data['company_name'])){
						$error='Please enter company name.';
						$response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
						echo json_encode($response_arry);exit;
					}
				}
			    $this->loadModel('User');
				$data['User']['username'] = $this->data['username'];
				$email = $this->data['email'];
				$data['User']['firstname'] = $this->data['firstname'];
				$data['User']['lastname'] = $this->data['lastname'];
				$data['User']['email'] = $this->data['email'];
				$data['User']['country'] = $this->data['country'];
				$data['User']['password'] = $this->Auth->password($this->data['password']);
				$data['User']['usertype'] = $this->data['usertype'];
				
				if(!empty($this->data['how_you_know'])) {
					$data['User']['how_you_know'] = $this->data['how_you_know'];
				}
				
				$this->User->save($data, false);
				$user_id=$this->User->getLastInsertId();
				if($this->data['usertype']==2) {
					$this->loadModel('Company');
					$company_data['Company']['company_name']=$this->data['company_name'];
					$company_data['Company']['user_id']=$user_id;
					$company_data['Company']['company_address']='';
					$this->Company->save($company_data, false);
				}
				
				$result=array();
				$response_arry = array('message'=> 'success', 'status'=> '1', 'error'=> '0'); 
			}
		}else{
			$error='Please send parameter first';
		}
		if(!empty($error)){
			$response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
		}

		echo json_encode($response_arry); 		
		exit;
	}
	
	 
	
	function postJob(){
		
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			if(empty($this->data['user_id'])){
				$error='Please enter user id.';
			}else if(empty($this->data['category_id'])){
				$error='Please enter category id.';
			} else if(empty($this->data['sub_category_id'])){
				$error='Please enter sub category id.';
			}  else if(empty($this->data['job_title'])){
				$error='Please enter job title.';
			} else if(empty($this->data['jobdescription'])){
				$error='Please enter job description.';
			}   else if(empty($this->data['typeofproject'])){
				$error='Please select type of project.';  
			} else if(empty($this->data['paytype'])){
				$error='Please select paytype.';  
			}  else if(empty($this->data['skills'])){
				$error='Please enetr skill.';  
			} else if(empty($this->data['where_are_you_in_life_cycle'])){
				$error='Please specify that where are you in the life cycle.';  
			} else if(empty($this->data['time_commitment_require'])){
				$error='Please enter time commitment requirement';  
			} else if(empty($this->data['exp_level'])){
				$error='Please select experience level.';  
			} else if(empty($this->data['job_finish_time_last'])){
				$error='Please enter last job finish time.';  
			}  else {
				$this->loadModel('Job');
				if($this->data['paytype']==2){
					if(empty($this->data['project_budget'])){
							$error='Please enter project budget if paytype=2(fixed budget).';  
							$response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
							echo json_encode($response_arry); exit;
					}
				}
				if(!empty($this->data['optional_skills'])) {
					$data['Job']['optional_skills'] = $this->data['optional_skills'];
				}
				if(!empty($this->data['operating_system'])) {
					$data['Job']['operating_system'] = $this->data['operating_system'];
				}
				if(!empty($this->data['requiredfreelancer'])){
					$data['Job']['requiredfreelancer'] = $this->data['requiredfreelancer'];
				}
				if(!empty($this->data['software_frameworks'])){
					$data['Job']['software_frameworks'] = $this->data['software_frameworks'];
				}
				if(!empty($this->data['job_view_settings'])){
					$data['Job']['job_view_settings'] = $this->data['job_view_settings'];
				}
				if(!empty($this->data['project_questions'])){
					$data['Job']['project_questions'] = $this->data['project_questions'];
				}
				if(!empty($this->data['Freelancer_Type'])){
					$data['Job']['Freelancer_Type'] = $this->data['Freelancer_Type'];
				}
				if(!empty($this->data['Job_Success_Score'])){
					$data['Job']['Job_Success_Score'] = $this->data['Job_Success_Score'];
				}
				if(!empty($this->data['Rising_Talent'])){
					$data['Job']['Rising_Talent'] = $this->data['Rising_Talent'];
				}
				if(!empty($this->data['Hours_Billed_on_site'])){
					$data['Job']['Hours_Billed_on_site'] = $this->data['Hours_Billed_on_site'];
				}
				if(!empty($this->data['Location_required'])){
					$data['Job']['Location_required'] = $this->data['Location_required'];
				}
				if(!empty($this->data['English_Level'])){
					$data['Job']['English_Level'] = $this->data['English_Level'];
				}
				if(!empty($this->data['job_Group'])){
					$data['Job']['job_Group'] = $this->data['job_Group'];
				}
				$data['Job']['category'] = $this->data['category_id'];
				$data['Job']['user_id'] = $this->data['user_id'];
				$data['Job']['sub_category'] = $this->data['category_id'];
				$data['Job']['job_title'] = $this->data['job_title'];
				$data['Job']['projectType'] = $this->data['typeofproject'];
				$data['Job']['job_description'] = $this->data['jobdescription'];
				$data['Job']['skillneeded'] = $this->data['skills'];
				$data['Job']['exp_level'] = $this->data['exp_level'];
				$data['Job']['paytype'] = $this->data['paytype'];
				$data['Job']['job_finish_time_last'] = $this->data['job_finish_time_last'];
				$data['Job']['time_commitment_require'] = $this->data['time_commitment_require'];
				$data['Job']['where_are_you_in_life_cycle'] = $this->data['where_are_you_in_life_cycle'];
				$this->Job->save($data, false);
				$job_id=$this->Job->getLastInsertId();
				$response_arry = array('message'=> 'success', 'status'=> '1', 'error'=> '0'); 
			}
		}else{
			$error='Please send parameter first';
		}
		if(!empty($error)){
			$response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
		}

		echo json_encode($response_arry); 		
		exit;
	}
	/**Skil list*/
	
	function getSkil() {
		$this->loadModel('Skill');
		$conditions = array();
		if (!empty($this->request->query['skillkey'])) {
		   $conditions['Skill.skill_name LIKE'] = '%'.trim($this->request->query['skillkey']).'%';
		}
		$data = $this->Skill->find('all',array('conditions'=>$conditions));
		$skills=array();
		for($i=0; $i<count($data); $i++){
			$skills[$i]=$data[$i]['Skill'];
		}
		echo json_encode(array('error_code'=> '1','status'=> '1', 'data'=> $skills)); exit;
		if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
	}
	/*
	Get category list
	*/
	function getCategories() {
		$this->loadModel('Category');
		$conditions = array();
		$data = $this->Category->find('all');
		$category=array();
		for($i=0; $i<count($data); $i++){
			$category[$i]=$data[$i]['Category'];
		}
		
		echo json_encode(array('error_code'=> '1','status'=> '1', 'data'=> $category)); exit;
		if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
	}
	
	function getSubCategories() {
		$this->loadModel('Category');
		$this->loadModel('Subcategory');
		$conditions = array();
		if(empty($this->request->query['category_id'])) {
			$error='Please enter category id.';
		} else  { 
		    $category_id=$this->request->query['category_id'];	
			$conditions['Subcategory.category_id'] = $category_id;
			$data = $this->Subcategory->find('all', array('conditions'=> $conditions));
			$subcategory=array();
			for($i=0; $i<count($data); $i++){
				$subcategory[$i]=$data[$i]['Subcategory'];
			}
			
			echo json_encode(array('error_code'=> '0','status'=> '1', 'data'=> $subcategory)); exit;
			
		}
		if(!empty($error)){
            echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> "Some problem to fetch data")); exit;
        }
	}
	
	function send_push_notification($registatoin_ids,$data) {
		/*
		$registatoin_ids=array('eRfBR19kqko:APA91bGS2X-PIIkjWcTYpezFYplpBzQsVSBHoJ0OIzammS7y4bIj0_dzug0NNhmycKjIWvnJBBWixvqUJnFoW-O5V8vAgY59v9H8uKnisYDJ08Vhg7IDR0h2juDnjXTvWenVT7R4K2Gl');
		$message='hello this is my test puch';
		$title='hi';
		*/
        $url = 'https://android.googleapis.com/gcm/send';
		$fields=$data;
		$headers = array(
            'Authorization:
                key=AIzaSyDz8wokGecqUscPR98S2ZmLMSz9ApVCHV0',
				'Content-Type: application/json'
        );
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        
        curl_close($ch);
        if($result) {
        		return $result;
        } else {
        	return "there is some error";
        }
      
    } 
    
    function iphonPN(){
        $dtockn='b84b6fc0 ea8974b3 e96d402b a649781a 1e29736f 0f0c3897 7a4144fb d36e41b3';
        $mess='Hello this is me';
        $badgeVal=true;
        $title='this is my title';
        $pan_path = WWW_ROOT."/orber.pem";
		// Put your device token here (without spaces):
      	$deviceToken=$dtockn;
		// Put your private key's passphrase here:
     	$passphrase = '123456';
		// Put your alert message here:
     	$message = $mess;
		$ctx = stream_context_create();
     	stream_context_set_option($ctx, 'ssl', 'local_cert', $pan_path);
     	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
     	if (!$fp)
      	exit("Failed to connect: $err $errstr" . PHP_EOL);
		$badgeVal=(!empty($badgeVal))?$badgeVal:0;
		$body['aps'] = array(
		 'badge' => $badgeVal,
		 'alert' => $message,
		 'sound' => 'default',
		 'title' => $title
		 );
     	// Encode the payload as JSON
     	$payload = json_encode($body);
		// Build the binary notification  str_replace(' ', '',$deviceToken)
    	$msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ', '',$deviceToken)) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
    	$result = fwrite($fp, $msg, strlen($msg));
    	
    	$returnMSG="";
    	if (!$result){
        	$returnMSG ='Message not delivered' . PHP_EOL;
        	//$returnMSG=true;
    	}else{
    	$returnMSG = 'Message successfully delivered' . PHP_EOL;
    	//$returnMSG=false;
    	}
	fclose($fp);
	die;
     //echo $returnMSG;
} 
	
	
	function getUpdatedProfile() {
		$this->loadModel('Event');
		$this->loadModel('User');
		$conditions = array();
		if(empty($this->request->query['user_id'])) {
			$error='Please enter user id.';
		} else  { 
		    $user_id=$this->request->query['user_id'];	
			$conditions['User.id'] = $user_id;
			$data = $this->User->find('first', array('conditions'=> $conditions));
			
			$data['User']['url']=$this->Api->fetchUserImage($user_id);
			$data['User']['cname']=$this->Api->fetchCountryName($data['User']['iso']);
			$data['User']['user_notification_settings']=$this->getNotificationSetting($user_id);
			$data['User']['cflag']=SITE_PATH.'img/flags/24x24/'.strtolower($data['User']['iso']).".png";
			echo json_encode(array('status'=> '1', 'message'=> $data)); exit;
			
		}
		if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
	}
	
	function loginappother(){
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			$this->loadModel('User');
			$error = '';
			if(empty($this->data['username'])){
				$error='Username should not blank.';
			}else if(empty($this->data['password'])){
				$error='Please enter password.';
			} else {
			$password=$this->Auth->password($this->data['password']);
				$usersList = $this->User->find('all', array(
					'fields' => array('User.id', 'User.username'),
					'conditions' => array('User.username' => $this->data['username'],'User.password' => $password,'User.status' => '1')
				));
				if(!empty($usersList)){
					//Here set random OTP to the database and send to the user mobile SMS.
					echo json_encode(array('status'=> '1', 'data'=> $usersList)); exit;
				}else{
					$error='Invalid username or password number';
				}
			}
			
		}else{
			$error='Request data is required';
		}
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		}
	}
	
	
	public function createTempPassword($len){
         $pass = '';
         $lchar = 0;
         $char = 0;
         for($i = 0; $i < $len; $i++){
             while($char == $lchar){
                 $char = rand(48, 109);
                 if($char > 57) $char += 7;
                 if($char > 90) $char += 6;
             }
             $pass .= chr($char);
             $lchar = $char;
         }
         return $pass;
     }
	
	function forgetPassword(){
		
		//echo "hello"; die;
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			$this->loadModel('User');
			$error = '';
			if(empty($this->data['mobile'])){
				$error='Please provide mobile number';
			} else {
				$userdata = $this->User->find('first', array('conditions'=> array('User.mobile'=>$this->data['mobile'])));
				$newpassword=$this->createTempPassword(5);
				
				$response = $this->send_sms('+'.$userdata['User']['countrycode'].$userdata['User']['mobile'], "Password: ".$newpassword."  Username : ".$userdata['User']['username']);
				if(!empty($userdata)){
					if($response) {
						$data['User']['id']=$userdata['User']['id'];
						$data['User']['password']=$this->Auth->password($newpassword);
						$this->User->save($data,false);
						echo json_encode(array('status'=> '1', 'data'=> $userdata)); exit;
					}
				}else{
					$error='Invalid Mobile, Please try again!';
				}
			}
			
		}else{
			$error='Please send post parameter first';
		}
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		}
	}
	
	
	/* 
	 *Verify OTP function for app
	 *Created by Kamlesh on 26 July
	*/
	
	function verifyOTP(){
		
		//echo "hello"; die;
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			$this->loadModel('User');
			$error = '';
			if(empty($this->data['username'])){
				$error='Please provide username';
			}else if(empty($this->data['otp'])){
				$error='OTP should not blank.';
			} else {
				$usersList = $this->User->find('all', array(
					'fields' => array('User.id', 'User.username'),
					'conditions' => array('User.username' => $this->data['username'], 'User.otp' => $this->data['otp'])
				));
				
				if(!empty($usersList)){
					$data['User']['id']=$usersList[0]['User']['id'];
					$data['User']['username']=$this->data['username'];
					$data['User']['status']=1;
					$this->User->save($data,false);
					echo json_encode(array('status'=> '1', 'data'=> $usersList)); exit;
				}else{
					$error='Invalid OTP, Please try again!';
				}
			}
			
		}else{
			$error='Please send post parameter first';
		}
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		}
	}
	
	function resendOTP(){
		$this->layout="";
		//echo "hello"; die;
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			$this->loadModel('User');
			$error = '';
			if(empty($this->data['username'])){
				$error='Please provide username';
			}else {
				$usersList = $this->User->find('all', array(
					'fields' => array('User.id', 'User.username','User.mobile','User.countrycode'),
					'conditions' => array('User.username' => $this->data['username'])
				));
				if(!empty($usersList)){
					$data['User']['id']=$usersList[0]['User']['id'];
					$data['User']['otp'] = $this->Api->generateRandomNumber();
					$data['User']['mobile']=$usersList[0]['User']['mobile'];
					$iso=$usersList[0]['User']['countrycode'];
					$response = $this->send_sms('+'.$iso.$data['User']['mobile'], $data['User']['otp']." is your OTP to signup to your Orber Account. Please do not share this with anyone.");
					if($response == '1'){
						$this->User->save($data,false);
						echo json_encode(array('status'=> '1', 'data'=> 'OTP have sent to your registered number')); die;
					}
					else {
					}
				}else{
					$error='Invalid OTP, Please try again!'; die;
				}
			}
			
		}else{
			$error='Please send post parameter first';
		}
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		}
	}
	
	/*
     *Profile update function for app
     *Created by Kamlesh on 27 July
    */

	 function updateNotification(){
        $this->layout="";
        $this->loadModel('Notification');
        if ($this->request->is('post')){
			$this->loadModel('Notification');
            if(empty($this->data['user_id'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['comment'])){
                $error='Please enter comment settings.';
            } else if(empty($this->data['favourite'])){
                $error='Please enter favourite settings.';
            } else if(empty($this->data['posts_posted_event_wall'])){
                $error='Please enter Posts Posted on Your event Wall settings.';
            } else if(empty($this->data['posts_posted_invited_event'])){
                $error='Please enter Posts Posted on Invited event wall settings.';
            } else if(empty($this->data['invitation'])){
                $error='Please enter Invitation settings.';
            }  else {
                $user_id = $this->data['user_id'];
                $ndata = $this->Notification->find('first', array('conditions'=> array('Notification.user_id'=>$user_id)));
                	if($ndata) {
                	  $result['Notification']['id'] = $ndata['Notification']['id'];
                	} 
                	$result['Notification']['user_id'] = $this->data['user_id'];
					$result['Notification']['comment'] = $this->data['comment'];
					$result['Notification']['favourite'] = $this->data['favourite'];
					$result['Notification']['posts_posted_event_wall'] = $this->data['posts_posted_event_wall'];
					$result['Notification']['posts_posted_invited_event'] = $this->data['posts_posted_invited_event'];
					$result['Notification']['invitation'] = $this->data['invitation'];
					$result['Notification']['date'] = date('Y-m-d H:i:s');
					$this->Notification->save($result);
				    echo json_encode(array('status'=> '1', 'message'=> "Success")); exit;
				
            }
        } else {
            echo json_encode(array('status'=> '0', 'message'=> "Please enetr required information.")); exit;
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    }
	
	/*
	function getNotificationSetting() {
		$this->loadModel('Notification');
		if(empty($this->request->query['user_id']) ) {
				$error="Please ente user id";
		 } else {
		 	$conditions['Notification.user_id']=$this->request->query['user_id'];
			$comment_data = $this->Notification->find('first', array('conditions'=>$conditions));
		}
		 if(!empty($error)){
				echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		  } else {
				echo json_encode(array('status'=> '1','data'=>"Success",'data'=>$comment_data)); exit;
		 }
	}
	*/
	
	function getNotificationSetting($user_id=NULL) {
		$this->loadModel('Notification');
		if(empty($user_id) ) {
				$error="Please enter user id";
		 } else {
		 
		 	$conditions['Notification.user_id']=$user_id;
			$comment_data = $this->Notification->find('first', array('conditions'=>$conditions));
		}
		 if(!empty($error)){
				return  "Settings not available";
		  } else { if(count($comment_data)) {
				return $comment_data;
				}
				else {
				return "";
				}
		 }
	}
	function checkUserFriend() {
		$this->loadModel('Invite'); 
		if(empty($this->request->query['user_id']) ) {
					$error="Please enter user id";
		 } if(empty($this->request->query['event_user_id']) ) {
					$error="Please enter user id";
		 } if(empty($this->request->query['event_id']) ) {
					$error="Please enter event id";
		 } else {
		 	$conditions['Invite.login_id']=$this->request->query['event_user_id'];
		 	$conditions['Invite.user_id']=$this->request->query['user_id'];
		 	$conditions['Invite.accepted']=1;
		 	$conditions['Invite.event_id']=$this->request->query['event_id'];
			$existuser = $this->Invite->find('count', array('conditions'=>$conditions));
			if($existuser > 0) {
				$flag=1;
			} else {
				$flag=0;
			}
		}
		 if(!empty($error)){
				echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		  } else {
				echo json_encode(array('status'=> '1','data'=>'Success','fstatus'=>$flag)); exit;
		 }
	}
	
	function getNotificationReturn($user_id=NULL) {
		$this->loadModel('Notification');
		if(empty($user_id) ) {
				$error="Please ente user id";
		 } else {
		 	$conditions['Notification.user_id']=$user_id;
			$comment_data = $this->Notification->find('first', array('conditions'=>$conditions));
		}
		 return $comment_data;
	}
	 function updateProfile_old(){
        $this->layout="";
        if ($this->request->is('post')){

            $this->loadModel('User');
            $this->loadModel('User');
            if(empty($this->data['userid'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['ccode'])){
                $error='Please enter country.';
            }else if(empty($this->data['mobile'])){
                $error='Please enter phone number.';
            }else if(empty($this->data['email'])){
                $error='Please enter email address.';
            } else if(empty($this->data['fullname'])){
                $error='Please enter fullname.';
            } else if(empty($this->data['gender'])){
                $error='Please enter gender.';
            } else {
                $id = $this->data['userid'];
                $this->User->recursive = -2;
                $user = $this->User->findById($id);
				
				//print_r($user); die; 
				if(!empty($user)){
					$result['User']['id'] = $user['User']['id'];
					$result['User']['fullname'] = $this->data['fullname'];
					$result['User']['countrycode'] = $this->data['ccode'];
					$result['User']['gender'] = $this->data['gender'];
					$result['User']['mobile'] = $this->data['mobile'];
					$result['User']['email'] = $this->data['email'];
					$result['User']['upload_id'] = 0;
					$this->User->save($result);
					$this->User->recursive = -2;
					$this->User->bindMOdel(array('hasOne' => array(
					'Upload' => array(
						'className' => 'Upload',
						'foreignKey'  => false,
						'conditions' => array(
							'AND' => array(
								array('Upload.user_id' => $id),
								array('Upload.upload_for' => 'userprofile')
							)
						),
					)
				)
	 	    ));
					$user_data = $this->User->findById($id);
					$user_data['User']['cflag']=SITE_PATH.'img/flags/24x24/'.strtolower($user_data['User']['iso']).".png";
					$data = array();
						$res  = array(
							'data' => (object) $user_data,
							'status' => '1',
							'message' => 'Your profile has been update.'
						);
					print_r(str_replace('null', '""', json_encode($res)));
					die;
				}else{
					echo json_encode(array('status'=> '0', 'message'=> "User does not exist.")); exit;
				}
            }
        }else{
            $data = array();
            $res  = array(
                'data' => (object) $data,
                'status' => '0',
                'message' => 'Please post required information.'
            );
            print_r(str_replace('null', '""', json_encode($res)));
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;	
        }
    }
    function updateProfile(){
        $this->layout="";
        if ($this->request->is('post')){
			
			$upload_id=0;
            $this->loadModel('User');
            $this->loadModel('Upload');
            if(empty($this->data['userid'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['ccode'])){
                $error='Please enter country.';
            }else if(empty($this->data['mobile'])){
                $error='Please enter phone number.';
            }else if(empty($this->data['email'])){
                $error='Please enter email address.';
            }   else {
                $id = $this->data['userid'];
                $this->User->recursive = -2;
                $user = $this->User->findById($id);
				
				
				if(isset($this->request->params['form']['userimage']['name'])  && !empty($this->request->params['form']['userimage']['name'])) {
					
					$filename = $this->request->params['form']['userimage']['name'];
					$file_ext = substr($filename, strripos($filename, '.')); 
					if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
								$newfilename = uniqid('usr-').$file_ext;
								$imgpath = WWW_ROOT.'img/userImg/'.$newfilename;
								$image_url='img/userImg/';
								list($width, $height, $itype, $attr) = getimagesize($this->request->params['form']['userimage']['tmp_name']);
								move_uploaded_file($this->request->params['form']['userimage']['tmp_name'],$imgpath);
								
								$data['Upload']['user_id'] = $this->request->data['userid'];
								$data['Upload']['url'] = $newfilename;
								$data['Upload']['media_type'] = 'image';
								$data['Upload']['upload_for'] = 'userprofile';
								$this->Upload->save($data, false);
								$upload_id=$this->Upload->getLastInsertId();
					}
					
				}
					if(isset($this->data['gender'])) {$gender=$this->data['gender'];} else {$gender='';}
					if(isset($this->data['fullname'])) {$fullname=$this->data['fullname'];} else {$fullname='';}
				//print_r($user); die; 
				if(!empty($user)){
					$result['User']['id'] = $user['User']['id'];
					$result['User']['fullname'] = $fullname;
					$result['User']['countrycode'] = $this->data['ccode'];
					$result['User']['gender'] = $gender;
					$result['User']['mobile'] = $this->data['mobile'];
					$result['User']['email'] = $this->data['email'];
					$result['User']['upload_id'] = $upload_id;
					
					
					
					$this->User->save($result);
					$this->User->recursive = -2;
					$user_data = $this->User->findById($id);
					if($upload_id!=0){
						$user_data['User']['url']=$this->Api->fetchUserImage($id);
					}
					$user_data['User']['cflag']=SITE_PATH.'img/flags/24x24/'.strtolower($user_data['User']['iso']).".png";
					$data = array();
						$res  = array(
							'data' => (object) $user_data,
							'status' => '1',
							'message' => 'Your profile has been update.'
						);
					print_r(str_replace('null', '""', json_encode($res)));
					die;
				}else{
					echo json_encode(array('status'=> '0', 'message'=> "User does not exist.")); exit;
				}
            }
        }else{
            $data = array();
            $res  = array(
                'data' => (object) $data,
                'status' => '0',
                'message' => 'Please post required information.'
            );
            print_r(str_replace('null', '""', json_encode($res)));
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    }
    
     function updateDetail(){
        $this->layout="";
        if ($this->request->is('post')){
			$this->loadModel('User');
            $this->loadModel('Upload');
            if(empty($this->data['user_id'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['username'])){
                $error='Please enter username.';
            }else if(!isset($this->data['iso'])){
				$error='Please provide the iso code';
            }else if(!isset($this->data['ccode'])){
				$error='Please provide the country code';
            } else if(!isset($this->data['profilepicid'])){
				$error='Please provide the profilepicid';
            } else {
                $id = $this->data['user_id'];
                $user = $this->User->findById($id);
               if($user['User']['username'] != $this->data['username']) {
					if($this->Api->checkExitsUser($this->data['username'])){
						echo json_encode(array('status'=> '0', 'message'=> "Success",'data'=>"Username already exist")); exit;
					}
				} 
				
				if(isset($this->data['profilepicid'])){
                	$upload_id = $this->data['profilepicid'];
           		}
				if(isset($this->request->params['form']['userimage']['name'])  && !empty($this->request->params['form']['userimage']['name'])) {
						if($this->data['profilepicid']!=0) {
							$data['Upload']['id'] = $this->data['profilepicid'];
						} 
					$filename = $this->request->params['form']['userimage']['name'];
					$file_ext = substr($filename, strripos($filename, '.')); 
					if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
								$newfilename = uniqid('usr-').$file_ext;
								$imgpath = WWW_ROOT.'img/userImg/'.$newfilename;
								$image_url='img/userImg/';
								list($width, $height, $itype, $attr) = getimagesize($this->request->params['form']['userimage']['tmp_name']);
								move_uploaded_file($this->request->params['form']['userimage']['tmp_name'],$imgpath);
								
								$data['Upload']['user_id'] = $this->request->data['user_id'];
								$data['Upload']['url'] = $newfilename;
								$data['Upload']['media_type'] = 'image';
								$data['Upload']['upload_for'] = 'userprofile';
								$this->Upload->save($data, false);
								if($this->data['profilepicid']!=0) {
									$upload_id = $this->data['profilepicid'];
								} else
									$upload_id=$this->Upload->getLastInsertId();
								}
					}
					if(isset($this->data['gender'])) {$gender=$this->data['gender'];} else {$gender='';}
					if(isset($this->data['fullname'])) {$fullname=$this->data['fullname'];} else {$fullname='';}
					$result['User']['id'] = $user['User']['id'];
					$result['User']['username'] = $this->data['username'];
					$result['User']['fullname'] = $fullname;
					$result['User']['iso'] = $this->data['iso'];
					$result['User']['gender'] = $gender;
					$result['User']['countrycode'] = $this->data['ccode'];
					$result['User']['upload_id'] = $upload_id;
					
					$this->User->save($result);
					$user_data = $this->User->findById($id);
					$user_data['User']['url']=$this->Api->fetchUserImageByid($upload_id);
					echo json_encode(array('status'=> '1', 'message'=> "Success",'data'=>$user_data)); exit;
					die;
				} 
            
        } else {
            echo json_encode(array('status'=> '0', 'message'=> "Please enetr required information.")); exit;
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    }
    
     function updateNumber(){
        $this->layout="";
        if ($this->request->is('post')){
			$this->loadModel('User');
            $this->loadModel('User');
            if(empty($this->data['user_id'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['oldmobile'])){
                $error='Please enter oldmobile.';
            } else if(empty($this->data['newmobile'])){
                $error='Please enter new mobile.';
            } else {
                $id = $this->data['user_id'];
                $user = $this->User->findById($id);
                if($user['User']['mobile'] != $this->data['oldmobile']) {
                	$error="Present mobile number is not correct";
                	echo json_encode(array('status'=> '0', 'message'=> "Success",'data'=>$error)); exit;
                }
                if(!empty($user)){
					$result['User']['id'] = $user['User']['id'];
					$result['User']['mobile'] = $this->data['newmobile'];
					
					$this->User->save($result);
					$user_data = $this->User->findById($id);
					 echo json_encode(array('status'=> '1', 'message'=> "Success",'data'=>$user_data)); exit;
					die;
				}else{
					echo json_encode(array('status'=> '0', 'message'=> "User does not exist.")); exit;
				}
            }
        } else {
            echo json_encode(array('status'=> '0', 'message'=> "Please enetr required information.")); exit;
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    }
    
    
 
    
       function changeMobile(){
        $this->layout="";
        //echo "hello"; die;
        if($this->request->is('post') && $this->data){
            $this->layout='none';
            $this->loadModel('User');
            $error = '';
            if(empty($this->data['username'])){
                $error='Please provide username';
            }else {
                $usersList = $this->User->find('all', array(
                    'fields' => array('User.id', 'User.username','User.mobile','User.countrycode'),
                    'conditions' => array('User.username' => $this->data['username'])
                ));

                if($this->Api->checkExitsMobile($this->data['mobile'], $this->data['countrycode'])){
                    echo json_encode(array('status'=> '0', 'message'=> "Success",'data'=>"This mobile is already exist")); exit;
                }

                if(!empty($usersList)){

                    $data['User']['id']=$usersList[0]['User']['id'];
                    $data['User']['otp'] = $this->Api->generateRandomNumber();

                    $iso=$this->data['iso'];
                    $countrycode=$this->data['countrycode'];
                    $mobile=$this->data['mobile'];

                    $response = $this->send_sms('+'.$countrycode.$mobile, $data['User']['otp']." is your OTP to change your mobile number on Orber. Please do not share this with anyone.");
                    if($response == '1'){

                        // print_r($data); die;
                        $this->User->save($data,false);
                        echo json_encode(array('status'=> '1', 'data'=> 'OTP have sent to your registered number')); die;
                    }
                    else {
                    }
                }else{
                    $error='Invalid OTP, Please try again!'; die;
                }
            }

        }else{
            $error='Please send post parameter first';
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    } 
    
    
    function updateEmail(){
        $this->layout="";
        if ($this->request->is('post')){
			$this->loadModel('User');
            $this->loadModel('User');
            if(empty($this->data['user_id'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['oldemail'])){
                $error='Please enter old email.';
            } else if(empty($this->data['newemail'])){
                $error='Please enter new email.';
            } else {
                $id = $this->data['user_id'];
                $user = $this->User->findById($id);
                
                if($user['User']['email'] != $this->data['oldemail']) {
                	$error="Present email address is not correct";
                	echo json_encode(array('status'=> '0', 'message'=> "Success",'data'=>$error)); exit;
                }
                if(trim($user['User']['email']) != trim($this->data['newemail'])) {
					if($this->Api->checkExitsEmail($this->data['newemail'])){
						echo json_encode(array('status'=> '0', 'message'=> "Success",'data'=>"EmailAlready Exist")); exit;
					}
				}
                if(!empty($user)){
					$result['User']['id'] = $user['User']['id'];
					$result['User']['email'] = $this->data['newemail'];
					$this->User->save($result);
					$user_data = $this->User->findById($id);
					 echo json_encode(array('status'=> '1', 'message'=> "Success",'data'=>$user_data)); exit;
					die;
				}else{
					echo json_encode(array('status'=> '0', 'message'=> "User does not exist.")); exit;
				}
            }
        } else {
            echo json_encode(array('status'=> '0', 'message'=> "Please enetr required information.")); exit;
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    }
    
    function updatePassword(){
        $this->layout="";
        if ($this->request->is('post')){
			$this->loadModel('User');
            $this->loadModel('User');
            if(empty($this->data['user_id'])){
                $error='Please provide userid first.';
            }else if(empty($this->data['oldpassword'])){
                $error='Please enter old password.';
            } else if(empty($this->data['newpassword'])){
                $error='Please enter new password.';
            } else {
                $id = $this->data['user_id'];
                $user = $this->User->findById($id);
                
                if($user['User']['password'] != $this->Auth->password($this->data['oldpassword'])) {
                	$error="Present password is not correct";
                	echo json_encode(array('status'=> '0', 'message'=> "Success",'data'=>$error)); exit;
                }
                
                if(!empty($user)){
					$result['User']['id'] = $user['User']['id'];
					$result['User']['password'] = $this->Auth->password($this->data['newpassword']);
					$this->User->save($result);
					$user_data = $this->User->findById($id);
					 echo json_encode(array('status'=> '1', 'message'=> "Success",'data'=>$user_data)); exit;
					die;
				}else{
					echo json_encode(array('status'=> '0', 'message'=> "User does not exist.")); exit;
				}
            }
        } else {
            echo json_encode(array('status'=> '0', 'message'=> "Please enetr required information.")); exit;
            die;
        }
        if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
    }
    
	
	function getUserProfile() {
		$this->loadModel('Event');
		$this->loadModel('User');
		$conditions = array();
		if(empty($this->request->query['user_id'])) {
			$error='Please enter user id.';
		} else  { 
		    $user_id=$this->request->query['user_id'];	
		/*	$this->User->bindMOdel(array('hasMany' => array(
					'Event' => array(
						'className' => 'Event',
						'foreignKey' => 'user_id',
						'fields'=> array('Event.event_title','Event.description','Event.location','Event.start_at','Event.end_at','Event.upload_id','Event.eventdate','Event.lat','Event.lng','Event.eventype','Event.status','Event.createdon')
					)
				)
	 	    ));*/
			$this->User->bindMOdel(array('hasOne' => array(
					'Upload' => array(
						'className' => 'Upload',
						'foreignKey'  => false,
						'conditions' => array(
							'AND' => array(
								array('Upload.user_id' => $user_id),
								array('Upload.upload_for' => 'userprofile')
							)
						),
					)
				)
	 	    ));
			/*
			 $this->Event->bindMOdel(array('hasOne' => array(
					'Favourite' => array(
						'className' => 'Favourite',
						'foreignKey'  => false,
						'conditions' => array(
							'AND' => array(
								array('Favourite.event_id' => $event_id),
								array('Favourite.user_id' =>$user_id )
							)
						),
					)
				)
	 	    ));  */
			$conditions['User.id'] = $user_id;
			$data = $this->User->find('first', array('conditions'=> $conditions));
			$data['user_image'] = $data['Upload'];
			$data['Posts'] = $this->GetPostDataByUser($user_id);
			$data['attendeescount']=$this->attendeesUserCount($user_id);
			// unset($data['Upload']);
			$data['User']['cname']=$this->Api->fetchCountryName($data['User']['iso']);
			$data['User']['cflag']=SITE_PATH.'img/flags/24x24/'.strtolower($data['User']['iso']).".png";
			
			echo json_encode(array('status'=> '1', 'message'=> $data)); exit;
			
		}
		if(!empty($error)){
            echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
        }
	}
	
	
	
	
	function uploadImages(){
		if ($this->request->is('post')){
			$this->loadModel('User');
			$this->loadModel('Event');
			$this->loadModel('Upload');
			$type='';
			$image_array=array();
			$imgName='media_data';
			$image_url='';
			$imgpath='';
			if($this->request->data['media_type']=='image' &&  !isset($this->request->params['form'][$imgName]['name'])) {
				$error="Please select image";
			} else if(empty($this->request->data['user_id'])){
				$error='Please provide userid first.';
			} else if(empty($this->request->data['media_type']) && ($this->request->data['media_type'] !='image' || $this->request->data['media_type'] !='video')){
				$error='Please provide right media type.';
				$type=$this->request->data['media_type'];
			} else if(empty($this->request->data['upload_for'])){
				$error='Please provide upload for.';
			}  else {
					$type=$this->request->data['media_type'];
					$upload_for=$this->request->data['upload_for'];
					$filename = $this->request->params['form'][$imgName]['name'];
					$file_ext = substr($filename, strripos($filename, '.')); 
					if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
					if($this->request->params['form'][$imgName]['error'] == 0 ){
						if($upload_for=='userprofile') {
							if($type=='image'){
								$newfilename = uniqid('usr-').$file_ext;
								$imgpath = WWW_ROOT.'img/userImg/'.$newfilename;
								$image_url='img/userImg/';
								list($width, $height, $itype, $attr) = getimagesize($this->request->params['form'][$imgName]['tmp_name']);
							}
							//$width= 500; $height=500;
						} else if($upload_for=='post') {  
							if($type=='image'){
								$newfilename = uniqid('usr-').$file_ext;
								$imgpath = WWW_ROOT.'img/postsimg/'.$newfilename;
								$image_url='img/postsimg/';
							} else {
							
								$newfilename = uniqid('video-').$file_ext;
								$imgpath = WWW_ROOT.'img/videos/'.$newfilename;
								$image_url='img/videos/';
							}
						} else if($upload_for=='banner') { 
							list($width, $height, $itype, $attr) = getimagesize($this->request->params['form'][$imgName]['tmp_name']);
							/*if(intval($width) < 640 || intval($height) < 280  ) {
								echo json_encode(array('status'=> '0', 'message'=> 'Please upload right image for event banner 640X280')); die;
							} */ 
							
							if($type=='image'){
								$newfilename = uniqid('banner-').$file_ext;
								$imgpath = WWW_ROOT.'img/eventbanner/'.$newfilename;
								$image_url='img/eventbanner/';
							} 
							
						}
						move_uploaded_file($this->request->params['form'][$imgName]['tmp_name'],$imgpath);
					}
				}
			}
			if(!empty($error)){
				echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
			} else {
				echo json_encode(array('status'=> '1','name'=>$newfilename,'width'=> $width,'height'=>$height)); die;
			}
		} else {
				echo json_encode(array('status'=> '0', 'message'=> 'Please use post method')); exit;
		}
	}
	
	function uploadmedia(){
		if ($this->request->is('post')){
			$this->loadModel('User');
			$this->loadModel('Event');
			$this->loadModel('Upload');
			$type='';
			$image_array=array();
			$imgName='media_data';
			$image_url='';
			$imgpath='';
			if($this->request->data['media_type']=='image' &&  !isset($this->request->params['form'][$imgName]['name'])) {
				$error="Please select image";
			} else if(empty($this->request->data['user_id'])){
				$error='Please provide userid first.';
			} else if(empty($this->request->data['media_type']) && ($this->request->data['media_type'] !='image' || $this->request->data['media_type'] !='video')){
				$error='Please provide right media type.';
				$type=$this->request->data['media_type'];
			} else if(empty($this->request->data['upload_for'])){
				$error='Please provide upload for.';
			} else if(($this->request->data['upload_for']=='post') && isset($this->request->data['event_id'])){
				$error='Please enter event id';
			} else {
					$type=$this->request->data['media_type'];
					$upload_for=$this->request->data['upload_for'];
					$filename = $this->request->params['form'][$imgName]['name'];
					$file_ext = substr($filename, strripos($filename, '.')); 
					if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
					if($this->request->params['form'][$imgName]['error'] == 0 ){
						if($upload_for=='userprofile') {
							if($type=='image'){
								$newfilename = uniqid('usr-').$file_ext;
								$imgpath = WWW_ROOT.'img/userImg/'.$newfilename;
								$image_url='img/userImg/';
								list($width, $height, $itype, $attr) = getimagesize($this->request->params['form'][$imgName]['tmp_name']);
							}
							//$width= 500; $height=500;
						} else if($upload_for=='post') {  
							if($type=='image'){
								$newfilename = uniqid('usr-').$file_ext;
								$imgpath = WWW_ROOT.'img/postsimg/'.$newfilename;
								$image_url='img/postsimg/';
							} else {
							
								$newfilename = uniqid('video-').$file_ext;
								$imgpath = WWW_ROOT.'img/videos/'.$newfilename;
								$image_url='img/videos/';
							}
						} else if($upload_for=='banner') { 
							list($width, $height, $itype, $attr) = getimagesize($this->request->params['form'][$imgName]['tmp_name']);
							/*if(intval($width) < 640 || intval($height) < 280  ) {
								echo json_encode(array('status'=> '0', 'message'=> 'Please upload right image for event banner 640X280')); die;
							} */ 
							
							if($type=='image'){
								$newfilename = uniqid('banner-').$file_ext;
								$imgpath = WWW_ROOT.'img/eventbanner/'.$newfilename;
								$image_url='img/eventbanner/';
							} 
							
						}
						
						
						move_uploaded_file($this->request->params['form'][$imgName]['tmp_name'],$imgpath);
						// For resize the image
						/*if($upload_for=='userprofile'){ 
							$width= 80; $height=80;
							if($width!='' && $height!='' && $type!=1){
								$path = $this->Resize->resize($imgpath, $width, $height);
								
							}
						}  */
						if(isset($this->request->data['banner_id'])) {
						if($this->request->data['banner_id']!=0 && $upload_for=='banner') {
							$data['Upload']['id'] = $this->request->data['banner_id'];
							} 
						}
						if(isset($this->request->data['user_upload_id'])) {
						if($this->request->data['user_upload_id']!=0 && $upload_for=='userprofile') {
							$data['Upload']['id'] = $this->request->data['user_upload_id'];
							//$this->create_circle($imgpath,$imgpath,$width,$height);
							} 
						} 
						if(($this->request->data['upload_for']=='post') && !isset($this->request->data['event_id'])){
							$data['Upload']['event_id'] = $this->request->data['event_id'];
						}
						$data['Upload']['user_id'] = $this->request->data['user_id'];
						// $data['Upload']['url'] = SITE_PATH.$image_url.$newfilename;
						$data['Upload']['url'] = $newfilename;
						$data['Upload']['media_type'] = $this->request->data['media_type'];
						$data['Upload']['upload_for'] = $this->request->data['upload_for'];
						//pr($data); die;
						$this->Upload->save($data, false);
						$upload_id=$this->Upload->getLastInsertId();
						if($upload_id==''){
							if(isset($this->request->data['banner_id'])) {
								$upload_id=$this->request->data['banner_id'];
							}
							if(isset($this->request->data['user_upload_id'])) {
								$upload_id=$this->request->data['user_upload_id'];
							}
						}
						if($upload_for=='userprofile') {
							$user_data['User']['id'] = $this->request->data['user_id'];
							$user_data['User']['upload_id'] = $upload_id;
							$this->User->save($user_data);
						} 
						if($upload_for=='banner' && $this->request->data['event_id']!=0) {
							$event_data['Event']['id'] = $this->request->data['event_id'];
							$event_data['Event']['upload_id'] = $upload_id;
							$this->Event->save($event_data);
						} 
						$upload_data = $this->Upload->findById($upload_id);
					}
				}
			}
			if(!empty($error)){
				echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
			} else {
				echo json_encode(array('status'=> '1','data'=>$upload_data,'width'=> $width,'height'=>$height)); die;
			}
		} else {
				echo json_encode(array('status'=> '0', 'message'=> 'Please use post method')); exit;
		}
	}
	
	/* 
	 *Events list function for app
	 *Created by Kamlesh on 26 July
	*/
	function postListing() { 
		$this->layout='default';
		 $pagesize=20;
		 $page=1;
		 $offset=0;
		
		 if(!empty($this->request->query['page']) ) {
			$page=$this->request->query['page'];
		 }
		 $f_data=array();
		 
		 $this->layout="";
		 $this->loadModel('Post');
		 $this->loadModel('Favourite');
		 $conditions = array();
		if (!empty($this->request->query['data'])) {
		   $conditions['Post.data LIKE'] = '%'.trim($this->request->query['data']).'%';
		}
		if(!empty($this->request->query['pagesize'])) {
			$pagesize=$this->request->query['pagesize'];
		}
		
		if(!empty($this->request->query['user_id'])) {
			$user_id=$this->request->query['user_id'];
			$fpostdata = $this->Favourite->find('all',
								array('conditions' => 
									array('Favourite.user_id' => $user_id)
								)
							);
				$i=0;
				foreach($fpostdata as $cdata) {
					if($cdata['Favourite']['post_id'] != 0) {
						$f_data[$i]=$cdata['Favourite']['post_id'];
					}
					$i++;
					
				}
				$conditions['Post.id']=$f_data;
		} else {
			 if(empty($this->request->query['event_id'])) {
				$error="Please enter Event id.";
				echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
		 	} 
		 	$event_id=$this->request->query['event_id'];
		 	$conditions['Post.event_id']=$event_id;
		
		}
		
		if($page==1){
			$offset = 0;
		 }else{
			$offset= $pagesize*($page-1);
		}
		
		$conditions['Post.status']=1;
		$this->Post->recursive = 1;
		
		//$conditions['Post.Postdate > ']=date('Y-m-d');
		
		
		
		$data = $this->Post->find('all', array('conditions'=>$conditions,'order' => 'Post.id DESC')); 
		
		$total_post = count($data);
		if($total_post < 1){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> "No record found!")); die;
		}else{			
			$this->paginate = array('order' => 'Post.id DESC', 'limit' => $pagesize,'offset'=>$offset);
			$post_data=$this->paginate('Post',$conditions);
			
			//pr($post_data); die;
			//$Post_data_with_user=array();
			$i=0;
			if(count($post_data)>0) {
			
			$comment_array=array();
			$mime_array=array();
			$post_arr=array();
			 foreach($post_data as $post) {
				if($post['Post']['type']=="comment") {
					array_push($comment_array,$post);
					
					} else if($post['Post']['type']=="image" || $post['Post']['type']=="video"){
						array_push($mime_array,$post);
					}  
				$i++;
				} 
				$post_arr=array('comment'=>$comment_array,'mime_post'=>$mime_array );
				echo json_encode(array('total'=>$total_post ,'status'=> '1','message'=>'Success', 'data'=> $post_arr));
				exit;
			} else {
				echo json_encode(array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found')); die;
			}
			
		}
	}
	
	
	function getFauouritePostCount($post_id=NULL) {
		$this->loadModel('Favourite');
		$co_data=array();
		if(empty($post_id)) {
			$error='Post id is empty.';
		} else {
			$fcount = $this->Favourite->find('count',
								array('conditions' => 
									array('Favourite.post_id' => $post_id ,'Favourite.favourite' => 1)
								)
							);
			return $fcount;
		}
	}
	function getFauouriteEventCount($event_id=NULL) {
		$this->loadModel('Favourite');
		$co_data=array();
		if(empty($event_id)) {
			$error='Event id is empty.';
		} else {
			$ecount = $this->Favourite->find('count',
								array('conditions' => 
									array('Favourite.event_id' => $event_id ,'Favourite.favourite' => 1)
								)
							);
			return $ecount;
		}
	}
	
	function getPostFauouriteStatus($post_id=NULL ,$user_id=NULL) {
		$this->loadModel('Favourite');
		$co_data=array();
		if(empty($post_id)) {
			$error='Post id is empty.';
		} else {
			$fstatus = $this->Favourite->find('first',
								array('conditions' => 
									array('Favourite.post_id' => $post_id ,'Favourite.user_id' => $user_id)
								)
							);
			if(isset($fstatus['Favourite']['favourite'])) {
				return $fstatus['Favourite']['favourite'];
			} else {
			return 0;
			}
		}
	}
	
	function getEventFauouriteStatus($event_id=NULL ,$user_id=NULL) {
		$this->loadModel('Favourite');
		$co_data=array();
		if(empty($event_id)) {
			$error='Post id is empty.';
		} else {
			$fstatus = $this->Favourite->find('first',
								array('conditions' => 
									array('Favourite.event_id' => $event_id ,'Favourite.user_id' => $user_id)
								)
							);
			if(isset($fstatus['Favourite']['favourite'])) {
				return $fstatus['Favourite']['favourite'];
			} else {
			return 0;
			}
		}
	}
	
	
	
	
	
	function attCount($event_id=NULL ,$user_id=NULL) {
		$this->loadModel('Attendee');
		$co_data=array();
		if(empty($event_id)) {
			$error='Event id is empty.';
		} else {
			$acount = $this->Attendee->find('count',
								array('conditions' => 
									array('Attendee.event_id' => $event_id ,'Attendee.user_id' => $user_id)
								)
							);
			return $acount;
		}
	}
	
	function getComments($post_id=NULL) {
		$this->loadModel('Comment');
		$co_data=array();
		if(empty($post_id)) {
			$error='Post id is empty.';
		} else {
			$conditions['Comment.post_id']=$post_id;
			$comment_data = $this->Comment->find('all', array('conditions'=>$conditions,'order' => 'Comment.id DESC'));
			if(count($comment_data)) {
			$i=0;
				foreach($comment_data as $cdata) {
					$co_data[$i]=$cdata['Comment'];
					$co_data[$i]['username']=$this->Api->fetchUserName($cdata['Comment']['user_id']);
					$co_data[$i]['profilepic']=$this->Api->fetchUserImage($cdata['Comment']['user_id']);
					$i++;
				}
				return $co_data;
			}
		}
	}
	function getReplies($comment_id=NULL) {
		$this->loadModel('Reply');
		$co_data=array();
		if(empty($comment_id)) {
			$error='Comment id is empty.';
		} else {
			$conditions['Reply.comment_id']=$comment_id;
			$reply_data = $this->Reply->find('all', array('conditions'=>$conditions,'order' => 'Reply.id DESC'));
			if(count($reply_data)) {
				$i=0;
				foreach($reply_data as $cdata) {
					$co_data[$i]=$cdata['Reply'];
					$co_data[$i]['username']=$this->Api->fetchUserName($cdata['Reply']['user_id']);
					$co_data[$i]['profilepic']=$this->Api->fetchUserImage($cdata['Reply']['user_id']);
					$i++;
				}
				return $co_data;
			}
		}
	}
	
	
	
	

	
	
	function getMyFauouritePost($user_id=NULL) {
		$this->loadModel('Favourite');
		$co_data=array();
		if(empty($this->request->query['user_id'])) {
			$error='Please enter user id.';
		}else {
			$user_id=$this->request->query['user_id'];
			$fpostdata = $this->Favourite->find('all',
								array('conditions' => 
									array('Favourite.user_id' => $user_id)
								)
							);
							
			$co_data=array();
			if(count($fpostdata)) {
				$i=0;
				foreach($fpostdata as $cdata) {
					$post_data[$i]['id']=$cdata['Favourite']['id'];
					$post_data[$i]['username']=$this->Api->fetchUserName($cdata['Favourite']['user_id']);
					$post_data[$i]['profilepic']=$this->Api->fetchUserImage($cdata['Favourite']['user_id']);
					$i++;
				}
			}
		}
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		} else {
			//echo json_encode(array('data'=>$postdata)); die;
			echo json_encode(array('error'=> 0,'status'=> '1',"data"=>$post_data)); exit;
		}
	}
	
	function postDetail(){
		$this->loadModel('Post');
		$this->loadModel('User');
		$post_arr=array();
		if(empty($this->request->query['post_id'])) {
			$error='Please enter post id.';
		} if(empty($this->request->query['user_id'])) {
			$error='Please enter user id.';
		} else {
			
			$post_id=$this->request->query['post_id'];
			$post_data = $this->Post->findById($post_id);
			
			if(count($post_data)) {
				$post_arr['Post']=$post_data['Post'];
				$post_arr['username']=$this->Api->fetchUserName($post_data['Post']['user_id']);
				$post_arr['profilepic']=$this->Api->fetchUserImage($post_data['Post']['user_id']);
				$post_arr['event_name']=$this->Api->fetchEventName($post_data['Post']['event_id']);
				$post_arr['user_id']=$post_data['Post']['user_id'];
				$post_arr['event_id']=$post_data['Post']['event_id'];
				$post_arr['fcount']=$this->getFauouritePostCount($post_data['Post']['id']);
				$post_arr['fstatus']=$this->getPostFauouriteStatus($post_data['Post']['id'],$this->request->query['user_id']);
				$post_arr['comments']=$this->getComments($post_data['Post']['id']);
				$i=0;
				if(count($post_arr['comments'])) {
				foreach($post_arr['comments'] as $cdata) {
						$post_arr['comments'][$i]['reply']=$this->getReplies($cdata['id']);
					$i++;
				} 
				}
				
			}
		}
	
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		} else {
			//echo json_encode(array('data'=>$postdata)); die;
			echo json_encode(array('error'=> 0,'status'=> '1',"data"=>$post_arr)); exit;
		}
	}
	
	
	
	function getUserDevice($user_id) {
		$this->loadModel('User');
		$conditions = array();
		$conditions['User.id'] = $user_id;
		$device_array=array();
		$data = $this->User->find('first', array('conditions'=> $conditions));
			
			$device_array['device_token']=$data['User']['device_token'];
			$device_array['device_type']=$data['User']['device_type'];
			
			if($data) {
				return $device_array;
			} else {
				return "";
			}
	}
	
	
	function addPostComment() { 
	if($this->request->is('post') && $this->data){   
				$this->layout='none';
				$this->loadModel('Post');
				$this->loadModel('Event');
				$this->loadModel('Notify');
				if(empty($this->request->data['user_id'])){
					$error='Please provide user id.';
				}  else if(empty($this->request->data['event_id'])){
					$error='Please enter event id.';  
				}  else if(empty($this->request->data['comment'])){
					$error='Please enter comment of post.';  
				} else {
					$conditions['conditions'] = array("Event.id" => $this->request->data['event_id']);
					$event_data = $this->Event->find( "first", $conditions );
					$data['Post']['data'] = $this->request->data['comment'];
					$data['Post']['event_id'] = $this->request->data['event_id'];
					$data['Post']['user_id'] = $this->request->data['user_id'];
					$data['Post']['type'] = 'comment';
					$data['Post']['created'] = date('Y-m-d H:i:s');
					$this->Post->save($data, false);
					$post_id=$this->Post->getLastInsertId();
					
					$notify_data['Notify']['user_id']=$this->request->data['user_id'];
					$notify_data['Notify']['event_id']=$this->request->data['event_id'];
					$notify_data['Notify']['post_id']=$post_id;
					$notify_data['Notify']['event_creater_id']=$event_data['Event']['user_id'];
					$notify_data['Notify']['status']=0;
					$notify_data['Notify']['type']='comment';
					$notify_data['Notify']['created']=date('Y-m-d H:i:s');
					$this->Notify->save($notify_data, false);
					$notify_id=$this->Notify->getLastInsertId();
					$postdata = $this->Post->findById($post_id);
					
					$device_data=$this->getUserDevice($event_data['Event']['user_id']);
					if($device_data['device_type']=='A') {
					$device_token=array($device_data['device_token']);
					$username=$this->Api->fetchUserName($this->request->data['user_id']);
					$profilepic=$this->Api->fetchUserImage($this->request->data['user_id']);
						$msg = array
						 (
							'message' 	=> $username. ' commented in your post at ' .$event_data['Event']['event_title'],
							'title'		=> 'Orber',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'type'      =>'comment',
							'notify_id' => $notify_id,
							'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'event_creater_id'=>$event_data['Event']['user_id'],
							'event_id'=>$event_data['Event']['id'],
							'user_id' => $this->request->data['user_id'],
							'comment'=>$this->request->data['comment'],
							'notId'=>''.time()
						);
						$fields = array
						(
							'registration_ids' 	=> $device_token,
							'data'			=> $msg
						);
						$result=$this->send_push_notification($device_token,$fields);
					}
					
				}
				if(!empty($error)){
					echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
				} else {
					//echo json_encode(array('data'=>$postdata)); die;
					echo json_encode(array('status'=> '1','data'=>"Successfully posted",'postdata'=>$postdata)); exit;
				}
		} else 
		{
			echo json_encode(array('status'=> '0', 'message'=> 'There is some problem please contact admin')); exit;
		}
	}
	
	
	function checkLatLng() {
		$this->loadModel('Event');
		if($this->request->is('post') && $this->data){
				$conditions = array();
				if(empty($this->data['event_id'])) {
					$error='Please enter event id.';
				} else if(empty($this->data['lat'])) {
					$error='Please enter lat.';
				} else if(empty($this->data['lng'])) {
					$error='Please enter lng.';
				} else {
					$event_id=$this->data['event_id'];
					$conditions['Event.id'] =$event_id;
					$event_data = $this->Event->find('first', array('conditions'=> $conditions));
					$user_lat=$this->data['lat'];
					$user_lng=$this->data['lng'];
					$distance=$this->Api->userDistance($event_data['Event']['lat'],$event_data['Event']['lng'],$user_lat,$user_lng,'M');
					if($distance > 50 ) {
						$error = 'You are not in the range to post on this event';
						echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
					} else {
						echo json_encode(array('status'=> '1', 'message'=> 'success')); exit;
					}
				}
				if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'data'=> $user_array)); exit;
				}
		}
	}
	
	
	function addPost() { 
	
	if($this->request->is('post') && $this->data){   
				$this->layout='none';
				$this->loadModel('Post');
				$this->loadModel('Event');
				$this->loadModel('Attendee');
				$this->loadModel('Notify');
				if(empty($this->request->data['user_id'])){
					$error='Please provide user id.';
				} else if(empty($this->request->data['lat'])){
					$error='Your device is not detecting your location please wait for some time.';
				} else if(empty($this->request->data['lng'])){
					$error='Your device is not detecting your location please wait for some time.';
				} else if(empty($this->request->data['event_id'])){
					$error='Please enter event id.';  
				} else if(empty($this->request->data['type'])){
					$error='Please enter type of post.';  
				} else {
				$newfilename='';
				$unique_id='';
				$user_lat=$this->request->data['lat']; 
				$user_lng=$this->request->data['lng']; 
				//Checking distanse of the user from event place
				$conditions['conditions'] = array("Event.id" => $this->request->data['event_id']);
				$event_data = $this->Event->find( "first", $conditions );
				//Matching the time of the event you can only post on the time of event time
					$start_event_time=strtotime($event_data['Event']['start_at']);
					$current_time=strtotime(date("Y-m-d H:i:s"));
					$end_event_time=strtotime($event_data['Event']['end_at']);
					if(($start_event_time > $current_time)) { 
						$error = 'Event does not start right now so you can not post on this event';
						echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
					} 
					if(($end_event_time < $current_time)) { 
						$error = 'Event time have expired .Now you can not post on this event';
						echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
					} 
					//You can only post on the day of event
					/*if($event_data['Event']['eventdate'] != date("Y-m-d")) {
						$error = 'You can not post today becouse today is not the event day';
						echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
					} */
				//end
				if(empty($event_data['Event']['lat']) || empty($event_data['Event']['lng'])) {
					$error='You did not mention lat long at the creation of events please recreate event or contact to admin';
					echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
				}
				
				$distance=$this->Api->userDistance($event_data['Event']['lat'],$event_data['Event']['lng'],$user_lat,$user_lng,'M');
				if($distance > 50 ) {
					$error = 'You are in the range to post on this event';
					echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
				}
					if($this->request->data['type']=='image') {
						if(isset($this->request->params['form']['postdata']['name'])){
							$filename = $this->request->params['form']['postdata']['name'];	
							$file_ext = substr($filename, strripos($filename, '.')); 
							if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
								if($this->request->params['form']['postdata']['error'] == 0 ){
									$newfilename = uniqid('post-').$file_ext;
									$data['Post']['data'] = $newfilename;
									$imgpath = WWW_ROOT.'img/postImage/'.$newfilename;
									$image_url='img/postImage/';
									move_uploaded_file($this->request->params['form']['postdata']['tmp_name'],$imgpath);
								}
							}
						} else { $error='Please enter postdata(image,video,comments';   }
					} else if($this->request->data['type']=='video') { 
					if(isset($this->request->params['form']['postdata']['name'])){
							$filename = $this->request->params['form']['postdata']['name'];	
							$file_ext = substr($filename, strripos($filename, '.'));
							if($file_ext=='.mp4' || $file_ext=='.3gp' || $file_ext=='.wmv'|| $file_ext=='.avi'|| $file_ext=='.arf'|| $file_ext=='.mkv'|| $file_ext=='.mov' || $file_ext=='.MOV') {
									if($this->request->params['form']['postdata']['error'] == 0 ){
										$unique_id=uniqid('post-');
										$newfilename = $unique_id.$file_ext;
										$data['Post']['data'] = $newfilename;
										$imgpath = WWW_ROOT.'img/postVideo/'.$newfilename;
										$image_url='img/postVideo/';
										
										move_uploaded_file($this->request->params['form']['postdata']['tmp_name'],$imgpath);
										$image  = WWW_ROOT.'img/videoThumb/'.$unique_id.'.jpg';
										/*$srcFile = "test/Sample.mp4";
										$destFile = "/test/Sample22";
										$ffmpegPath = "ffmpeg";
										$flvtool2Path = "/usr/local/bin/flvtool2";
										// Create our FFMPEG-PHP class
										//$ffmpegObj = new ffmpeg_movie($imgpath);
										// Save our needed variables
								/*		$srcWidth = makeMultipleTwo($ffmpegObj->getFrameWidth());
										$srcHeight = makeMultipleTwo($ffmpegObj->getFrameHeight());
										$srcFPS = $ffmpegObj->getFrameRate();
										$srcAB = intval($ffmpegObj->getAudioBitRate()/1000);
										$srcAR = $ffmpegObj->getAudioSampleRate();
										$srcVB = floor($ffmpegObj->getVideoBitRate()/1000); 

										// Call our convert using exec() to convert to the three file types needed by HTML5
										exec($ffmpegPath . " -i ". $imgpath ." -vcodec libx264 -vpre hq -vpre ipod640 -b ".$srcVB."k -bt 100k -acodec libfaac -ab " . $srcAB . "k -ac 2 -s " . $srcWidth . "x" . $srcHeight . " ".$destFile.".mp4");

										exec($ffmpegPath . " -i ". $imgpath ." -vcodec libvpx -r ".$srcFPS." -b ".$srcVB."k -acodec libvorbis -ab " . $srcAB . " -ac 2 -f webm -g 30 -s " . $srcWidth . "x" . $srcHeight . " ".$destFile.".webm");

										exec($ffmpegPath . " -i ". $imgpath ." -vcodec libtheora -r ".$srcFPS." -b ".$srcVB."k -acodec libvorbis -ab " . $srcAB . "k -ac 2 -s " . $srcWidth . "x" . $srcHeight . " ".$destFile.".ogv");

						*/			
										//echo $imgpath;
										//$ffmpeg = '/usr/local/bin/ffmpeg';
										$pay_icon=WWW_ROOT.'img/play.png';
									//	echo exec("ffmpeg -ss 30 -i $imgpath -i $pay_icon -filter_complex overlay=main_w-overlay_w-10:main_h-overlay_h-10 -vframes 1 $image");
										//echo exec("ffmpeg -i $imgpath -i $pay_icon -filter_complex 'overlay=10:main_h-overlay_h-10' $image");
										exec("ffmpeg -i $imgpath  -f mjpeg -s 237X370 $image 2>&1");
									//	$cmd = "ffmpeg  -itsoffset -0 -i ".$imgpath." -vcodec mjpeg -vframes 0 -an -f rawvideo -s 200x200 " . $image;
										//echo exec($cmd);
									}	
							} else { $error='Please enter right format of video (.mp4,.3gp , .wmv , arf , .mov , .mkv)'; }
						} else { $error='Please enter postdata(image,video,comments'; }
					} else {
						if(isset($this->request->data['postdata'])){
							$data['Post']['data'] = $this->request->data['postdata'];
						} else { $error='Please enter postdata(image,video,comments'; }
					}	
					$data['Post']['event_id'] = $this->request->data['event_id'];
					$data['Post']['user_id'] = $this->request->data['user_id'];
					$data['Post']['type'] = $this->request->data['type'];
					$data['Post']['created'] = date('Y-m-d H:i:s');
					$data['Post']['thumburl'] = $unique_id.'.jpg';
					$this->Post->save($data, false);
					$acount=$this->attCount($this->request->data['event_id'],$this->request->data['user_id']);
					if($acount==0) {
						$adata['Attendee']['event_id'] = $this->request->data['event_id'];
						$adata['Attendee']['user_id'] = $this->request->data['user_id'];
						$adata['Attendee']['date'] = date('Y-m-d H:i:s');
						$this->Attendee->save($adata, false);
					}
					$post_id=$this->Post->getLastInsertId();
					$notify_data['Notify']['user_id']=$this->request->data['user_id'];
					$notify_data['Notify']['event_id']=$this->request->data['event_id'];
					$notify_data['Notify']['post_id']=$post_id;
					$notify_data['Notify']['event_creater_id']=$event_data['Event']['user_id'];
					$notify_data['Notify']['status']=0;
					$notify_data['Notify']['type']='post';
					$notify_data['Notify']['created']=date('Y-m-d H:i:s');
					$notify_id='';
					if($event_data['Event']['user_id']!=$this->request->data['user_id']) {
						$this->Notify->save($notify_data, false);
						$notify_id=$this->Notify->getLastInsertId();
					}
					$postdata = $this->Post->findById($post_id);
					
					$device_data=$this->getUserDevice($event_data['Event']['user_id']);
					if($device_data['device_type']=='A') {
					$device_token=array($device_data['device_token']);
					$username=$this->Api->fetchUserName($this->request->data['user_id']);
					$profilepic=$this->Api->fetchUserImage($this->request->data['user_id']);
						$msg = array
						 (
							'message' 	=> $username. ' posted in your ' .$event_data['Event']['event_title'],
							'title'		=> 'Orber',
							'type'      =>'post',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'notify_id' => $notify_id,
							'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'event_creater_id'=>$event_data['Event']['user_id'],
							'event_id'=>$event_data['Event']['id'],
							'user_id' => $this->request->data['user_id'],
							'post_id'=>$post_id,
							'post'=>$data['Post']['data'],
							'notId'=>''.time()
							
						);
						$fields = array
						(
							'registration_ids' 	=> $device_token,
							'data'			=> $msg
						);
					
						$result=$this->send_push_notification($device_token,$fields);
					}
				}
				if(!empty($error)){
					echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
				} else {
					//echo json_encode(array('data'=>$postdata)); die;
					echo json_encode(array('status'=> '1','data'=>"Successfully posted","filename"=>$newfilename,'postdata'=>$postdata)); exit;
				}
		} else 
		{
			echo json_encode(array('status'=> '0', 'message'=> 'please enetr parameter first')); exit;
		}
	}
	
	function editPost() {
		if($this->request->is('post') && $this->data){  
				$this->layout='none';
				$this->loadModel('Post');
				if(empty($this->request->data['post_id'])){
					$error='Please enter post id.';
				}else if(empty($this->request->data['user_id'])){
					$error='Please enter user id.';
				}else if(empty($this->request->data['event_id'])){
					$error='Please enter event id.';  
				} else if(empty($this->request->data['post_media_id'])){
					$error='Please enter post media id.';  
				}  else {
					$post_id=$this->request->data['post_id'];
					$postdata = $this->Post->findById($post_id);
					//data for saving
					$data['Post']['event_id'] = $postdata['Post']['event_id'];
					$data['Post']['user_id'] = $this->request->data['user_id'];
					$data['Post']['post_media_id'] = $this->request->data['post_media_id'];
					if(isset($this->request->data['comment'])) {
						$data['Post']['comment'] = $this->request->data['comment'];
					}
					$this->Post->save($data);
					$post_id=$this->Post->getLastInsertId();
					$postdata = $this->Post->findById($post_id);
				}
				if(!empty($error)){
					echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
				} else {
					echo json_encode(array('data'=>$postdata)); 
					die;
				}
		} else 
		{
			echo json_encode(array('status'=> '0', 'message'=> 'Please use post method')); exit;
		}
	}
	
	
function create_circle($img_path ,$despath,$w,$h ) {
    //$w = 640;  $h=480; // original size
    
    $original_path="/location/of/your/original-picture.jpg";
    $dest_path="/location/of/your/picture-crop-transp.png";
    $src = imagecreatefromstring(file_get_contents($original_path));
    $newpic = imagecreatetruecolor($w,$h);
    imagealphablending($newpic,false);
    $transparent = imagecolorallocatealpha($newpic, 0, 0, 0, 127);
    $r=$w/2;
    for($x=0;$x<$w;$x++)
        for($y=0;$y<$h;$y++){
            $c = imagecolorat($src,$x,$y);
            $_x = $x - $w/2;
            $_y = $y - $h/2;
            if((($_x*$_x) + ($_y*$_y)) < ($r*$r)){
                imagesetpixel($newpic,$x,$y,$c);
            }else{
                imagesetpixel($newpic,$x,$y,$transparent);
            }
        }
    imagesavealpha($newpic, true);
    imagepng($newpic, $dest_path);
    imagedestroy($newpic);
    imagedestroy($src);
	}
	
	function setAbuseEvent() {
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			$conditions=array();
			if(empty($this->data['event_id'])){
			    $error='Please enter event id.';  
			} else if(!isset($this->data['user_id'])){
			    $error='Please  enter user id.';  
			}   else {
					$this->loadModel('Abuse');
					$data['Abuse']['user_id'] = $this->data['user_id'];
					$data['Abuse']['event_id'] = $this->data['event_id'];
					$data['Abuse']['status'] = 1;
					$this->Abuse->save($data, false); 
					$response_arry = array('error_code'=> '0','status'=> '1', 'message'=> "success");
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	function setAbusePost() {
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			$conditions=array();
			if(empty($this->data['post_id'])){
			    $error='Please enter post id.';  
			} else if(!isset($this->data['user_id'])){
			    $error='Please  enter user id.';  
			}   else {
					$this->loadModel('Abuse');
					$data['Abuse']['user_id'] = $this->data['user_id'];
					$data['Abuse']['post_id'] = $this->data['post_id'];
					$data['Abuse']['status'] = 1;
					$this->Abuse->save($data, false); 
					$response_arry = array('error_code'=> '0','status'=> '1', 'message'=> "success");
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	/*
	function setFavourite() {
		
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			$conditions=array();
			if(empty($this->data['user_id'])){
			    $error='Please enter user_id.';  
			}else if(empty($this->data['event_id'])){
			    $error='Please enter event.';  
			} else {
					$this->loadModel('Favourite');
					//$getdata = $this->Api->checkExitsUser($username);
					$conditions['user_id']=$this->data['user_id'];
					$conditions['event_id']=$this->data['event_id'];
					$fav_data = $this->Favourite->find('first',array('conditions'=>$conditions));
					if(count($fav_data)>0) { 
						$data['Favourite']['id'] = $fav_data['Favourite']['id'];
					}
					$data['Favourite']['event_id'] = $this->data['event_id'];
					$data['Favourite']['user_id'] = $this->data['user_id'];
					$data['Favourite']['favourite'] = $this->data['favourite'];
					$this->Favourite->save($data, false); 
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Success', 'status'=> '1', 'error'=> '0');
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	*/
	
	function setPostFavourite() {
		$this->loadModel('Favourite');
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			$conditions=array();
			if(empty($this->data['user_id'])){
			    $error='Please enter user_id.';  
			}else if(empty($this->data['post_id'])){
			    $error='Please enter post id.';  
			} else if(!isset($this->data['favourite'])){
			    $error='Please enter favourite status.';  
			}  else {
					$this->loadModel('Favourite');
					$this->loadModel('Post');
					//$getdata = $this->Api->checkExitsUser($username);
					$conditions['user_id']=$this->data['user_id'];
					$conditions['post_id']=$this->data['post_id'];
					$post_data = $this->Post->find('first',array('conditions'=>array('id'=>$this->data['post_id'])));
					$fav_data = $this->Favourite->find('first',array('conditions'=>$conditions));
					if(count($fav_data)>0) { 
						$data['Favourite']['id'] = $fav_data['Favourite']['id'];
					}
					$data['Favourite']['post_id'] = $this->data['post_id'];
					$data['Favourite']['user_id'] = $this->data['user_id'];
					$data['Favourite']['favourite'] = $this->data['favourite'];
					$this->Favourite->save($data, false); 
					
					if($this->data['favourite']==1) {$f='favourite';} else {$f='unfavourite';}
					
					//Notification Section when user do favourite or unfavaourite
					
					
					$device_data=$this->getUserDevice($post_data['Post']['user_id']);
					if($device_data['device_type']=='A') {
					$device_token=array($device_data['device_token']);
					$username=$this->Api->fetchUserName($this->data['user_id']);
					$profilepic=$this->Api->fetchUserImage($this->data['user_id']);
						$msg = array
						 (
							'message' 	=> $username.'  '.$f.' your post',
							'title'		=> 'Orber',
							'type'      =>'post',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'post_creater_id'=>$post_data['Post']['user_id'],
							'post_id'=>$this->data['post_id'],
							'user_id' => $this->data['user_id'],
							'notId'=>''.time()
						);
						$fields = array
						(
							'registration_ids' 	=> $device_token,
							'data'			=> $msg
						);
					
					$result=$this->send_push_notification($device_token,$fields);
					}
					
					
					
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Success', 'status'=> '1', 'error'=> '0','fcount'=> $this->getFauouritePostCount($this->data['post_id']));
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	function setEventFavourite() {
		$this->loadModel('Favourite');
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			$conditions=array();
			if(empty($this->data['user_id'])){
			    $error='Please enter user_id.';  
			}else if(empty($this->data['event_id'])){
			    $error='Please enter event id.';  
			} else if(!isset($this->data['favourite'])){
			    $error='Please enter favourite status.';
			}  else {
					$this->loadModel('Favourite');
					$this->loadModel('Event');
					//$getdata = $this->Api->checkExitsUser($username);
					$conditions['user_id']=$this->data['user_id'];
					$conditions['event_id']=$this->data['event_id'];
					$event_data = $this->Event->find('first',array('conditions'=>array('id'=>$this->data['event_id'])));
					
					$fav_data = $this->Favourite->find('first',array('conditions'=>$conditions));
					
					if(count($fav_data)>0) { 
						$data['Favourite']['id'] = $fav_data['Favourite']['id'];
					}
					$data['Favourite']['user_id'] = $this->data['user_id'];
					$data['Favourite']['event_id'] = $this->data['event_id'];
					$data['Favourite']['favourite'] = $this->data['favourite'];
					$this->Favourite->save($data); 
					
					
					
					if($this->data['favourite']==1) {$f='favourite';} else {$f='unfavourite';}
					
					//Notification Section when user do favourite or unfavaourite
					
					
					$device_data=$this->getUserDevice($event_data['Event']['user_id']);
					if($device_data['device_type']=='A') {
					$device_token=array($device_data['device_token']);
					$username=$this->Api->fetchUserName($this->data['user_id']);
					$profilepic=$this->Api->fetchUserImage($this->data['user_id']);
						$msg = array
						 (
							'message' 	=> $username.'  '.$f.' your event',
							'title'		=> 'Orber',
							'type'      =>'post',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'event_creater_id'=>$event_data['Event']['user_id'],
							'event_id'=>$this->data['event_id'],
							'user_id' => $this->data['user_id'],
							'notId'=>''.time()
						);
						$fields = array
						(
							'registration_ids' 	=> $device_token,
							'data'			=> $msg
						);
					
					$result=$this->send_push_notification($device_token,$fields);
					}
					
					
					
					
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Success', 'status'=> '1', 'error'=> '0','fcount'=> $this->getFauouriteEventCount($this->data['event_id']));
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	function deleteEvent() {
		$this->loadModel('Event');
		$conditions = array();
		if(!isset($this->request->query['event_id'])) {
			$error='Please enter event id.'; 
		} else if(!isset($this->request->query['user_id'])) {
			$error='Please enter user id.'; 
		} else {
			$user_id=$this->request->query['user_id'];
			$event_id=$this->request->query['event_id'];
			$conditions['user_id']=$user_id;
			$conditions['id']=$event_id;
			$ev_data = $this->Event->find('first',array('conditions'=>$conditions));
			$data['Event']['id']=$ev_data['Event']['id'];
			$data['Event']['status']=3;
			$this->Event->save($data);
			echo json_encode(array('message'=> 'success','status'=> '1'));
			die;
		}
		if(!empty($error)){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
			die;
		} else {
			echo json_encode(array('message'=> 'success','status'=> '1'));
		}
	}
	
	function deletePost() {
		$this->loadModel('Post');
		$conditions = array();
		if(!isset($this->request->query['post_id'])) {
			$error='Please enter post id.';
		} else if(!isset($this->request->query['user_id'])) {
			$error='Please enter user id.';
		} else {
			$user_id=$this->request->query['user_id'];
			$post_id=$this->request->query['post_id'];
			$conditions['user_id']=$user_id;
			$conditions['id']=$post_id;
			$post_data = $this->Post->find('first',array('conditions'=>$conditions));
			if($post_data) {
				$data['Post']['id']=$post_data['Post']['id'];
				$data['Post']['status']=3;
				if($post_data['Post']['id']) {
			
					$this->Post->save($data);
				}
				echo json_encode(array('message'=> 'success','status'=> '1'));
			} else {
				echo json_encode(array('message'=> 'Post Not deleted','status'=> '0')); die;
			}
			die;
		}
		if(!empty($error)){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
			die;
		} else {
			echo json_encode(array('message'=> 'success','status'=> '1'));
		}
	}
	
	/* 
	 *Create event function for app
	 *Created by Kamlesh on 26 July
	*/
	function addevent(){  
		if($this->request->is('post') && $this->data){
			$banner_id=0;
            $this->layout='none';
			if(empty($this->data['event_title'])){
				$error='Please enter event_title.';
			}else if(empty($this->data['user_id'])){
			    $error='Please enter user_id.';  
			}else if(empty($this->data['location'])){
			    $error='Please enter location.';  
			}else if(empty($this->data['start_at'])){
			    $error='Please enter start time of event.';  
			}else if(empty($this->data['end_at'])){
			    $error='Please enter end time of event.';  
			}else if(empty($this->data['eventdate'])){
			    $error='Please enter event date.';  
			}else if(empty($this->data['endeventdate'])){
			    $error='Please enter end event date .';  
			}else if(empty($this->data['lat'])){
			    $error='Please enter latitude.';  
			}else if(empty($this->data['lng'])){
			    $error='Please enter logitude.';  
			}else if(!isset($this->data['eventype'])){
			    $error='Please enter event type.';  
			} else if(!isset($this->data['max_zoom'])){
			    $error='Please enter max zoom.';  
			}else {
				if($this->data['access_key']==$this->key){
					$this->loadModel('Event');
					$this->loadModel('Upload');
					//$getdata = $this->Api->checkExitsUser($username);
					
					
					
				if(isset($this->request->params['form']['eventimage']['name'])  && !empty($this->request->params['form']['eventimage']['name'])) {
					$filename = $this->request->params['form']['eventimage']['name'];
					$file_ext = substr($filename, strripos($filename, '.')); 
					if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
								$newfilename = uniqid('banner-').$file_ext;
								$imgpath = WWW_ROOT.'img/eventbanner/'.$newfilename;
								$image_url='img/userImg/';
								list($width, $height, $itype, $attr) = getimagesize($this->request->params['form']['eventimage']['tmp_name']);
								move_uploaded_file($this->request->params['form']['eventimage']['tmp_name'],$imgpath);
								
								$data['Upload']['user_id'] = $this->request->data['user_id'];
								$data['Upload']['url'] = $newfilename;
								$data['Upload']['media_type'] = 'image';
								$data['Upload']['upload_for'] = 'banner';
								$this->Upload->save($data, false);
								$banner_id=$this->Upload->getLastInsertId();
					}
				}
					if(isset($this->data['description'])) { $des=$this->data['description']; } else { $des=''; }
					$data['Event']['event_title'] = $this->data['event_title'];
					$data['Event']['user_id'] = $this->data['user_id'];
					$data['Event']['description'] = $des;
					$data['Event']['location'] = $this->data['location'];
					$data['Event']['start_at'] = $this->data['eventdate'].' '.$this->data['start_at'];
					$data['Event']['end_at'] = $this->data['endeventdate'].' '.$this->data['end_at'];
					$data['Event']['eventdate'] = $this->data['eventdate'];
					$data['Event']['endeventdate'] = $this->data['endeventdate'];
					$data['Event']['lat'] = $this->data['lat'];
					$data['Event']['lng'] = $this->data['lng'];
					$data['Event']['eventype'] = $this->data['eventype'];
					$data['Event']['upload_id'] = $banner_id;
					$data['Event']['max_zoom']=$this->data['max_zoom'];
					$this->Event->save($data, false); 
					$fields = array('event_title','user_id', 'description', 'location', 'start_at','end_at', 'eventdate', 'lat', 'lng', 'latitude','longitude' ,'eventype','status','created');
					$eventId = $this->Event->getLastInsertId();
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Event add successfully', 'status'=> '1', 'error'=> '0','event_id'=>$eventId);
							
				}else{
				   $response_arry = array('error_code'=> '2', 'status'=> '0', 'message'=> 'Please enter valid access key.');
				}		  
			}
		}else{
			$error='Please send post parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	

	
	/* 
	 *Create event function for app
	 *Created by Kamlesh on 26 July
	*/
	function editevent(){
	
		if($this->request->is('post') && $this->data){
            $this->layout='none';
            $banner_id=0;
			if(empty($this->data['event_id'])){
				$error='Please enter event id.';
			} else if(empty($this->data['event_title'])){
				$error='Please enter event_title.';
			}else if(empty($this->data['user_id'])){
			    $error='Please enter user_id.';  
			}else if(empty($this->data['start_at'])){
			    $error='Please enter start time of event.';  
			}else if(empty($this->data['end_at'])){
			    $error='Please enter end time of event.';  
			}else if(empty($this->data['eventdate'])){
			    $error='Please enter event date.';  
			}else if(empty($this->data['endeventdate'])){
			    $error='Please enter end event date .';  
			}else if(!isset($this->data['eventype'])){
			    $error='Please enter event type.';  
			} else if(!isset($this->data['banner_id'])){
			    $error='Please enter banner id.';  
			} else {
				if($this->data['access_key']==$this->key){
					$this->loadModel('Event');
					$this->loadModel('Upload');
					//$getdata = $this->Api->checkExitsUser($username);
					if(!empty($this->data['banner_id'])){
			    		$banner_id=$this->data['banner_id'];
					}
					
					if(isset($this->request->params['form']['eventimage']['name'])  && !empty($this->request->params['form']['eventimage']['name'])) {
					
						if($this->data['banner_id']!=0) {
							$data['Upload']['id'] = $this->data['banner_id'];
						} 
								
					$filename = $this->request->params['form']['eventimage']['name'];
					$file_ext = substr($filename, strripos($filename, '.')); 
					if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
								$newfilename = uniqid('banner-').$file_ext;
								$imgpath = WWW_ROOT.'img/eventbanner/'.$newfilename;
								$image_url='img/userImg/';
								list($width, $height, $itype, $attr) = getimagesize($this->request->params['form']['eventimage']['tmp_name']);
								move_uploaded_file($this->request->params['form']['eventimage']['tmp_name'],$imgpath);
								$data['Upload']['user_id'] = $this->request->data['user_id'];
								$data['Upload']['url'] = $newfilename;
								$data['Upload']['media_type'] = 'image';
								$data['Upload']['upload_for'] = 'banner';
								$this->Upload->save($data, false);
								if($this->data['banner_id']!=0) {
									$banner_id = $this->data['banner_id'];
								} else
									$banner_id=$this->Upload->getLastInsertId();
								}
						}
					if(isset($this->data['description'])) { $des=$this->data['description']; } else { $des=''; }
					$event_id=$this->data['event_id'];
					$data['Event']['id'] = $event_id;
					$data['Event']['event_title'] = $this->data['event_title'];
					$data['Event']['user_id'] = $this->data['user_id'];
					$data['Event']['description'] = $des;
					$data['Event']['start_at'] = $this->data['eventdate'].' '.$this->data['start_at'];
					$data['Event']['end_at'] = $this->data['endeventdate'].' '.$this->data['end_at'];
					$data['Event']['eventdate'] = $this->data['eventdate'];
					$data['Event']['endeventdate'] = $this->data['endeventdate'];
					$data['Event']['eventype'] = $this->data['eventype'];
					$data['Event']['upload_id'] = $banner_id;
					$this->Event->save($data, false); 
					$fields = array('event_title','user_id', 'description', 'location', 'start_at','end_at', 'eventdate', 'lat', 'lng', 'latitude','longitude' ,'eventype','status','created');
					//$eventId = $this->Event->getLastInsertId();
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Event Update successfully', 'status'=> '1', 'error'=> '0');
							
				}else{
				   $response_arry = array('error_code'=> '2', 'status'=> '0', 'message'=> 'Please enter valid access key.');
				}		  
			}
		}else{
			$error='Please send post parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	
	/* 
	 *Events list function for app
	 *Created by Kamlesh on 26 July
	*/
	function myEvents() { 
		$this->layout='default';
		 $pagesize=10;
		 $page=1;
		 $offset=0;
		 if(empty($this->request->query['user_id'])) {
			$error="Please enter user id of events ";
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
		 }
		 $user_id=$this->request->query['user_id'];
		  if(!empty($this->request->query['page']) ) {
			$page=$this->request->query['page'];
		 }
		 $this->layout="";
		 $this->loadModel('Event');
		 $conditions = array();
		
		if (!empty($this->request->query['event_title'])) {
		   $conditions['Event.event_title LIKE'] = '%'.trim($this->request->query['event_title']).'%';
		}
		if(!empty($this->request->query['pagesize'])) {
			$pagesize=$this->request->query['pagesize'];
		}
		if($page==1){
			$offset = 0;
		 }else{
			$offset= $pagesize*($page-1);
		}
		
		$conditions['Event.status']=1;
		$conditions['Event.user_id']=$user_id;
		$this->Event->recursive = 1;
		$previous_event=array();
		$upcoming_event=array();
		//$conditions['Event.eventdate > ']=date('Y-m-d');
	/*	if($type=="upcoming") {
			$conditions['Event.start_at  >= ']=date('Y-m-d H:i:s');
		} else if($type=="previous"){
			$conditions['Event.end_at  < ']=date('Y-m-d H:i:s');
		} */
		$data = $this->Event->find('all', array('conditions'=>$conditions,'order' => 'Event.id DESC'));
		$total_event = count($data);
		if($total_event < 1){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> "No record found!")); die;
		}else{			
			$this->paginate = array('order' => 'Event.id DESC', 'limit' => $pagesize,'offset'=>$offset);
			$event_data=$this->paginate('Event',$conditions);
			
			
			$event_data_with_user=array();
			$i=0;
			if(count($event_data)>0) {
				foreach($event_data as $event) {
				
				if(strtotime($event['Event']['start_at']) > strtotime(date('Y-m-d H:i:s'))) {
					$type="upcoming";
				} else {
					$type="previous";
				}
				$event_data_with_user[$i]['id']=$event['Event']['id'];
				$event_data_with_user[$i]['user_id']=$event['Event']['user_id'];
				$event_data_with_user[$i]['event_title']=$event['Event']['event_title'];
				$event_data_with_user[$i]['description']=$event['Event']['description'];
				$event_data_with_user[$i]['location']=$event['Event']['location'];
				$event_data_with_user[$i]['start_at']=$event['Event']['start_at'];
				$event_data_with_user[$i]['end_at']=$event['Event']['end_at'];
				$event_data_with_user[$i]['upload_id']=$event['Event']['upload_id'];
				$event_data_with_user[$i]['eventdate']=$event['Event']['eventdate'];
				$event_data_with_user[$i]['endeventdate']=$event['Event']['endeventdate'];
				$event_data_with_user[$i]['lat']=$event['Event']['lat'];
				$event_data_with_user[$i]['lng']=$event['Event']['lng'];
				$event_data_with_user[$i]['eventype']=$event['Event']['eventype'];
				$event_data_with_user[$i]['status']=$event['Event']['status'];
				$event_data_with_user[$i]['createdon']=$event['Event']['createdon'];
				$event_data_with_user[$i]['abuse']=$event['Event']['abuse'];
				$event_data_with_user[$i]['etype']=$type;
				$event_data_with_user[$i]['username']=$this->Api->fetchUserName($event['Event']['user_id']);
				$event_data_with_user[$i]['profilepic']=$this->Api->fetchUserImage($event['Event']['user_id']);
				$event_data_with_user[$i]['url']=$this->Api->fetchEventImage($event['Event']['upload_id']);
				$i++;
				}
				
				echo json_encode(array('total'=>$total_event ,'status'=> '1','message'=>'Success', 'data'=> $event_data_with_user));
				exit;
			} else {
				echo json_encode(array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found')); die;
			}
			
		}
	}
	
	function getCommingEventsMap(){
		 $this->layout='default';
		 $pagesize=20;
		 $page=1;
		 $offset=0;
		 
		 if(!empty($this->request->query['page']) ) {
			$page=$this->request->query['page'];
		 }
		 $this->layout="";
		 $this->loadModel('Event');
		 $this->loadModel('Favourite');
			if(empty($this->request->query['user_id'])) {
				$error="Please enter user id";
				echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
			}
		 $conditions = array();
		  $order='Event.start_at DESC';
		  $type='myevent';
		if (!empty($this->request->query['event_title'])) {
		   $conditions['Event.event_title LIKE'] = '%'.trim($this->request->query['event_title']).'%';
		}
		if (!empty($this->request->query['month'])) {
		   $conditions['Event.eventdate LIKE'] = '%'.trim($this->request->query['month']).'%';
		}
		if (!empty($this->request->query['location'])) {
		   $conditions['Event.location LIKE'] = '%'.trim($this->request->query['location']).'%';
		}
		if(!empty($this->request->query['pagesize'])) {
			$pagesize=$this->request->query['pagesize'];
		}
		if($page==1){
			$offset = 0;
		 }else{
			$offset= $pagesize*($page-1);
		}
		if (!empty($this->request->query['user_id']) && !empty($this->request->query['other']) && $this->request->query['other']=='common') {
			if($this->request->query['etype']=='favourite') {
				$user_id = $this->request->query['user_id'];
				$fpostdata = $this->Favourite->find('all',
									array('conditions' => 
										array('Favourite.user_id' => $user_id , 'Favourite.favourite'=>1)
									)
								); 
					$i=0;
					$f_data=array();
					foreach($fpostdata as $cdata) {
					if($cdata['Favourite']['event_id'] !=0) {
							$f_data[$i]=$cdata['Favourite']['event_id'];
							$i++;
					}
					
					}
				$conditions['Event.id']=$f_data;
		  } else if($this->request->query['etype']=='attended') {  
		   		$this->loadModel('Attendee');
		 		$user_id = $this->request->query['user_id'];
				$attended_event = $this->Attendee->find('all',
									array('conditions' => 
										array('Attendee.user_id' => $user_id)
									)
								);
								
					$i=0;
					foreach($attended_event as $adata) {
					if($adata['Attendee']['event_id'] !=0) {
							$attended_data[$i]=$adata['Attendee']['event_id'];
							$i++;
					}
					} 
					$conditions['Event.id']=$attended_data;
		 } else {
		 		$this->loadModel('Invite');
		 		$invite_data=array();
		 		$user_id = $this->request->query['user_id'];
				$invite_event = $this->Invite->find('all',
									array('conditions' => 
										array('Invite.user_id' => $user_id)
									)
								);	
					$i=0;
					foreach($invite_event as $adata) {
					if($adata['Invite']['event_id'] !=0) {
							$invite_data[$i]=$adata['Invite']['event_id'];
							$i++;
					}
					} 
					$conditions['Event.id']=$invite_data;
		 	
		 }
		} else {
			if (!isset($this->request->query['month'])) {
				if(empty($this->request->query['type']) && $this->request->query['type'] !='previous' && $this->request->query['type'] !='upcoming') {
						$error="Please enter type of events (upcoming or previous)";
						echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
				 }
			}	 
				 
				 //Abuse Event will not see in event list based on user
				$this->loadModel('Abuse');
		 		$abuse_data=array();
		 		$user_id = $this->request->query['user_id'];
				$abuse_event = $this->Abuse->find('all',
									array('conditions' => 
										array('Abuse.user_id' => $user_id)
									)
								);	
					$i=0;
					foreach($abuse_event as $adata) {
					if($adata['Abuse']['event_id'] !=0) {
							$abuse_data[$i]=$adata['Abuse']['event_id'];
							$i++;
					}
					} 
				//	pr($abuse_data); die;
				$conditions['NOT']= array( "Event.id" =>$abuse_data);
				if (!isset($this->request->query['month'])) {
				$type=$this->request->query['type'];
					if($type=="upcoming") {
						$order='Event.start_at ASC';
						$conditions['Event.end_at  > ']=date('Y-m-d H:i:s');
					} else if($type=="previous"){
						$order='Event.start_at DESC';
						$conditions['Event.end_at  < ']=date('Y-m-d H:i:s');
					}
					}
					$conditions['Event.eventype']=0;
		}
		$conditions['Event.status']=1;
		$this->Event->recursive = 1;
		$previous_event=array();
		$upcoming_event=array();
		//$conditions['Event.eventdate > ']=date('Y-m-d');
		 
		$data = $this->Event->find('all', array('conditions'=>$conditions,'order' => 'Event.id ASC'));
		$total_event = count($data);
		if($total_event < 1){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> "No record found!")); die;
		}else{			
			
			$event_data=$data;
			
		//	pr($event_data); die;
			$event_data_with_user=array();
			$i=0;
			if(count($event_data)>0) {
				foreach($event_data as $event) {
				$event_data_with_user[$i]['id']=$event['Event']['id'];
				$event_data_with_user[$i]['user_id']=$event['Event']['user_id'];
				$event_data_with_user[$i]['event_title']=$event['Event']['event_title'];
				$event_data_with_user[$i]['description']=$event['Event']['description'];
				$event_data_with_user[$i]['location']=$event['Event']['location'];
				$event_data_with_user[$i]['start_at']=$event['Event']['start_at'];
				$event_data_with_user[$i]['end_at']=$event['Event']['end_at'];
				$event_data_with_user[$i]['upload_id']=$event['Event']['upload_id'];
				$event_data_with_user[$i]['eventdate']=$event['Event']['eventdate'];
				$event_data_with_user[$i]['lat']=$event['Event']['lat'];
				$event_data_with_user[$i]['lng']=$event['Event']['lng'];
				$event_data_with_user[$i]['eventype']=$event['Event']['eventype'];
				$event_data_with_user[$i]['status']=$event['Event']['status'];
				$event_data_with_user[$i]['createdon']=$event['Event']['createdon'];
				$event_data_with_user[$i]['abuse']=$event['Event']['abuse'];
				if (!isset($this->request->query['month'])) {
				$event_data_with_user[$i]['etype']=$type;
				}
				$event_data_with_user[$i]['username']=$this->Api->fetchUserName($event['Event']['user_id']);
				$event_data_with_user[$i]['profilepic']=$this->Api->fetchUserImage($event['Event']['user_id']);
				$event_data_with_user[$i]['url']=$this->Api->fetchEventImage($event['Event']['upload_id']);
				$i++;
				}
				echo json_encode(array('total'=>$total_event ,'status'=> '1','message'=>'Success', 'data'=> $event_data_with_user));
				exit;
			} else {
				echo json_encode(array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found')); die;
			}
			
		}
	}
	
	
	function getSearchEvents() { 
		 $this->layout='default';
		 $this->layout="";
		 $this->loadModel('Event');
		 $conditions = array();
		 $pagesize=10;
		 $page=1;
		 $offset=0;
		  if(!empty($this->request->query['page']) ) {
			$page=$this->request->query['page'];
		 }
		 if(!empty($this->request->query['pagesize'])) {
			$pagesize=$this->request->query['pagesize'];
		}
		if($page==1){
			$offset = 0;
		 }else{
			$offset= $pagesize*($page-1);
		}
		$order='Event.id ASC';
		 $conditions['Event.status']=1;
		 $this->Event->recursive = 1;
		 if (!empty($this->request->query['search_keyword'])) {
		  	$search_keyword=$this->request->query['search_keyword'];
		  	//$conditions['Event.location LIKE']='%'.trim($search_keyword).'%';
		} else {
			$error="No data found";
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
		}
		 $conditions['OR']=array('Event.event_title LIKE'=>'%'.trim($search_keyword).'%','Event.location LIKE'=>'%'.trim($search_keyword).'%');
		 $data = $this->Event->find('all', array('conditions'=>$conditions,'order' => 'Event.id ASC'));
		 $total_event = count($data);
		 if($total_event < 1){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> "No record found!")); die;
		 }else{			
			$this->paginate = array('order' => $order, 'limit' => $pagesize,'offset'=>$offset);
			$event_data=$this->paginate('Event',$conditions);
			$event_data_with_user=array();
			$i=0;
			if(count($event_data)>0) {
				foreach($event_data as $event) {
				$event_data_with_user[$i]['id']=$event['Event']['id'];
				$event_data_with_user[$i]['user_id']=$event['Event']['user_id'];
				$event_data_with_user[$i]['event_title']=$event['Event']['event_title'];
				$event_data_with_user[$i]['description']=$event['Event']['description'];
				$event_data_with_user[$i]['location']=$event['Event']['location'];
				$event_data_with_user[$i]['start_at']=$event['Event']['start_at'];
				$event_data_with_user[$i]['end_at']=$event['Event']['end_at'];
				$event_data_with_user[$i]['upload_id']=$event['Event']['upload_id'];
				$event_data_with_user[$i]['eventdate']=$event['Event']['eventdate'];
				$event_data_with_user[$i]['lat']=$event['Event']['lat'];
				$event_data_with_user[$i]['lng']=$event['Event']['lng'];
				$event_data_with_user[$i]['eventype']=$event['Event']['eventype'];
				$event_data_with_user[$i]['status']=$event['Event']['status'];
				$event_data_with_user[$i]['createdon']=$event['Event']['createdon'];
				$event_data_with_user[$i]['abuse']=$event['Event']['abuse'];
				$event_data_with_user[$i]['username']=$this->Api->fetchUserName($event['Event']['user_id']);
				$event_data_with_user[$i]['profilepic']=$this->Api->fetchUserImage($event['Event']['user_id']);
				$event_data_with_user[$i]['url']=$this->Api->fetchEventImage($event['Event']['upload_id']);
				$i++;
				}
				echo json_encode(array('total'=>$total_event ,'status'=> '1','message'=>'Success', 'data'=> $event_data_with_user));
				exit;
			} else {
				echo json_encode(array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found')); die;
			}
			
		}
	}
	
	/* 
	 *Events list function for app
	 *Created by Kamlesh on 26 July
	*/
	function getEvents() { 
		$this->layout='default';
		 $pagesize=20;
		 $page=1;
		 $offset=0;
		 
		 if(!empty($this->request->query['page']) ) {
			$page=$this->request->query['page'];
		 }
		 $this->layout="";
		 $this->loadModel('Event');
		 $this->loadModel('Favourite');
		
		if(empty($this->request->query['user_id'])) {
				$error="Please enter user id";
				echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
		}
		$conditions = array();
		  $order='Event.start_at DESC';
		  $type='myevent';
		if (!empty($this->request->query['event_title'])) {
		   $conditions['Event.event_title LIKE'] = '%'.trim($this->request->query['event_title']).'%';
		}
		if (!empty($this->request->query['location'])) {
		   $conditions['Event.location LIKE'] = '%'.trim($this->request->query['location']).'%';
		}
		if(!empty($this->request->query['pagesize'])) {
			$pagesize=$this->request->query['pagesize'];
		}
		if($page==1){
			$offset = 0;
		 }else{
			$offset= $pagesize*($page-1);
		}
		if (!empty($this->request->query['user_id']) && !empty($this->request->query['other']) && $this->request->query['other']=='common') {
			if($this->request->query['etype']=='favourite') {
				$user_id = $this->request->query['user_id'];
				$fpostdata = $this->Favourite->find('all',
									array('conditions' => 
										array('Favourite.user_id' => $user_id , 'Favourite.favourite'=>1)
									)
								); 
					$i=0;
					$f_data=array();
					foreach($fpostdata as $cdata) {
					if($cdata['Favourite']['event_id'] !=0) {
							$f_data[$i]=$cdata['Favourite']['event_id'];
							$i++;
					}
					
					}
				$conditions['Event.id']=$f_data;
		  } else if($this->request->query['etype']=='attended') {  
		   		$this->loadModel('Attendee');
		 		$attended_data=array();
		 		$user_id = $this->request->query['user_id'];
				$attended_event = $this->Attendee->find('all',
									array('conditions' => 
										array('Attendee.user_id' => $user_id)
									)
								);
								
					$i=0;
					foreach($attended_event as $adata) {
					if($adata['Attendee']['event_id'] !=0) {
							$attended_data[$i]=$adata['Attendee']['event_id'];
							$i++;
					}
					} 
					if($attended_data){
					$conditions['Event.id']=$attended_data;
					} else {
					$conditions['Event.id']=0;
					}
		 } else {
		 		$this->loadModel('Invite');
		 		$invite_data=array();
		 		$user_id = $this->request->query['user_id'];
				$invite_event = $this->Invite->find('all',
									array('conditions' => 
										array('Invite.user_id' => $user_id)
									)
								);	
					$i=0;
					foreach($invite_event as $adata) {
					if($adata['Invite']['event_id'] !=0) {
							$invite_data[$i]=$adata['Invite']['event_id'];
							$i++;
					}
					} 
					if($invite_data){
						$conditions['Event.id']=$invite_data;
					} else {
						$conditions['Event.id']=0;
					}
		 	
		 }
		} else {
				if(empty($this->request->query['type']) && $this->request->query['type'] !='previous' && $this->request->query['type'] !='upcoming') {
						$error="Please enter type of events (upcoming or previous)";
						echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
				 }
				 
				 
				 //Abuse Event will not see in event list based on user
				$this->loadModel('Abuse');
		 		$abuse_data=array();
		 		$user_id = $this->request->query['user_id'];
				$abuse_event = $this->Abuse->find('all',
									array('conditions' => 
										array('Abuse.user_id' => $user_id)
									)
								);	
					$i=0;
					foreach($abuse_event as $adata) {
					if($adata['Abuse']['event_id'] !=0) {
							$abuse_data[$i]=$adata['Abuse']['event_id'];
							$i++;
					}
					} 
				//	pr($abuse_data); die;
				$conditions['NOT']= array( "Event.id" =>$abuse_data);
				$type=$this->request->query['type'];
					if($type=="upcoming") {
						$order='Event.start_at ASC';
						$conditions['Event.end_at  > ']=date('Y-m-d H:i:s');
					} else if($type=="previous"){
						$order='Event.start_at DESC';
						$conditions['Event.end_at  < ']=date('Y-m-d H:i:s');
					}
					$conditions['Event.eventype']=0;
		}
		$conditions['Event.status']=1;
		$this->Event->recursive = 1;
		$previous_event=array();
		$upcoming_event=array();
		//$conditions['Event.eventdate > ']=date('Y-m-d');
		 
		$data = $this->Event->find('all', array('conditions'=>$conditions,'order' => 'Event.id ASC'));
		$total_event = count($data);
		if($total_event < 1){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> "No record found!")); die;
		}else{			
			$this->paginate = array('order' => $order, 'limit' => $pagesize,'offset'=>$offset);
			$event_data=$this->paginate('Event',$conditions);
			
		//	pr($event_data); die;
			$event_data_with_user=array();
			$i=0;
			if(count($event_data)>0) {
				foreach($event_data as $event) {
				$event_data_with_user[$i]['id']=$event['Event']['id'];
				$event_data_with_user[$i]['user_id']=$event['Event']['user_id'];
				$event_data_with_user[$i]['event_title']=$event['Event']['event_title'];
				$event_data_with_user[$i]['description']=$event['Event']['description'];
				$event_data_with_user[$i]['location']=$event['Event']['location'];
				$event_data_with_user[$i]['start_at']=$event['Event']['start_at'];
				$event_data_with_user[$i]['end_at']=$event['Event']['end_at'];
				$event_data_with_user[$i]['upload_id']=$event['Event']['upload_id'];
				$event_data_with_user[$i]['eventdate']=$event['Event']['eventdate'];
				$event_data_with_user[$i]['lat']=$event['Event']['lat'];
				$event_data_with_user[$i]['lng']=$event['Event']['lng'];
				$event_data_with_user[$i]['eventype']=$event['Event']['eventype'];
				$event_data_with_user[$i]['status']=$event['Event']['status'];
				$event_data_with_user[$i]['createdon']=$event['Event']['createdon'];
				$event_data_with_user[$i]['abuse']=$event['Event']['abuse'];
				$event_data_with_user[$i]['etype']=$type;
				$event_data_with_user[$i]['username']=$this->Api->fetchUserName($event['Event']['user_id']);
				$event_data_with_user[$i]['profilepic']=$this->Api->fetchUserImage($event['Event']['user_id']);
				$event_data_with_user[$i]['url']=$this->Api->fetchEventImage($event['Event']['upload_id']);
				$i++;
				}
				echo json_encode(array('total'=>$total_event ,'status'=> '1','message'=>'Success', 'data'=> $event_data_with_user));
				exit;
			} else {
				echo json_encode(array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found')); die;
			}
			
		}
	}
	
	function getRepliesOnComment($post_id=NULL) {
		$this->loadModel('Comment');
		$co_data=array();
		if(empty($post_id)) {
			$error='Post id is empty.';
		} else {
			$conditions['Comment.post_id']=$post_id;
			$comment_data = $this->Comment->find('all', array('conditions'=>$conditions,'order' => 'Comment.id DESC'));
			if(count($comment_data)) {
			$i=0;
				foreach($comment_data as $cdata) {
					$co_data[$i]=$cdata['Comment'];
					$co_data[$i]['username']=$this->Api->fetchUserName($cdata['Comment']['user_id']);
					$co_data[$i]['profilepic']=$this->Api->fetchUserImage($cdata['Comment']['user_id']);
					$i++;
				}
				return $co_data;
			}
		}
	}
	
	function GetPostData($event_id) {
		 $this->layout='default';
		 $this->layout="";
		 $this->loadModel('Post');
		 $conditions = array();
		 $conditions['Post.status']=1;
		 $this->Post->recursive = 1;
		 $conditions['Post.event_id']=$event_id;
		 $post_data = $this->Post->find('all', array('conditions'=>$conditions,'order' => 'Post.id DESC')); 
		 $total_post = count($post_data);
		 if($total_post < 1){
			return array('error_code'=> '1','status'=> '0', 'message'=> "No record found!"); die;
		 }else{			
			$i=0;
			if(count($post_data)>0) {
			$comment_array=array();
			$mime_array=array();
			$post_arr=array();
			 foreach($post_data as $post) {
				$post['Post']['username']=$this->Api->fetchUserName($post['Post']['user_id']);
				$post['Post']['profilepic']=$this->Api->fetchUserImage($post['Post']['user_id']);
				if($post['Post']['type']=="comment") {
						if($this->getRepliesOnComment($post['Post']['id'])!=NULL) {
							$post['Post']['replies']=$this->getRepliesOnComment($post['Post']['id']);
						} else {
							$post['Post']['replies']=[];
						}
						array_push($comment_array,$post);
						
					} else if($post['Post']['type']=="image" || $post['Post']['type']=="video"){
						array_push($mime_array,$post);
					}  
				$i++;
				} 
				$post_arr=array('comment'=>$comment_array,'mime_post'=>$mime_array );
				return array('total'=>$total_post ,'status'=> '1','message'=>'Success', 'data'=> $post_arr);
				exit;
			} else {
				return array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found'); die;
			}
		}
	}
	
	function GetPostDataByUser($user_id) {
		 $this->layout='default';
		 $this->layout="";
		 $this->loadModel('Post');
		 $conditions = array();
		 $conditions['Post.status']=1;
		 $this->Post->recursive = 1;
		 $conditions['Post.user_id']=$user_id;
		 $post_data = $this->Post->find('all', array('conditions'=>$conditions,'order' => 'Post.id DESC')); 
		 $total_post = count($post_data);
		 if($total_post < 1){
			return array('error_code'=> '1','status'=> '0', 'message'=> "No record found!"); die;
		 }else{			
			$i=0;
			if(count($post_data)>0) {
			$comment_array=array();
			$mime_array=array();
			$post_arr=array();
			 foreach($post_data as $post) {
				$post['Post']['username']=$this->Api->fetchUserName($post['Post']['user_id']);
				$post['Post']['profilepic']=$this->Api->fetchUserImage($post['Post']['user_id']);
				if($post['Post']['type']=="comment") {
						array_push($comment_array,$post);
					} else if($post['Post']['type']=="image" || $post['Post']['type']=="video"){
						array_push($mime_array,$post);
					}  
				$i++;
				} 
				$post_arr=array('comment'=>$comment_array,'mime_post'=>$mime_array );
				return array('total'=>$total_post ,'status'=> '1','message'=>'Success', 'data'=> $post_arr);
				exit;
			} else {
				return array('total'=>0 ,'status'=> '0','message'=>'Success', 'data'=> 'No Data found'); die;
			}
		}
	}
	
	
	function attendeesCount($event_id=NULL) {
		$this->loadModel('Attendee');
		$co_data=array();
		if(empty($event_id)) {
			$error='Event id is empty.';
		} else {
			$acount = $this->Attendee->find('count',
								array('conditions' => 
									array('Attendee.event_id' => $event_id)
								)
							);
			return $acount;
		}
	}
	function attendeesUserCount($user_id=NULL) {
		$this->loadModel('Attendee');
		$co_data=array();
		if(empty($user_id)) {
			$error='User id is empty.';
		} else {
			$acount = $this->Attendee->find('count',
								array('conditions' => 
									array('Attendee.user_id' => $user_id)
								)
							);
			return $acount;
		}
	}
	
	function getAttendees($event_id=NULL) {
		$this->loadModel('Attendee');
		$co_data=array();
		if(!isset($this->request->query['event_id'])) {
			$error='Please enter event id.'; 
		} else {
		$event_id=$this->request->query['event_id'];
			$attendees = $this->Attendee->find('all',
								array('conditions' => 
									array('Attendee.event_id' => $event_id)
								)
							);
			$attendees_arry=array();
			$i=0;
			foreach($attendees as $user) {
				if(count($user)>0) {
					$attendees_arry[$i]['event_id']=$user['Attendee']['event_id'];
					$attendees_arry[$i]['username']=$this->Api->fetchUserName($user['Attendee']['user_id']);
					$attendees_arry[$i]['profilepic']=$this->Api->fetchUserImage($user['Attendee']['user_id']);
					$attendees_arry[$i]['user_id']=$user['Attendee']['user_id'];
					$attendees_arry[$i]['event_name']=$this->Api->fetchEventName($user['Attendee']['event_id']);
					$i++;
				}
			}   	
		}
			if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
					die;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'data'=> $attendees_arry)); die;
			}
		
	}
	
	function getEventDetail() {
		//print_r($this->request->query); die;
		$this->loadModel('Event');
		$this->loadModel('Invite');
		$this->loadModel('Notify');
		
		$conditions = array();
		if(!isset($this->request->query['event_id'])) {
			$error='Please enter event id.'; 
		} else if(!isset($this->request->query['user_id'])) {
			$error='Please enter user id.'; 
		} else {
			$user_id=$this->request->query['user_id'];
			$event_id=$this->request->query['event_id'];
			$invite_count=$this->Notify->find('count', array('conditions' => array('event_id' => $event_id,'type'=>'invitation')));
			$event_id=$this->request->query['event_id'];
			$conditions['Event.id'] =$event_id;
			$data = $this->Event->find('first', array('conditions'=> $conditions));
			$data['Event']['profilepic']=$this->Api->fetchUserImage($data['Event']['user_id']);
			$data['Event']['username']=$this->Api->fetchUserName($data['Event']['user_id']);
			$data['Event']['banner']=$this->Api->fetchEventImage($data['Event']['upload_id']);
			$e_arr=array();	
			$e_arr['id'] = $data['Event']['id'];
            $e_arr['user_id'] = $data['Event']['user_id'];
            $e_arr['event_title'] = $data['Event']['event_title'];
            $e_arr['description'] = $data['Event']['description'];
            $e_arr['location'] = $data['Event']['location'];
            $e_arr['start_at'] = $data['Event']['start_at'];
            $e_arr['end_at'] = $data['Event']['end_at'];
            $e_arr['upload_id'] = $data['Event']['upload_id'];
            $e_arr['eventdate'] = $data['Event']['eventdate'];
            $e_arr['lat'] = $data['Event']['lat'];
            $e_arr['lng'] = $data['Event']['lng'];
            $e_arr['eventype'] =$data['Event']['eventype'];
            $e_arr['status'] = $data['Event']['status'];
            $e_arr['createdon'] = $data['Event']['createdon'];
            $e_arr['abuse'] = $data['Event']['abuse'];
            $e_arr['profilepic'] = $data['Event']['profilepic'];
            $e_arr['username'] = $data['Event']['username'];
            $e_arr['banner'] = $data['Event']['banner'];
            $e_arr['max_zoom'] = $data['Event']['max_zoom'];
            $e_arr['postdata'] = $this->GetPostData($data['Event']['id']);
            $e_arr['invite_count'] = $invite_count;
            $e_arr['attendees_count'] = $this->attendeesCount($data['Event']['id']);
            $e_arr['fstatus'] = $this->getEventFauouriteStatus($event_id,$user_id);
            
            		$start_event_time=strtotime($data['Event']['start_at']);
					$current_time=strtotime(date("Y-m-d H:i:s"));
					$end_event_time=strtotime($data['Event']['end_at']);
					if(($start_event_time > $current_time)) { 
						 $error = 'Event does not start right now so you can not post on this event';
						 $e_arr['estatus']=2;
						 $e_arr['emsg']=$error;
					} 
					if(($end_event_time < $current_time)) { 
						$error = 'Event time have expired .Now you can not post on this event';
						 $e_arr['estatus']=3;
						 $e_arr['emsg']=$error;
					} 
			$e_arr['user_notification_settings'] = $this->getNotificationSetting($data['Event']['user_id']);
            if(strtotime($data['Event']['end_at']) > strtotime(date('Y-m-d H:i:s'))) {
					$e_arr['type']="upcoming";
				} else {
					$e_arr['type']="previous";
				}
            
            echo json_encode(array('message'=> 'success','status'=> '1', 'data'=> $e_arr));
			die;
		}
		if(!empty($error)){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
			die;
		} else {
			echo json_encode(array('message'=> 'success','status'=> '1', 'data'=> $e_arr));
		}
	}
	
	function getContactUsers() {
		$this->loadModel('User');
		if($this->request->is('post') && $this->data){
		
				$this->loadModel('User');
				$conditions = array();
				if(empty($this->data['contacts'])) {
					$error='Please enter contacts.';
				} else {
					$dataar=explode(",",$this->data['contacts']);
					$userdata=$this->User->find('all', array('conditions' => array('mobile' => $dataar)));
					$user_array=array();
					$i=0;
					foreach($userdata as $user) {
						$user_array[$i]['id']=$user['User']['id'];
						$user_array[$i]['username']=$user['User']['username'];
						$user_array[$i]['image']=$this->Api->fetchUserImage($user['User']['id']);
						$user_array[$i]['countryname']=$this->Api->fetchCountryName($user['User']['iso']);
						$i++;
					}
				}
				if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error)); exit;
					
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'data'=> $user_array)); exit;
				}
		}
	}
	function getNotification() { 
		 $this->layout="";
		$this->loadModel('User');
		$this->loadModel('Invite');
		$this->loadModel('Notify');
		$not_arry=array();
		$events_arry=array();
		$read=0;
		$unread=0;
		if($this->request->is('post') && $this->data){
				$conditions = array();
				$not_arry=array();
				if(empty($this->data['user_id'])) {
					$error='Please enter user id.';
				}  else {
				
					$user_id=$this->data['user_id'];
					/*
					$invite_data=$this->Invite->find('all', array('conditions' => array('user_id' => $user_id)));
					
					
					$events_arry=array();
					$i=0;
					foreach($invite_data as $user) {
						if(count($user)>0) {
							if($user['Invite']['accepted']==0) {$msg='unread';$unread++;} else {$msg='read';$read++;}
							$events_arry[$i]['invitation_id']=$user['Invite']['id'];
							$events_arry[$i]['event_id']=$user['Invite']['event_id'];
							$events_arry[$i]['status']=$user['Invite']['accepted'];
							$events_arry[$i]['username']=$this->Api->fetchUserName($user['Invite']['login_id']);
							$events_arry[$i]['profilepic']=$this->Api->fetchUserImage($user['Invite']['login_id']);
							$events_arry[$i]['user_id']=$user['Invite']['login_id'];
							$events_arry[$i]['event_name']=$this->Api->fetchEventName($user['Invite']['event_id']);
							$i++;
						}
					}  */
					//'OR' =>array('event_creater_id'=>$user_id,'post_creater_id'=>$user_id);
					$post_notification_data=$this->Notify->find('all', array('conditions' => array('OR' =>array('event_creater_id'=>$user_id,'post_creater_id'=>$user_id,'user_id'=>$user_id)),'order'=>'Notify.id DESC'));
					$j=0;
					$m=0;
					$p=0;
					$pcomment_notification=array();
					$comment_notification=array();
					
					foreach($post_notification_data as $user) {
						if(count($user)>0) {
						if($user['Notify']['type']=='post' || $user['Notify']['type']=='postcomment' || $user['Notify']['type']=='comment') {
							if($user['Notify']['status']==0) {$unread++;} else {$read++;}
						} else  {
							if($user['Notify']['accepted']==0) {$unread++;} else {$read++;}
						}
								$not_arry[$j]['notify_id']=$user['Notify']['id'];
								$not_arry[$j]['event_id']=$user['Notify']['event_id'];
								$not_arry[$j]['username']=$this->Api->fetchUserName($user['Notify']['user_id']);
								$not_arry[$j]['profilepic']=$this->Api->fetchUserImage($user['Notify']['user_id']);
								$not_arry[$j]['user_id']=$user['Notify']['user_id'];
								$not_arry[$j]['event_creater_id']=$user['Notify']['event_creater_id'];
								$not_arry[$j]['type']=$user['Notify']['type'];
								$not_arry[$j]['status']=$user['Notify']['status'];
								$not_arry[$j]['accepted']=$user['Notify']['accepted'];
								$not_arry[$j]['event_name']=$this->Api->fetchEventName($user['Notify']['event_id']);
								$j++;
							
						}
					} 
					echo json_encode(array('error_code'=> '0','status'=> '1','unread'=>$unread,'read'=>$read,'notification'=>$not_arry, 'event_ids'=> $events_arry,'count'=>count($events_arry) + count($not_arry))); exit;
				}
		}
		if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
					exit;;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1','post_notification'=>$not_arry, 'event_ids'=> $events_arry,'count'=>count($events_arry))); exit;
				}
	}
	
	function setNotificationStatus() {
		if($this->request->is('get')){
            $this->layout='none';
			$conditions=array();
			if(empty($this->request->query['notify_id'])){
			    $error='Please enter notify id.';  
			} else {
					$this->loadModel('Notify');
					$notify_id=$this->request->query['notify_id'];
					$data['Notify']['id'] = $notify_id;
					$data['Notify']['status'] = 1;
					$this->Notify->save($data, false); 
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Success', 'status'=> '1', 'error'=> '0');
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	
	function setIvitationStatus() {
		if($this->request->is('get')){
            $this->layout='none';
			$conditions=array();
			if(empty($this->request->query['notify_id'])){
			    $error='Please enter notify id.';  
			} else if(!isset($this->request->query['accepted'])){
			    $error='Please enter accepted id.';  
			} else {
					$this->loadModel('Notify');
					$notify_id=$this->request->query['notify_id'];
					$data['Notify']['id'] = $notify_id;
					$data['Notify']['accepted'] = $this->request->query['accepted'];
					$this->Notify->save($data, false); 
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Success', 'status'=> '1', 'error'=> '0');
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	
	function setIvitationStatus_old() {
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			$conditions=array();
			if(empty($this->data['invitation_id'])){
			    $error='Please enter invitation id.';  
			} else if(!isset($this->data['accepted'])){
			    $error='Please enter accepted id.';  
			} else if(!isset($this->data['event_id'])){
			    $error='Please enter event id.';  
			} else {
					$event_id=$this->data['event_id'];
					$this->loadModel('Invite');
					//$getdata = $this->Api->checkExitsUser($username);
					//$conditions['user_id']=$this->data['user_id'];
					//$conditions['event_id']=$this->data['event_id'];
					$invitation_id=$this->data['invitation_id'];
					$invitedata = $this->Invite->findById($invitation_id);
					$host_id=$invitedata['Invite']['login_id'];
					$data['Invite']['id'] = $invitedata['Invite']['id'];
					$data['Invite']['accepted'] = $this->data['accepted'];
					if($this->data['accepted']==2){$f='Reject';} else {$f='Accept';}
					//Notification send data
					$device_data=$this->getUserDevice($host_id);
					if($device_data['device_type']=='A') {
					$device_token=array($device_data['device_token']);
					$username=$this->Api->fetchUserName($invitedata['Invite']['user_id']);
					$profilepic=$this->Api->fetchUserImage($invitedata['Invite']['user_id']);
						$msg = array
						 (
							'message' 	=> $username.' '. $f .' your invitation of event '.$this->Api->fetchEventName($event_id),
							'title'		=> 'Orber',
							'type'      =>'invitation_notify',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'notify_id' => $this->data['invitation_id'],
							'event_creater_id'=>$host_id,
							'event_id'=> $invitedata['Invite']['event_id'],
							'user_id' => $invitedata['Invite']['user_id'],
							'notId'=>''.time()
						);
						$fields = array
						(
							'registration_ids' 	=> $device_token,
							'data'			=> $msg
						);
					
					$result=$this->send_push_notification($device_token,$fields);
					}
					
					//Notification send end  data
					
					
					$this->Invite->save($data, false); 
					//$eventInfo = $this->Api->findEventByID($eventId, $fields);
					$response_arry = array('message'=> 'Success', 'status'=> '1', 'error'=> '0');
			}
		}else{
			$error='Please send parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	function inviteFriends() {
		$this->loadModel('User');
		$this->loadModel('Notify');
		$message='';
		if($this->request->is('post') && $this->data){
				$conditions = array();
				if(empty($this->data['event_id'])) {
					$error='Please enter event id.';
				} else if(empty($this->data['login_id'])) {
					$error='Please enter login id.';
				} else if(empty($this->data['users'])) {
					$error='Please enter users ids.';
				} else {
					$event_id=$this->data['event_id'];
					$login_id=$this->data['login_id'];
					$dataar=explode(",",$this->data['users']);
					$i=0;
					
					foreach($dataar as $user) {
						$notify_array=array();
						$notify_array['Notify']['event_id']=$event_id;
						$notify_array['Notify']['user_id']=$dataar[$i];
						$notify_array['Notify']['accepted']=0;
						$notify_array['Notify']['type']='invitation';
						$notify_array['Notify']['login_id']=$login_id;
						$ndata=$this->getNotificationSetting($dataar[$i]);
						
						if($ndata){
							$inv_flag=$ndata['Notification']['invitation'];
						} else {
							$inv_flag=2;
						}
						if($this->Api->checkExitsInvites($dataar[$i],$event_id) == 0) {
							if($inv_flag==2) {
							$this->loadModel('Notify');
								$this->Notify->create();
								
								if($this->Notify->save($notify_array)){
									//Send notification to user for notification
									$device_data=$this->getUserDevice($dataar[$i]);
									if($device_data['device_type']=='A') {
									$device_token=array($device_data['device_token']);
									$username=$this->Api->fetchUserName($login_id);
									$profilepic=$this->Api->fetchUserImage($login_id);
										$msg = array
										 (
											'message' 	=> $username. ' invite you to '. $this->Api->fetchEventName($event_id),
											'title'		=> 'Orber',
											'type'      =>'eventinvitation',
											'vibrate'	=> 1,
											'sound'		=> 1,
											'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
											'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
											'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
											'sender_id'=>$login_id,
											'event_id'=>$event_id,
											'user_id' => $dataar[$i],
											'notId'=>''.time()
										);
										$fields = array
										(
											'registration_ids' 	=> $device_token,
											'data'			=> $msg
										);
					
									$result=$this->send_push_notification($device_token,$fields);
					
									}
									
									//End Notification to user
									
									
									$message="Data saved successfully";
								} else {
								$message="Data saved successfully";
							}
							}
							
						} else {
							$message ="You have already invited some users";
						}
						
						
						$i++;
					}
				}
				
				if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
					die;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'message'=> $message)); die;
				}
		}
	}
	
	function inviteFriends_old() {
		$this->loadModel('User');
		$this->loadModel('Invite');
		$message='';
		if($this->request->is('post') && $this->data){
				$conditions = array();
				if(empty($this->data['event_id'])) {
					$error='Please enter event id.';
				} else if(empty($this->data['login_id'])) {
					$error='Please enter login id.';
				} else if(empty($this->data['users'])) {
					$error='Please enter users ids.';
				} else {
					$event_id=$this->data['event_id'];
					$login_id=$this->data['login_id'];
					$dataar=explode(",",$this->data['users']);
					$i=0;
					
					foreach($dataar as $user) {
						$invite_array=array();
						$invite_array['Invite']['event_id']=$event_id;
						$invite_array['Invite']['user_id']=$dataar[$i];
						$invite_array['Invite']['accepted']=0;
						$invite_array['Invite']['login_id']=$login_id;
						$ndata=$this->getNotificationSetting($dataar[$i]);
						
						if($ndata){
							$inv_flag=$ndata['Notification']['invitation'];
						} else {
							$inv_flag=2;
						}
						if($this->Api->checkExitsInvites($dataar[$i],$event_id) == 0) {
							if($inv_flag==2) {
								$this->Invite->create();
								
								if($this->Invite->save($invite_array)){
									//Send notification to user for notification
									$device_data=$this->getUserDevice($dataar[$i]);
									if($device_data['device_type']=='A') {
									$device_token=array($device_data['device_token']);
									$username=$this->Api->fetchUserName($login_id);
									$profilepic=$this->Api->fetchUserImage($login_id);
										$msg = array
										 (
											'message' 	=> $username. ' invite you to '. $this->Api->fetchEventName($event_id),
											'title'		=> 'Orber',
											'type'      =>'eventinvitation',
											'vibrate'	=> 1,
											'sound'		=> 1,
											'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
											'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
											'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
											'sender_id'=>$login_id,
											'event_id'=>$event_id,
											'user_id' => $dataar[$i],
											'notId'=>''.time()
										);
										$fields = array
										(
											'registration_ids' 	=> $device_token,
											'data'			=> $msg
										);
					
									$result=$this->send_push_notification($device_token,$fields);
					
									}
									
									//End Notification to user
									
									
									$message="Data saved successfully";
								} else {
								$message="Data saved successfully";
							}
							}
							
						} else {
							$message ="You have already invited some users";
						}
						
						
						$i++;
					}
				}
				
				if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
					die;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'message'=> $message)); die;
				}
		}
	}
	function invities() {
		$this->loadModel('User');
		$this->loadModel('Notify');
		
		if($this->request->is('post') && $this->data){
				$conditions = array();
				if(empty($this->data['event_id'])) {
					$error='Please enter event id.';
				}  else {
					$event_id=$this->data['event_id'];
					$invite_data=$this->Notify->find('all', array('conditions' => array('event_id' => $event_id,'type'=>'invitation')));
					$invites_arry=array();
					$i=0;
					foreach($invite_data as $user) {
						if(count($user)>0) {
							$invites_arry[$i]['username']=$this->Api->fetchUserName($user['Notify']['user_id']);
							$invites_arry[$i]['profilepic']=$this->Api->fetchUserImage($user['Notify']['user_id']);
							$invites_arry[$i]['user_id']=$user['Notify']['user_id'];
							$i++;
						}
					} 
				}
				if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
					die;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'data'=> $invites_arry,'count'=>count($invites_arry))); die;
				}
		}
	}
	
	
	function invitationList() {
		$this->loadModel('User');
		$this->loadModel('Notify');
			$conditions = array();
			if(empty($this->request->query['user_id'])) {
				$error='Please enter user id.';
			}  else {
				$user_id=$this->request->query['user_id'];
				$invite_data=$this->Notify->find('all', array('conditions' => array('login_id' => $user_id)));
				$invites_arry=array();
				$i=0;
				foreach($invite_data as $user) {
					if(count($user)>0) {
						$invites_arry[$i]['username']=$this->Api->fetchUserName($user['Notify']['user_id']);
						$invites_arry[$i]['profilepic']=$this->Api->fetchUserImage($user['Notify']['user_id']);
						$invites_arry[$i]['user_id']=$user['Notify']['user_id'];
						$invites_arry[$i]['event_name']=$this->Api->fetchEventName($user['Notify']['event_id']);
						$i++;
					}
				} 
			}
			if(!empty($error)){
				echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
				die;
			} else {
				echo json_encode(array('error_code'=> '0','status'=> '1', 'data'=> $invites_arry,'count'=>count($invites_arry))); die;
			}
		
	}
	
	function acceptEvent() { 
		$this->loadModel('Invite');
		if($this->request->is('post') && $this->data){
				$conditions = array();
				if(empty($this->data['event_id'])) {
					$error='Please enter event id.';
				} else if(empty($this->data['users'])) {
					$error='Please enter users ids.';
				} else {
					$event_id=$this->data['event_id'];
					$dataar=explode(",",$this->data['users']);
					$i=0;
					foreach($dataar as $user) {
						$invite_array=array();
						$invite_array['Invite']['event_id']=$event_id;
						$invite_array['Invite']['user_id']=$dataar[$i];
						$invite_array['Invite']['accepted']=0;
						$this->Invite->create();
						$this->Invite->save($invite_array);
						$i++;
					}
				}
				if(!empty($error)){
					echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
					die;
				} else {
					echo json_encode(array('error_code'=> '0','status'=> '1', 'message'=> 'data saved successfully')); die;
				}
		}
	}
	
	/* 
	 *Create event function for app
	 *Created by Kamlesh on 26 July
	*/
	function addComment(){
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			if(empty($this->data['post_id'])){
				$error='Please enter post id.';
			}else if(empty($this->data['comment'])){
			    $error='Please enter comment.';  
			} else if(empty($this->data['user_id'])){
			    $error='Please enter user id.';  
			}  else {
					if(isset($this->data['rflag'])) {$fl=1;} else {$fl=0;}
					$this->loadModel('Comment');
					$this->loadModel('Notify');
					$this->loadModel('Post');
					$data['Comment']['post_id'] = $this->data['post_id'];
					$data['Comment']['user_id'] = $this->data['user_id'];
					$data['Comment']['comment'] = $this->data['comment'];
					$data['Comment']['date']=date("Y-m-d H:i:s");
					
					$user_data=$this->Post->find('first' , array('conditions'=>array('Post.id'=>$this->data['post_id'])));
					$post_creator_id=$user_data['Post']['user_id'];
					$event_id=$user_data['Post']['event_id'];
					if($this->Comment->save($data)) {
						$commentId = $this->Comment->getLastInsertId();
						$data_array['id']=$commentId;
						$data_array['comment']=$this->data['comment'];
						$data_array['user_id']=$this->data['user_id'];
						$data_array['username']=$this->Api->fetchUserName($this->data['user_id']);
						$data_array['profilepic']=$this->Api->fetchUserImage($this->data['user_id']);
						
						//Save data in notifies table
						
						$notify_data['Notify']['user_id']=$this->data['user_id'];
						$notify_data['Notify']['event_id']=$user_data['Post']['event_id'];
						$notify_data['Notify']['post_id']=$this->data['post_id'];
						$notify_data['Notify']['post_creater_id']=$post_creator_id;
						$notify_data['Notify']['status']=0;
						$notify_data['Notify']['type']='postcomment';
						$notify_data['Notify']['created']=date('Y-m-d H:i:s');
						$this->Notify->save($notify_data, false);
						$notify_id=$this->Notify->getLastInsertId();
						
						//
						$event_name=$this->Api->fetchEventName($event_id);
					$device_data=$this->getUserDevice($post_creator_id);
					if($device_data['device_type']=='A') {
					$device_token=array($device_data['device_token']);
					$username=$this->Api->fetchUserName($this->request->data['user_id']);
					$profilepic=$this->Api->fetchUserImage($this->request->data['user_id']);
						$msg = array
						 (
							'message' 	=> $username. ' comment on your post at '.$event_name,
							'title'		=> 'Orber',
							'type'      =>'postcomment',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'icon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'smallIcon'	=> 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'launchImage' => 'http://flexsin.org/lab/mobilewebservice/orberCMS/img/userImg/'.$profilepic,
							'post_creater_id'=>$post_creator_id,
							'event_id'=>$event_id,
							'notify_id' => $notify_id,
							'user_id' => $this->request->data['user_id'],
							'post_id'=>$this->data['post_id'],
							'comment'=>$this->data['comment'],
							'profilepic' =>$profilepic,
							'notId'=>''.time()
						);
						$fields = array
						(
							'registration_ids' 	=> $device_token,
							'data'			=> $msg
						);
					if($fl==0) {
						$result=$this->send_push_notification($device_token,$fields);
					}
				
					}
						
						$response_arry = array('message'=> 'Comment add successfully', 'status'=> '1', 'error'=> '0','comment'=>$data_array);
					}  else {
						$response_arry = array('message'=> 'There is some problem in adding post plese see', 'status'=> '0', 'error'=> '1');
					}
					
			}
		}else{
			$error='Please send post parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	function addReply(){
		if($this->request->is('post') && $this->data){
            $this->layout='none';
			if(empty($this->data['post_id'])){
				$error='Please enter post id.';
			}else if(empty($this->data['comment_id'])){
			    $error='Please enter comment id.';  
			} else if(empty($this->data['reply'])){
			    $error='Please enter reply comment.';  
			} else if(empty($this->data['user_id'])){
			    $error='Please enter user id .';  
			} else {
					$this->loadModel('Reply');
					$data['Reply']['comment_id'] = $this->data['comment_id'];
					$data['Reply']['post_id'] = $this->data['post_id'];
					$data['Reply']['user_id'] = $this->data['user_id'];
					$data['Reply']['comment'] = $this->data['reply'];
					$data['Reply']['date']=date("Y-m-d H:i:s");
					if($this->Reply->save($data)) {
						$response_arry = array('message'=> 'Reply add successfully', 'status'=> '1', 'error'=> '0','Reply'=>$this->data['reply']);
					}  else {
						$response_arry = array('message'=> 'There is some problem in adding post plese see', 'status'=> '0', 'error'=> '1');
					}
					
			}
		}else{
			$error='Please send post parameter first.';
		}
		if(!empty($error)){
          $response_arry = array('error_code'=> '1','status'=> '0', 'message'=> $error);
        }
		echo json_encode($response_arry); exit;
	}
	
	function cropImages(){
		if($this->request->is('post') && $this->data){
			$this->layout='none';
			$this->loadModel('User');
			$error = '';
			if(empty($this->data['imagename'])){
				$error='Please enter image name';
			} else if(empty($this->data['imagetype'])){
				$error='Please enter image type';
			} else {
			$type=$this->data['imagetype'];
			//echo WWW_ROOT; die;
				
				if($type=='banner') {
					$targ_w = 640;
   					$targ_h=280;
   					$src=WWW_ROOT.'img/eventbanner/'.$this->data['imagename'];
					$save=WWW_ROOT.'img/eventbanner/'.$this->data['imagename'];	
				} else {
					$targ_w = 100;
   					$targ_h=100;
   					$src=WWW_ROOT.'img/userImg/'.$this->data['imagename'];
				$save=WWW_ROOT.'img/userImg/'.$this->data['imagename'];
				}
				
   				$width=$this->data['w'];
   				$height=$this->data['h'];
   				$x=$this->data['x'];
   				$y=$this->data['y'];
    			$jpeg_quality = 90;
    			//pr($this->data); die;
    			$img_r = imagecreatefromjpeg($src);
    			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
    			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$width,$height);
				imagejpeg($dst_r,$save ,$jpeg_quality);
				echo json_encode(array('status'=> '1', 'message'=> 'success','cropimage'=>$this->data['imagename'])); die;
			}
			
		} else { 
			$error='Request data is required';
		}
		if(!empty($error)){
			echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
		}
	}
	
	
	function getPage() {
		//print_r($this->request->query); die;
		$this->loadModel('CmsPage');
		
		
			$page_data = $this->CmsPage->find('all');
            
            echo json_encode(array('message'=> 'success','status'=> '1', 'data'=> $page_data));
			die;
		
		if(!empty($error)){
			echo json_encode(array('error_code'=> '1','status'=> '0', 'message'=> $error));
			die;
		} else {
			echo json_encode(array('message'=> 'success','status'=> '1', 'data'=> $e_arr));
		}
	}
	
	
	public function getcountrylist() {
		$this->loadModel('Country');
		$return = '';
		$countries = $this->Country->find('all');
		$data=array();
		$i=0;
		foreach($countries as $country) {
		$data[$i]['isocode']=$country['Country']['iso'];
		$data[$i]['name']=$country['Country']['name'];
		$data[$i]['nicename']=$country['Country']['name'];
		$data[$i]['countrycode']=SITE_PATH."img/flags/24x24/".strtolower($country['Country']['iso']).".png";
		$data[$i]['phonecode']=$country['Country']['phonecode'];
		$i++;
		}
		if(empty($data)) {
			$response_arry = array('message'=>'There is some problem plese contact server admin','status'=>'0');
		}
		else {
			$response_arry = array('message'=>'Your message has been sent successfully. ','status'=>'1','data'=>$data);
		}
		echo json_encode($response_arry);   die;
		
		
	}		
	
	
	public function Send_text_message(){ 
	    // print_r($this->data);die;
		$response_arry = array();
		if($this->data['to'] && $this->data['message']){ 
			$to = '+91'.''.$this->data['to'] ;  
			$msg =  $this->data['message'] ; 
			$response = $this->send_sms($to,$msg);
			if($response == '1'){
				 $response_arry = array('message'=>'Your message has been sent successfully. ','status'=>'1');
				 echo json_encode($response_arry); die;       
				 
			}
			else{
				$response_array = array('message'=>'Please enter correct number. ','status'=> "0"); 
			}
		}else{  
			$response_arry = array('message'=>'No data available. Please send the post data. ','status'=>'-1');
		} 
		echo json_encode($response_arry);   die;
	} 
}