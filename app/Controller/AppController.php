<?php
ob_start();
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::import('Vendor', 'constants'); 
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	 public $helpers = array('Html', 'Form', 'Session', 'Text');
	 public $components = array('Session', 'Cookie','Email','Auth','Resize','My');

        
		function beforeFilter() {
	      if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin'){
			Controller::loadModel('Admin');	
			$this->Auth->userModel = 'Admin';
			$this->layout = 'Admin/default';	
			AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->loginAction = array('controller'=>'admins','action'=>'sign_in');
            $this->Auth->logoutRedirect = array('controller'=>'admins','action'=>'sign_in');
            $this->Auth->authenticate = array(
                'Form' => array(
                    'userModel' => 'Admin',
                )
            );
            $this->Auth->allow('login','sign_in');		
		 }
			
    } 

		
	    //SEND EMAIL TO USER
		public function send_mail($mail_slug = null,$replace_var =[],$from = null,$to = null)
		{
		$this->Mail = ClassRegistry::init('Mail');
		$mail_temp = $this->Mail->find('first',array('fields' => array('description', 'subject'),'conditions'=> array('mail_slug' => $mail_slug)));
		$subject = $mail_temp['Mail']['subject'];
		$mail_temp = $mail_temp['Mail']['description'];
		foreach($replace_var as $key=>$val){
		$mail_temp = str_replace('{'.$key.'}',$val,$mail_temp);
		}
		//pr($mail_temp);die;
		$this->Email->to = $to;
		$this->Email->from = $from;
		$this->Email->subject = $subject;
		$this->Email->sendAs = 'html';
		if($this->Email->send($mail_temp))
		{
		
			return true;
		}
		else
		{
	  
			return false;
		}
		die;
	}

	public function token_check($token_id)
	{
	
	$this->layout='none';
	$this->loadModel('User');
	$tokendata=$this->User->find('first',array('conditions'=>array('User.token'=> $token_id)));
	//print_r($tokendata);die;
	if($tokendata)
		{
		
			return true;
		}
		else
		{
	     	return false;
		}
		die;
	
	}
	
	public function token_save($TokenId=null,$userId=null)
	{
		$this->loadModel('User');
		if(($TokenId!= null) && ($userId!=null)){
			//echo "hello";die;
			$detail['User']['token'] = $TokenId;
			$detail['User']['id'] = $userId;
			if($this->User->save($detail))
			{
				return true; 
			}
			else
			{
			return false;
			}
		}
		die;
	}

	function upload_image($imgName=NULL, $type=NULL){
	  
		$filename = $this->request->params['form'][$imgName]['name'];	
		    //get file extention
			$file_ext = substr($filename, strripos($filename, '.')); 
			
				if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp') {
					if($this->request->params['form'][$imgName]['error'] == 0 ){
					if($imgName=='user_image'){
					$newfilename = uniqid('usr-').$file_ext;
					$imgpath = WWW_ROOT.'img/userImg/'.$newfilename;
					}else if($type==0){
					$newfilename = uniqid('photo-').$file_ext;
					$imgpath = WWW_ROOT.'img/photos/'.$newfilename;
					}else if($type==1){
					$newfilename = uniqid('video-').$file_ext;
					$imgpath = WWW_ROOT.'img/videos/'.$newfilename;
					}
					
					$width= 225; $height=225;
					move_uploaded_file($this->request->params['form'][$imgName]['tmp_name'],$imgpath);
					if($width!='' && $height!='' && $type!=1){
						$path = $this->Resize->resize($imgpath, $width, $height);
					}
					return $newfilename;    
				}  
		}
	}
    
   //DELETE FUCTION START HERE
    public function admin_delete($id=null, $model=NULL){
	 Controller::loadModel($model);
	 if (!empty($id)) {
	    if ($this->$model->delete($id)) {
             if($model=='User'){
                 
             }			 
            $this->Session->setFlash(__('Record deleted successfully ! ', true), 'message', array('class' => 'message-green'));
            $this->redirect($this->referer());
        }
     }
    }
  
	public function noti_driver($token_id, $tAlert)
	 {
	 if(strlen($token_id)>=100){
	 
	  $apiKeyservice = "AIzaSyC43Qr6Ci2HbfmELA_Sj4-SvsUL3-2uLMQ";
	  $AndroidService[]=$token_id;
	  $registrationIDs=$AndroidService;
	  $message = $tAlert;
			$url = 'https://android.googleapis.com/gcm/send';
		   $fields = array(
			 'registration_ids'  => $registrationIDs,
			 'data' => array( "message" =>$message),
			   );
		$headers = array('Authorization: key=' . $apiKeyservice,
		'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
	 
		if ($result === FALSE) {
	  die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
	 
	  } else {
	   $tHost = 'gateway.sandbox.push.apple.com';
	   $tPort = 2195;
	   $tPassphrase = '1234';
	   $tCert ='/home/content/p3pnexwpnas14_data03/98/3037798/html/scavenger/apns-dev.pem';
	   $tToken = $token_id;
	   $tBadge = 1;
	   $tPayload = '';
	   $tBody_new['aps'] = array ('alert' => $tAlert);
	   $tBody_new ['payload'] = $tPayload;
	   $tBody = json_encode ($tBody_new);
	   $tContext = stream_context_create ();
	   stream_context_set_option ($tContext, 'ssl','local_cert',$tCert);
	   stream_context_set_option ($tContext, 'ssl','passphrase',$tPassphrase);
	   
	   $tSocket = stream_socket_client('ssl://'.$tHost.':'.$tPort,$error, $errstr, 30,STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT,$tContext);
	   if (!$tSocket)
	   exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
	   
	   $tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack 
	('n',strlen ($tBody)) . $tBody;
		$tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));
			  if ($tResult){
					$msg = 'Delivered Message to APNS' . PHP_EOL;
				  }else{
		$msg =  'Could not Deliver Message to APNS'.PHP_EOL;
				  }
				fclose ($tSocket);
	  }
	}
	
    //SEND NOTIFICATION USING TWILLIO API
	public function send_sms( $to = NULL, $msg = NULL){
        if( empty( $to ) || empty( $msg ) ){
            return false; 
        }else{
            
            require_once( APP . 'Vendor' . DS . 'twilio' . DS . 'Services' . DS . 'Twilio.php' );
			
			try {
				$client = new Services_Twilio( TWILLIO_SID, TWILLIO_TOKEN );
				
				$message = $client->account->messages->sendMessage(
						TWILLIO_FROM_PHONE_NUMBER,
						$to,
						$msg
					  );
				return true;
			}catch (Services_Twilio_RestException $e) {
				//return false;
				//echo $e->getMessage();
				echo json_encode(array('error_code'=> '3','status'=> '0', 'message'=> 'There is some error in mobile number please contact to admin')); exit;
			}
        }
    }
	
}