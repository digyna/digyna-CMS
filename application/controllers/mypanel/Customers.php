<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customers extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('customers');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/customers/manage');
	}
}
?>