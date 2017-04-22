<?php
class ReportsController extends AppController {

	public $components = array('My','Resize','Export');

	function beforeFilter() {
	 	parent::beforeFilter();
		if (!empty($this->Auth)) {				
			
		}
	}
	
	/* FUNCTION FOR REPORT USER LIST
	 CREATED ON - 23JUNE 2016
	  */
	public function admin_userList(){
		$this->layout = 'Admin/default';
		$this->loadModel('User');
			
		$data = $this->User->find('all');
		$condtion = array();
		$this->paginate = array('order' => 'User.id DESC', 'limit' => '20');
		$this->set('users', $this->paginate('User', $condtion));	 
	}
    
	
	/* FUNCTION FOR TO EXPORTS USERS
	 CREATED ON - 23JUNE 2016
    */
	public function admin_exportUser($userType){
			
			$filename = "User-Data(".date('Y-m-d').").csv";
			$filterdata = '';
			$csv_file = fopen('php://output', 'w');
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
           
			$header_row = array('S.No.','Reference Id','Status');		
            fputcsv($csv_file,$header_row,',','"');		
			$i = 1;
			$this->loadModel( 'User' );
			$users = $this->User->find('all', array('conditions'=> array(), 'fields'=>array('id','reference_id','status')
				 			));
			if( count( $users ) ) {
				foreach($users as $user) {			
					if($user['User']['status'] == 1){
						$status = "Active";
					}else {
						$status = "Inactive";
					}
					$row = array(
							$i,
							$user['User']['reference_id'],
							$status,
					);
					$i++;
					fputcsv($csv_file,$row,',','"');
				}
			}else {
				$row = array('No Record Found');
				fputcsv($csv_file,$row,',','"');
			}	
        fclose($csv_file);
        $this->layout = false;
        $this->render(false);
        return false;
	}
	
	/* FUNCTION FOR REPORT USER LIST
	 CREATED ON - 23JUNE 2016
	  */
	public function admin_tracking(){
		$this->layout = 'Admin/default';
		$this->loadModel('Tracking');
		
		$data = $this->Tracking->find('all');
		//pr($data);die;
		$condtion = array();
		$this->paginate = array('limit' => '20', 'order' => 'Tracking.id DESC');
		$this->set('trackArr', $this->paginate('Tracking', $condtion));	 
	}
    
	/* FUNCTION FOR TO EXPORTS USERS
	 CREATED ON - 23JUNE 2016
    */
	public function admin_exportDayCount(){
			
			$filename = "Track-Data(".date('Y-m-d').").csv";
			$filterdata = '';
			$csv_file = fopen('php://output', 'w');
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
           
			$header_row = array('S.No.','Reference Id','State', 'City', 'Count', 'IN', 'OUT');		
            fputcsv($csv_file,$header_row,',','"');		
			$i = 1;
			$this->loadModel( 'Tracking' );
			$trackArr = $this->Tracking->find('all', array('conditions'=> array()));
			if( count( $trackArr ) ) {
				foreach($trackArr as $trackData) {			
					$row = array(
							$i,
							$trackData['User']['reference_id'],
							$trackData['Tracking']['state'],
							$trackData['Tracking']['city'],
							$trackData['Tracking']['count'],
							date('Y-m-d H:i:s', strtotime($trackData['Tracking']['in_date_time'])),
							date('Y-m-d H:i:s', strtotime($trackData['Tracking']['out_date_time'])),
					);
					$i++;
					fputcsv($csv_file,$row,',','"');
				}
			}else {
				$row = array('No Record Found');
				fputcsv($csv_file,$row,',','"');
			}	
        fclose($csv_file);
        $this->layout = false;
        $this->render(false);
        return false;
	}

}
?>