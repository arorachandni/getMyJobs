<?php
    App::uses('Component', 'Controller');
    App::import('Model', 'User');
    class ApiComponent extends Component {

        public $components = array('Session', 'Cookie', 'Auth');

		
		/* Functionality : for checking the user is exits or not
			Created on : 30 sep 2015
			Main Function : 'controller/home/register' */
		public function checkExitsUser($user_name=NULL) {
			$countUser = '';
			$this->User = new User();
			$countUser = $this->User->find('count',
								array('conditions' => 
									array('User.username' => $user_name)
								)
							);
            return $countUser;
        }
	public function generateToken($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}		
		public function checkExitsMobile($mob=NULL,$ccode=NULL) {
			$countUser = '';
			$this->User = new User();
			$countUser = $this->User->find('count',
								array('conditions' => 
									array('User.mobile' => $mob , 'User.countrycode' => $ccode)
								)
							);
            return $countUser;
        }
        
        public function userInfo($user_id = null) {
			App::import('Model', 'User');
			$this->User = new User();
			$data = $this->User->findById($user_id);
			return $data;
		}
    public function fetchUserImage($user_id) {
		App::import('Model', 'Upload');
		$this->Upload = new Upload();
		$return = '';
		$user_image = $this->Upload->find('first', array('fields' => array('Upload.url'), 'conditions' => array('Upload.user_id' => $user_id,'Upload.upload_for' => 'userprofile')));
		if(isset($user_image['Upload']['url'])) {
			return $user_image['Upload']['url'];
		} else {
		return "";
		}
		
	}
	
	public function fetchUserImageByid($upload_id) {
		App::import('Model', 'Upload');
		$this->Upload = new Upload();
		$return = '';
		$event_image = $this->Upload->find('first', array('fields' => array('Upload.url'), 'conditions' => array('Upload.id' => $upload_id,'Upload.upload_for' => 'userprofile')));
		if(isset($event_image['Upload']['url'])) {
			return $event_image['Upload']['url'];
		} else {
		return "";
		}
		
	}
	 public function fetchUserName($user_id) {
		App::import('Model', 'User');
		$this->User = new User();
		$return = '';
		$user_name = $this->User->findById($user_id);
		//$user_name = $this->User->find('first', array('fields' => array('User.username'), 'conditions' => array('User.id' => $user_id)));
		if(isset($user_name['User']['username'])) {
			return $user_name['User']['username'];
		} else {
		return "";
		}
	}
	
	 public function fetchEventName($event_id) {
		App::import('Model', 'Event');
		$this->Event = new Event();
		$return = '';
		$event_name = $this->Event->findById($event_id);
		//$user_name = $this->User->find('first', array('fields' => array('User.username'), 'conditions' => array('User.id' => $user_id)));
		if(isset($event_name['Event']['event_title'])) {
			return $event_name['Event']['event_title'];
		} else {
		return "";
		}
	}
	 public function checkExitsEmail($user_email=NULL) {
			$countUser = '';
			App::import('Model', 'User');
			$this->User = new User();
			$countUser = $this->User->find('count',
								array('conditions' => 
									array('User.email' => $user_email)
								)
							);
            return $countUser;
        }
        public function checkExitsInvites($user_id=NULL,$event_id=NULL) {
			$countInvite = '';
			App::import('Model', 'Invite');
			$this->Invite = new Invite();
			$countInvite = $this->Invite->find('count',
								array('conditions' => 
									array('Invite.user_id' => $user_id,'Invite.event_id' => $event_id)
								)
							);
            return $countInvite;
        }
        
	public function fetchEventImage($upload_id) {
		App::import('Model', 'Upload');
		$this->Upload = new Upload();
		$return = '';
		$event_image = $this->Upload->find('first', array('fields' => array('Upload.url'), 'conditions' => array('Upload.id' => $upload_id,'Upload.upload_for' => 'banner')));
		if(isset($event_image['Upload']['url'])) {
			return $event_image['Upload']['url'];
		} else {
		return "";
		}
		
	}
	/*
	public function fetchEventImage($event_id,$user_id) {
		App::import('Model', 'Upload');
		$this->Upload = new Upload();
		$return = '';
		$event_image = $this->Upload->find('first', array('fields' => array('Upload.url'), 'conditions' => array('Upload.user_id' => $user_id,'Upload.event_id' => $event_id,'Upload.upload_for' => 'banner')));
		if(isset($event_image['Upload']['url'])) {
			return $event_image['Upload']['url'];
		} else {
		return "";
		}
		
	}
	*/	
	public function fetchCountryName($iso) {
		App::import('Model', 'country');
		$this->Country = new country();
		$return = '';
		$Country_name = $this->Country->find('first', array('fields' => array('Country.name'), 'conditions' => array('Country.iso' => $iso)));
		
		if(isset($Country_name['Country']['name'])) {
			return $Country_name['Country']['name'];
		} else {
		return "";
		}
		
	}		
		
		function generateRandomNumber() {
			return  mt_rand(100000, 999999);
		}
		
     public function userDistance($lat1, $lon1, $lat2, $lon2, $unit = 'M')
     {
      	$theta = $lon1 - $lon2;
      	$dist = sin(deg2rad($lat1))*sin(deg2rad($lat2))+cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($theta));
         $dist  = acos($dist);
         $dist  = rad2deg($dist);
         $miles = $dist * 60 * 1.1515;
         $unit  = strtoupper($unit);
         if ($unit == "K") {
             return ($miles * 1.609344);
         } else if ($unit == "N") {
             return ($miles * 0.8684);
         }else if ($unit == "Me") {
             return ($miles * 0.00621);
         }else if ($unit == "fe") {
             return ($miles * 0.000189);
         } else {
             return $miles;
         }
     }
		/* Functionality : Login for the User
            Created on : 6st Oct 2015
            Function : 'controller/homeController/resetPassword' */
        public function createTempPassword($len)
        {
            $pass = '';
            $lchar = 0;
            $char = 0;
            for ($i = 0; $i < $len; $i++) {
                while ($char == $lchar) {
                    $char = rand(48, 109);
                    if ($char > 57)
                        $char += 7;
                    if ($char > 90)
                        $char += 6;
                }
                $pass .= chr($char);
                $lchar = $char;
            }
            return $pass;
        }

       
        //FUNCTION FOR VALIDATING ADMIN LOGIN START
        public function findUserByID($id=NULL, $fields=NULL) {
            $ret = '';
            $this->User = new User();
            $ret = $this->User->find('first',
                        array('conditions' => 
                                array('User.id' => $id),
                                'recursive' => -1, 'fields'=> $fields
                              )
                        );
            return $ret;
        }
		
		public function adminDetails() {
			$adminDetails = array();
			App::import('Model', 'Admin');
			$this->Admin = new Admin();
			
			$adminDetails = $this->Admin->find('first');
            return $adminDetails;
        }	
	
}
?>