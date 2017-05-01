<?php
App::uses('AppModel', 'Model');
class Job extends AppModel {
    public $hasMany = array(
        'Proposal' => array(
            'className' => 'Proposal',
        )
    );
}
?>
