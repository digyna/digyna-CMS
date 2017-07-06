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
		$this->lang->load('module',$this->Appconfig->get('language_code')); 
		$model = $this->User;
		$menu = $this->menu_lib;

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

		$segments=$this->uri->segment_array();
		$bread_crumb = array();
		$modules = array();
		
		foreach($this->Module->get_allowed_modules($logged_in_employee_info->person_id)->result() as $module)
		{
			switch ($module->module_id) {
                    case 'contacts':
                        $n= $this->contact_lib->unread_total_contact();
                        $module->badge = ($n>0) ? $n : NULL;
                        break;
                    default:
                        break;
                }

            $exploded_submodule = explode('_', $module->module_id);
            $href=(count($exploded_submodule)>1)?"submodule":$module->module_id;

                if($href==='submodule'){
                    if($exploded_submodule[1]==='read'){
                        $href=$module->module_parent;
                    }else{
                        $href="{$exploded_submodule[0]}/{$exploded_submodule[1]}";
                    }
                }

            $module->href=base_url("mypanel/$href");
            $module->icon=$module->module_icon;
            $module->text=$this->lang->line($module->name_lang_key);

			$modules[] = $module;
			
			// llena el array bread_crumb
			foreach($segments as $segment)
			{
				if($module->module_id==='home'){
					$bread_crumb[]=$module;
				}elseif($module->module_id===$segment) {
					$bread_crumb[]=$module;
				}

				$sub=(count($exploded_submodule)>1)?"submodule":$module->module_id;

                if($sub==='submodule'){
                	if($exploded_submodule[1]===$segment){
					$bread_crumb[]=$module;
				}
                    
                }	
			}
		}
		$config['ul-root']=array('class'=>'main-menu');
		$config['ul']=array('class'=>'list-unstyled sub-menu collapse in');
		$config['li-parent']=array('class'=>'has-submenu');
		$config['a-parent']=array('class'=>"submenu-toggle");
					
		$menu->init($config);

		$menu->setResult($modules, 'module_id', 'module_parent');

		// bread_crumb
		foreach($bread_crumb as $segment)
		{
			$segment->icon=($segment->module_id==='home')?$segment->icon:NULL;
			$segment->module_parent='0';
			$segment->badge=NULL;
			
		}

		$href = $this->uri->segment_array();
		$url=array();
		$str='';
		foreach ($href as $segment)
		{
			if ($segment === reset($href)) {
				$str.=$segment;
			}else{
				$str.=$segment;
				$url[]=base_url($str);
			}
			$str.="/";
		}

		if($this->uri->total_segments()==1){
			$url[]=base_url('mypanel/home');
		}

		$menu->setActiveItem($url);

		// load up global data visible to all the loaded views
		$data['menu'] = $menu->html();
		$data['contact_info']= $this->contact_lib->get_contact();
		$data['user_info'] = $logged_in_employee_info;
		$data['controller_name'] = $module_id;
		$data['submodule'] = $submodule_id;
		//bread_crumb
		$config2['ul-root']=array('class'=>'breadcrumb pull-left');
		$menu->init($config2);
		$menu->setResult($bread_crumb, 'module_id', 'module_parent');
		$menu->set_bread_active(base_url($this->uri->uri_string()));
		$data['menu_bread'] = $menu->html();
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