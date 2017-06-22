<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class products extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('products');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/products/manage');
	}
}
?>