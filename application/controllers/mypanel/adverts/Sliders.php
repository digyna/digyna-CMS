<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sliders extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('adverts','adverts_sliders');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/adverts/sliders/manage');
	}
}
?>