<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Marks extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('adverts', 'adverts_marks');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/adverts/marks/manage');
	}
}
?>