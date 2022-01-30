<?php
require APPPATH.'/libraries/REST_Controller.php';

class Points extends REST_Controller {
	
	function search_get()
	{
		$data = array();
		$data[] = array('x' => 1, 'y' => 2);
		$data[] = array('x' => 2, 'y' => 3);
		$data[] = array('x' => 3, 'y' => 2.2);
		$data[] = array('x' => 4, 'y' => 1.3);
		$data[] = array('x' => 5, 'y' => 4);
		$data[] = array('x' => 6, 'y' => 3.2);
		$data[] = array('x' => 7, 'y' => 6);
		$data[] = array('x' => 8, 'y' => 2);
		$data[] = array('x' => 9, 'y' => 1);
		$data[] = array('x' => 10, 'y' => 3);
		$this->response($data, 200);
	}
}
