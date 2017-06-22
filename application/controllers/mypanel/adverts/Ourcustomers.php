<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ourcustomers extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('adverts', 'adverts_ourcustomers');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/adverts/ourcustomers/manage');
	}
}
?>