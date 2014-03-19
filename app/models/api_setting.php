<?php

class ApiSetting extends AppModel {
    var $name = 'ApiSetting';
	
	var $validate = array(
		'name' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please Enter Name.',
        ),
	
	'api_key' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please Fill Field.',
        ),
    
	'api_password' => array(
	'rule' => 'notEmpty',  
    'message' => 'Please Fill Field.'
	)
	
  );
}

?>