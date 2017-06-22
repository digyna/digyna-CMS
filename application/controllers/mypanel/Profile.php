<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('profile');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/profile/manage');
	}
}
?>