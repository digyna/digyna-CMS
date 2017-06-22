<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contacts extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('contacts');	
	}

	public function index()
	{

		$this->load->view('mypanel/contacts/manage');
	}

}
?>