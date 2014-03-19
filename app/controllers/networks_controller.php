<?php

class NetworksController extends AppController {

	var $helpers = array('Html', 'Javascript'); 
	
	function index() {
		//$this->render('/users/networks/');
		$this->redirect(array('controller' => 'users', 'action' => 'networks'));
	}
	
	function beforeFilter()
	{
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You are not authorized to view this page.');
			$this->redirect('/users/sign_in');
		}		
	}
	
	function twitter() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 1)));
		if($res)
		{
			$this->Session->setFlash('You have already added Twitter to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 1, 'Twitter', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 1, 'Twitter', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.','');
			}
		}
		$this->render('twitter','modalbox');
	}
	
	function facebook() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 2)));
		if($res)
		{
			$this->Session->setFlash('You have already added facebook to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			////$record = $this->Group->query("SELECT * FROM `groups` WHERE `group_name` = 'Default';");
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 2, 'Facebook', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 2, 'Facebook', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('facebook','modalbox');
	}
	
	function linkedin() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 3)));
		if($res)
		{
			$this->Session->setFlash('You have already added linkedin to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			////$record = $this->Group->query("SELECT * FROM `groups` WHERE `group_name` = 'Default';");
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 3, 'LinkedIn', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 3, 'LinkedIn', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('linkedin','modalbox');
	}

	function friendster() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 4)));
		if($res)
		{
			$this->Session->setFlash('You have already added friendster to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			////$record = $this->Group->query("SELECT * FROM `groups` WHERE `group_name` = 'Default';");
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 4, 'friendster', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 4, 'friendster', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('friendster','modalbox');
	}
	
	function hi5() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 5)));
		if($res)
		{
			$this->Session->setFlash('You have already added hi5 to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 5, 'hi5', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 5, 'hi5', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('hi5','modalbox');
	}
	
	function tumblr() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 6)));
		if($res)
		{
			$this->Session->setFlash('You have already added tumblr to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 6, 'tumblr', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 6, 'tumblr', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('tumblr','modalbox');
	}
	
	function identica() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 7)));
		if($res)
		{
			$this->Session->setFlash('You have already added identi.ca to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			//$this->loadModel('Group');
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, $groupid, 7, 'identi.ca', '$username', '$password', now());");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`) VALUES ($userid, 7, 'identi.ca', '$username', '$password', now());");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('identica','modalbox');
	}
	
	function shoutem() {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$res = $this->Addednetwork->find('first', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 8)));
		if($res)
		{
			$this->Session->setFlash('You have already added shoutem to your networks');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}	
		if(!empty($this->data))
		{
			$username=trim($this->data['username']);
			$password=trim($this->data['password']);
			$subdomain=trim($this->data['subdomain']);
			//$this->loadModel('Group');
			//$record = $this->Group->find('all', array('conditions' => array('Group.group_name' => 'Default', 'Group.user_id' => $userid)));
			//$groupid = $record[0]['Group']['group_id'];
			//$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`group_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`, `network_subdomain`) VALUES ($userid, $groupid, 8, 'shoutem', '$username', '$password', now(), '$subdomain');");
			$result = $this->Network->query("INSERT INTO `addednetworks` (`user_id`,`network_id`,`network_name`,`network_username`,`network_password`,`date_of_adding`, `network_subdomain`) VALUES ($userid, 8, 'shoutem', '$username', '$password', now(), '$subdomain');");
			if($result > 0)
			{
				$this->Session->setFlash('Network added successfully');
				$this->redirect('/networks/');
			} else {
				$this->Session->setFlash('Network could not be added this time. Please try again.');
			}
		}
		$this->render('shoutem','modalbox');
	}
}
?>