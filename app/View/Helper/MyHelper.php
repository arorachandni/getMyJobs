<?php
class MyHelper extends AppHelper {

	var $helpers = array('Html', 'Form', 'Ajax', 'Js', 'Javascript', 'Session');


	public function encrypt($id) {
		$enc_id= base64_encode(convert_uuencode($id));
		return $enc_id;
	}

	public function decrypt($id) {
		$dec_id = base64_decode($id);
		return $dec_id;
	}

	function GetMonths() {
		$months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
		return $months;
	}

	function GetYears() {
		$arr = array();
		$last = date("Y");
		for ($i = 1900; $i <= $last; $i++) {
			$arr[$i] = $i;
		}
		return $arr;
	}

	function GetDates() {
		$arr = array();
		for ($i = 1; $i < 32; $i++) {
			if ($i < 10) $j = "0" . $i;
			else $j = $i;
			$arr[$j] = $j;
		}
		return $arr;
	}


	function Months() {
		$months = array('1' => 'Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		return $months;
	}

	function Years() {
		$arr = array();
		$last = date("Y");
		for ($i = $last; $i <= $last; $i++) {
			$arr[$i] = $i;
		}
		return $arr;
	}

	/*  28 Sep 2015 */

	/* function to fecth image size */

	function getImageSize($imagePath, $imageName) {
		$imageUrl = $imagePath . $imageName;
		// find image size
		list($width, $height, $type, $attr) = getimagesize($imageUrl);
		$arr = array('width' => $width, 'height' => $height, 'type' => $type, 'attr' => $attr);
		return $arr;
	}

	//FUNCTION FOR FETCH USER STATUS START
	public function fetchUserStatus($id) {
		App::import('Model', 'User');
		$this->User = new User();
		$return = '';
		$userstatus = $this->User->find('first', array('fields' => array('User.user_status'), 'conditions' => array('User.id' => $id)));
		return $userstatus;
	}
	/*
	public function fetchEventImage($event_id) {
		App::import('Model', 'Upload');
		$this->Upload = new Upload();
		$return = '';
		$event_image = $this->Upload->find('first', array('fields' => array('Upload.url'), 'conditions' => array('Upload.event_id' => $event_id,'Upload.upload_for' => 'banner')));
		if(isset($event_image['Upload']['url'])) {
			return $event_image['Upload']['url'];
		} else {
		return "";
		}
		
	}
	*/
	
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
	
	
	public function checkAbuseEventCount($event_id=NULL) { 
			$countUser = '';
			App::import('Model', 'Abuse');
			$this->Abuse = new Abuse();
			$countAbuse = $this->Abuse->find('count',
								array('conditions' => 
									array('Abuse.event_id' => $event_id)
								)
							);
            return $countAbuse;
        }
        
        public function checkAbusePostCount($post_id=NULL) { 
			$countUser = '';
			App::import('Model', 'Abuse');
			$this->Abuse = new Abuse();
			$countAbuse = $this->Abuse->find('count',
								array('conditions' => 
									array('Abuse.post_id' => $post_id)
								)
							);
            return $countAbuse;
        }
        
          public function getEventPostCount($event_id=NULL) { 
			$countUser = '';
			App::import('Model', 'Post');
			$this->Post = new Post();
			$countPost = $this->Post->find('count',
								array('conditions' => 
									array('Post.event_id' => $event_id,'Post.type !='=>'comment')
								)
							);
            return $countPost;
        }
        public function getEventCommentCount($event_id=NULL) { 
			$countUser = '';
			App::import('Model', 'Post');
			$this->Post = new Post();
			$countPost = $this->Post->find('count',
								array('conditions' => 
									array('Post.event_id' => $event_id,'Post.type'=>'comment')
								)
							);
            return $countPost;
        }
        
	
	function getCommentsReply($post_id=NULL){
		$countUser = '';
		App::import('Model', 'Comment');
		$this->Comment = new Comment();
		$countReplyOnComment = $this->Comment->find('count',
								array('conditions' => 
									array('Comment.post_id' => $post_id)
								)
							);
        return $countReplyOnComment;
	}
	function getCategoryName($cat_id=NULL){
		$countUser = '';
		App::import('Model', 'Category');
		$this->Category = new Category();
		$cateName = $this->Category->find('first',array('conditions' =>array('Category.id' => $cat_id)));
        return $cateName['Category']['category_name'];
	}
	function getSubCategoryName($subcat_id=NULL){
		$countUser = '';
		App::import('Model', 'Subcategory');
		$this->Subcategory = new Subcategory();
		$cateName = $this->Subcategory->find('first',array('conditions' =>array('Subcategory.id' => $subcat_id)));
        return $cateName['Subcategory']['subcat_name'];
	}
	function getKnows($id=NULL){
		$countUser = '';
		App::import('Model', 'Know');
		$this->Knows = new Know();
		$know = $this->Knows->find('first',array('conditions' =>array('Know.id' => $id)));
        if(!empty($know['Know']['source_name'])){
			$value=$know['Know']['source_name'];
		} else { $value='';}
		return $value;
	}
	function getSkill($skill_string=NULL){
		$countUser = '';
		App::import('Model', 'Skill');
		$this->Skill = new Skill();
			
			$skill_string=explode(",",$skill_string); 
			
		$skillList=$this->Skill->findAllById($skill_string);
				
        return $skillList;
	}
	function getCommentsOnMimePost($post_id=NULL){
		$countUser = '';
		App::import('Model', 'Comment');
		$this->Comment = new Comment();
		$countReplyOnComment = $this->Comment->find('count',
								array('conditions' => 
									array('Comment.post_id' => $post_id)
								)
							);
        return $countReplyOnComment;
	}
	
	function getRepliesOnMimePost($comment_id=NULL){
		$countUser = '';
		App::import('Model', 'Reply');
		$this->Reply = new Reply();
		$countReplyOnComment = $this->Reply->find('count',
								array('conditions' => 
									array('Reply.comment_id' => $comment_id)
								)
							);
        return $countReplyOnComment;
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
	public function userInfo($user_id = null) {
		App::import('Model', 'User');
		$this->User = new User();
		$data = $this->User->findById($user_id);
		return $data;
	}
    
	public function fetchStates() {
		App::import('Model', 'State');
		$this->State = new State();
		$stateArr = $this->State->find('list', array('fields'=> array('id','state_name')));
		return $stateArr;
	}
	
	public function fetchCities() {
		App::import('Model', 'City');
		$this->City = new City();
		$cityArr = $this->City->find('list', array('fields'=> array('id','city_name')));
		return $cityArr;
	}
	public function fetchCountries() {
		App::import('Model', 'Country');
		$this->Country = new country();
		$CountryArr = $this->Country->find('list', array('fields'=> array('iso','name')));
		return $CountryArr;
	}
	public function fetchCategories() {
		App::import('Model', 'Category');
		$this->Category = new Category();
		$CategoryArr = $this->Category->find('list', array('fields'=> array('id','category_name')));
		return $CategoryArr;
	}
	public function fetchSubCategories() {
		App::import('Model', 'Subcategory');
		$this->Subcategory = new Subcategory();
		$CategoryArr = $this->Subcategory->find('list', array('fields'=> array('id','category_name')));
		return $CategoryArr;
	}
	
	public function fetchCountryName($country_id=NULL) {
		App::import('Model', 'Country');
		$this->Country = new country();
		$CountryArr = $this->Country->find('first', array('conditions'=> array('Country.id',$country_id)));
		return $CountryArr['Country']['name'];
	}
	public function fetchCountriesforuser() {
		App::import('Model', 'Country');
		$this->Country = new country();
		$CountryArr = $this->Country->find('all', array('fields'=> array('iso','name','phonecode')));
		return $CountryArr;
	}
	public function fetchCountry($iso) {
		App::import('Model', 'Country');
		$this->Country = new country();
		$country_name = $this->Country->find('first', array('fields' => array('Country.name'), 'conditions' => array('Country.iso' => $iso)));
		if(isset($country_name['Country']['name'])) {
			return $country_name['Country']['name'];
		} else {
		return "";
		}
	}
	public function checkExitsUser($user_name) { 
			$countUser = '';
			App::import('Model', 'User');
			$this->User = new User();
			$countUser = $this->User->find('count',
								array('conditions' => 
									array('User.username' => $user_name)
								)
							);
            return $countUser;
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
		
	
}
?>