<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sales extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('sales');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/sales/manage');
	}
}
?>