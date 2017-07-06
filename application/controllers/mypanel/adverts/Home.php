<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('adverts');	
	}

	public function index()
	{
		$module_id=$this->Module->get_module('adverts');
		$exploded_submodule = explode('_', $module_id);
		redirect("mypanel/adverts/{$exploded_submodule[1]}");
	}
}
?>