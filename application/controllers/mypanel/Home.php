<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('mypanel/home');
	}

	public function logout()
	{
		$this->User->logout();
	}
}
?>