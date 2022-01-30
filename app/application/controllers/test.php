<?php
require APPPATH.'/libraries/REST_Controller.php';

class Test extends REST_Controller {
	
	function index_get()
	{
		$this->response(array('status' => true, 'test'=> true), 200);
	}
}
