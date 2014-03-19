<?php

class Article extends AppModel {
    var $name = 'Article';
	
	var $validate = array(
		'title' => array(
        'titleRule-1' => array(
        'rule' => 'notEmpty',  
        'message' => 'Please enter title.',
        'last' => true
        ),
        'titleRule-2' => array(
            'rule' => 'isUnique',  
            'message' => 'Please enter different title.'
        )  
    ),
	
	'content' => array(
	'rule' => 'notEmpty',  
    'message' => 'Please enter content.'
	),
	
	'subcats_id' => array(
	'rule' => 'notEmpty',  
    'message' => 'Please select sub category.'
	),
	
	'subcattags_id' => array(
	'rule' => 'notEmpty',  
    'message' => 'Please select sub category tag.'
	)
  );
}
?>