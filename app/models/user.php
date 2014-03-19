<?php

class User extends AppModel {
    var $name = 'User';
	var $hasMany = array('UserPlan' =>
                  array('className' => 'UserPlan',
                        'foreignKey'   => 'user_id',)
                  );
	var $validate = array(
		'name' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please enter name.',
        ),	
     
	 
				  
	'username' => array(
        'usernameRule-1' => array(
        'rule' => 'notEmpty',  
        'message' => 'Please enter user name.',
        'last' => true
        ),
        'usernameRule-2' => array(
           'rule' => 'isUnique',  
           'message' => 'Please enter different name. User name already exists.'
        )
	),
	
	'password' => array(
        'passwordRule-1' => array(
        'rule' => 'notEmpty',  
        'message' => 'Please enter password.',
        'last' => true
        ),
	    'passwordRule-2' => array(
        'rule' => array('between', 5, 20),
        'message' => 'Password must be between 5-20.'
        )
	),
	
	'email' => array(
        'emailRule-1' => array(
        'rule' => 'notEmpty',  
        'message' => 'Please enter email.',
        'last' => true
        ),
        'emailRule-2' => array(
        'rule' => 'isUnique',  
        'message' => 'Please enter different email.'
        ),
		'emailule-3' => array(
        'rule' => 'email',  
        'message' => 'Please enter valid email.'
        )
	),
	
	'postal_address' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please enter address.'
        ),
	
	
	'security_answer' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please enter answer.'
        ),
			
	'city' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please enter city.',
        )	
  );
}

?>