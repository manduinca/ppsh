<?php

class Home extends CI_Controller {

	public function index()
	{
		//$this->load->model('location_model');
		$views['content'] = 'home';
		//$views['locations'] = $this->location_model->getAll();
		$this->load->view('template', $views);
	}
}
