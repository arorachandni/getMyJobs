<?php

    App::uses('Component', 'Controller');
    App::import('Model', 'User');
    class MyComponent extends Component {

        public $components = array('Session', 'Cookie', 'Auth');

		/* Functionality : Find the Admin Details
			Created on : 30 sep 2015 */

		public function adminDetails() {
			$adminDetails = array();
			App::import('Model', 'Admin');
			$this->Admin = new Admin();
			
			$adminDetails = $this->Admin->find('first');
            return $adminDetails;
        }	
		
		/* Functionality : for checking the user is exits or not
			Created on : 30 sep 2015
			Main Function : 'controller/home/register' */
		public function checkExitsUser($email=NULL) {
			$countUser = '';
			$this->User = new User();
			$countUser = $this->User->find('count',
								array('conditions' => 
									array('User.email' => $email)
								)
							);
            return $countUser;
        }		
		
        /* Functionality : CHECK FOR USER SESSION
            Created on : 16th Oct 2015 */
        public function checkUserSession() {
            $msg='';
            if($this->Session->check('Auth.User')){
                $msg = "exists";
            }
            
            return $msg;
        }

        
		
		//FUNCTION FOR VALIDATING ADMIN LOGIN START
        public function validateAdmin() {
            $ret = '';
            if ($this->Session->check('Auth.Admin')) {
                $ret = '/admin/admins/dashboard/';
            }
            return $ret;
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

        /* Functionality : for the User Detail (not recursive)
            Created on : 14th Oct 2015 */
        public function userDetail($id) {
            $ret = '';
            $this->User = new User();
            $ret = $this->User->findById($id);
            return $ret;
        }

        /* Functionality : for the Unlink The image
            Created on : 15th Oct 2015 */
        public function unlinkImage($path) {
            unlink($path);
            return true;
        }


        //FUNCTION TO GENERATE PASSWORD END
	   //FUNCTION TO UPLOAD THE FILE START
       function uploadFile($path, $fileData) {
            /*find file extention*/
            $extArr = explode('.', $fileData['name']);
            $ext = end($extArr);

            $filename = $this->random_string(5).time() . '.' . $ext;
            $url = $path . $filename;

            if (move_uploaded_file($fileData['tmp_name'], $url))
                return $filename;
            else
                return '';
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
		
		function random_string($length = '8') {

        $characters = "0123456789abcdefghijklmnopqrstuvwxyz";

        $string = '';

        for ($p = 0; $p < $length; $p++) {

            $string .= $characters[mt_rand(0, strlen($characters))];

        }
        return $string;
      }
	  
	  function unlinkImg($id=NULL, $model=NULL, $foldName=NULL){
	     Controller::loadModel($model);
	    // Open a directory, and read its contents
		  $field = 'image';
		 $dir = "../webroot/img/".$foldName;
		 $pattern="(\.jpg$)|(\.png$)|(\.jpeg$)";
		 $getImg = $this->$model->find('first', array('conditions' => array($model.'.id' => $id), 'fields'=> array($model.'.'.$field)));
		 
		 if ($dh = opendir($dir)) {
           $file = $getImg[$model][$field];

		   if(eregi($pattern, $file)){
		   $imgPath = '../webroot/img/'.$foldName.'/'.$file;
		   unlink($imgPath);
		  }
		}  
	}
	
}
?>