<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Banners extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('adverts','adverts_banners');	
	}

	public function index()
	{
		

		
		$this->load->view('mypanel/adverts/banners/manage');
	}
}
?>