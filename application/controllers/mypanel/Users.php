<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('users');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/users/manage');
	}
}
?>