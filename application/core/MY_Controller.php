<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_Controller extends CI_Controller 
{
	/*
	* Controllers that are considered secure extend Secure_Controller, optionally a $module_id can
	* be set to also check if a user can access a particular module in the system.
	*/
	public function __construct($module_id = NULL, $submodule_id = NULL)
	{
		parent::__construct();
		$this->load->model('mypanel/User');
		$this->load->library('contact_lib');
		$model = $this->User;

		if(!$model->is_logged_in())
		{
			redirect('mypanel/login');
		}

		$logged_in_employee_info = $model->get_logged_in_employee_info();
		if(!$model->has_module_grant($module_id, $logged_in_employee_info->person_id) || 
			(isset($submodule_id) && !$model->has_module_grant($submodule_id, $logged_in_employee_info->person_id)))
		{
			redirect('mypanel/no_access/' . $module_id . '/' . $submodule_id);
		}

		$modules = array();
		foreach($this->Module->get_allowed_modules($logged_in_employee_info->person_id)->result() as $module)
		{
			$exploded_module = explode('_', $module->module_id);
			if(!isset($exploded_module[1])){
				$modules[] = $module;
			}
		}

		$submodules = array();
		foreach($this->Module->get_allowed_modules($logged_in_employee_info->person_id)->result() as $submodule)
		{
			$exploded_submodule = explode('_', $submodule->module_id);
			if(isset($exploded_submodule[1])){
			
			$submodule->submodule_id = $this->xss_clean($submodule->module_id);
			$submodule->module_id = $this->xss_clean($exploded_submodule[0]);
			$submodules[] = $submodule;
			}
		}

		// load up global data visible to all the loaded views
		$data['allowed_modules'] = $modules;
		$data['allowed_submodules'] = $submodules;
		$data['contact_info']= $this->contact_lib->get_contact();
		$data['user_info'] = $logged_in_employee_info;
		$data['controller_name'] = $module_id;

		$this->load->vars($data);
	}
	
	/*
	* Internal method to do XSS clean in the derived classes
	*/
	protected function xss_clean($str, $is_image = FALSE)
	{
		// This setting is configurable in application/config/config.php.
		// Users can disable the XSS clean for performance reasons
		// (cases like intranet installation with no Internet access)
		if($this->config->item('dgn_xss_clean') == FALSE)
		{
			return $str;
		}
		else
		{
			return $this->security->xss_clean($str, $is_image);
		}
	}

	public function numeric($str)
	{
		return parse_decimals($str);
	}

	public function check_numeric()
	{
		$result = TRUE;

		foreach($this->input->get() as $str)
		{
			$result = parse_decimals($str);
		}

		echo $result !== FALSE ? 'true' : 'false';
	}



}
?>