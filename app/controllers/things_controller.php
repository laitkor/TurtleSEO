<?php
/**
 * $Id: things_controller.php 3 2006-11-08 20:19:09Z thepaper $
 */

class ThingsController extends AppController
{
    var $name = 'Things';
    var $helpers = array('Html', 'Javascript', 'Ajax');
	var $components = array('RequestHandler');

    // we're not going to use a model for this example, but
    // it would be easy to use a database thanks to cake
    var $uses = null;

    /**
     * initial page load 
     */
	 
	 
	 
	 
    function index() {

        // preload dynamic data
        $this->set('data1', 'content will update here');
        $this->set('data2', 'here too');

        $this->render('neat');

    }//index()

    /**
     * display content action
     *
     * @param int id of content to display
     */
    function view($id) {

        // content could come from a database, xml, etc.
        $content = array(
                        array('somebody is baking brownies',
                              'become a cake baker',),
                        array('knowledge is not enough',
                              'we must also apply - bruce lee')
                     );

        $this->set('data1', $content[$id][0]);
        $this->set('data2', $content[$id][1]);

        // use ajax layout
        $this->render('neat');

    }//view()

}//ThingsController
