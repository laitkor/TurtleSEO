<?php

class Author extends AppModel {
    var $name = 'Author';
	var $validate = array(
	'name' => array(
        'titleRule-1' => array(
            'rule' => 'notEmpty',  
            'message' => 'Please Enter name.',
            'last' => true
         ),
        'titleRule-2' => array(
            'rule' => 'isUnique',  
            'message' => 'Name had already been taken.'
        )  
	)
  );		
	
	//var $hasMany = array('Article' => array('className' => 'Article', 'ForeignKey' => 'authors_id'));
}
?>