<?php

class WpServer extends AppModel {
    var $name = 'WpServer';
	
	var $validate = array(
		'name' => array(
        'nameRule-1' => array(
        'rule' => 'notEmpty',  
        'message' => 'Please enter domain name.',
        'last' => true
        ),
        'nameRule-2' => array(
            'rule' => 'isUnique',  
            'message' => 'Please enter different name. Domain already exists.'
        ),
		 'nameRule-3' => array(
            'rule' => 'url',  
            'message' => 'Please enter valid URL.'
        )
    ),
	
	'wp_admin_id' => array(
         'rule' => 'notEmpty',  
        'message' => 'Please enter username.',
        ),
    
	'wp_admin_password' => array(
	'rule' => 'notEmpty',  
    'message' => 'Please enter password.'
	),
	
	'rpc_url' => array(
        'rpcRule-1' => array(
        'rule' => 'notEmpty',  
        'message' => 'Please enter RPC URL.',
        'last' => true
        ),
        'rpcRule-2' => array(
           'rule' => 'isUnique',  
           'message' => 'Please enter different URL. URL already exists.'
        ),
		 'rpcRule-3' => array(
            'rule' => 'url',  
            'message' => 'Please enter valid URL.'
        )
	)
  );
}

?>