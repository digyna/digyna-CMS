<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Config extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('config');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/config/manage');
	}
}
?>