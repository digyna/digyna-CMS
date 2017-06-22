<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Themes extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('themes');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/themes/manage');
	}
}
?>