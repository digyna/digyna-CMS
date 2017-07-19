<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'controllers/mypanel/' ."Persons.php");

class Users extends Persons
{
	public function __construct()
	{
		parent::__construct('users');
			
	}

	public function add()
	{
		parent::has_module_grant('users_add');
		$data= $this->view();
		$this->load->view('mypanel/users/manage',$data);
	}

	public function edit($user_id = -1)
	{
		if($this->User->get_logged_in_user_info()->person_id === $user_id) {
			redirect('mypanel/profile');
		}
		parent::has_module_grant('users_edit');
		$data= $this->view($user_id);
		$this->load->view('mypanel/users/manage',$data);
	}

	public function InputValidator()
	{
		$isAvailable = FALSE;
		$response= array();
		$username = $this->xss_clean($this->input->post('username'));
		$email = $this->xss_clean($this->input->post('email'));
		if(!empty($username)) {
			$isAvailable = ($this->User->exists_user($username))?FALSE:TRUE;
			$response['valid']=$isAvailable;
			if($isAvailable===FALSE){
				$entry = array('91','94','2020','2019','2018','2017','91','2016','2015','2014','2013','2012','2011','2010');
				$entry_rand = array_rand($entry);

				$username_rand=$username.mt_rand(100,1000);
				($this->User->exists_user($username_rand))?NULL:$suggestion[]=$username_rand;

				$username_entry=$username.$entry[$entry_rand];
				($this->User->exists_user($username_entry))?NULL:$suggestion[]=$username_entry;
				
				$suggestions=$suggestion;
				$response['suggestions']=$suggestions;
			}
		}

		if(!empty($email)) {
			$isAvailable = ($this->User->exists_email($email))?FALSE:TRUE;

			if($isAvailable===TRUE) {
				$exploded_email = explode('@', $email);
				$domain=$exploded_email[1];
				$starttime = microtime(true);
				$file      = @fsockopen ($domain, 80, $errno, $errstr, 10);
				$stoptime  = microtime(true);
				$status    = 0;
 
    			if (!$file) $status = -1;  // Site is down
    			else {
        			fclose($file);
        			$status = ($stoptime - $starttime) * 1000;
        			$status = floor($status);
    			}

    			$isAvailable = ($status <> -1)?TRUE:FALSE;
    			$response['not_valid']=TRUE;
    		}

			$response['valid']=$isAvailable;
		}

		echo json_encode($response);
	}

	/*
	Devuelve filas de datos de tabla de los usuarios. Esto se llama con AJAX.
	*/
	public function search()
	{
		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$users = $this->User->search($search, $limit, $offset, $sort, $order);
		$total_rows = $this->User->get_found_rows($search);
		$permission = $this->User->get_module_grants('users', $this->User->get_logged_in_user_info()->person_id);

		$data_rows = array();
		foreach($users->result() as $person)
		{
			$data_rows[] = get_person_data_row($person, $this,$permission);
		}

		$data_rows = $this->xss_clean($data_rows);

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}

	public function get_table_headers(){
		parent::get_table_headers();
	}

	/*
	Loads the employee edit form
	*/
	public function view($user_id = -1)
	{
		$menu = $this->menu_lib;
		
		$person_info = $this->User->get_info($user_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $person_info;
		$permissions = array();
		foreach($this->Module->get_all_permissions()->result() as $permission)
		{
			$permission->permission_id = $this->xss_clean($permission->permission_id);
			$grant = $this->xss_clean($this->User->has_grant($permission->permission_id, $person_info->person_id));

			
			$permission->text=$this->lang->line($permission->name_lang_key);

			$exploded_submodule = explode('_', $permission->module_id);
            $class=(count($exploded_submodule)>1)?NULL:'module';

            $permission->input=array('type' => 'checkbox','name'=>'grants[]','value'=>$permission->module_id,'checked'=>$grant,'class'=>$class);

			$permissions[] = $permission;
		}
		$config['ul-root']=array("id"=>"permission_list");
		$this->menu_lib->init($config);
		$this->menu_lib->setResult($permissions, 'permission_id', 'module_parent',FALSE);
		$data['permissions']=$menu->html();

		return $data;
	}

	/*
	Inserta/actualiza un usuario
	*/
	public function save($user_id = -1)
	{
		$person_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number'),
			'address_1' => $this->input->post('address_1'),
			'address_2' => $this->input->post('address_2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country')
		);

		$user_data = array();

		if($user_id == -1) {
			$user_data['username'] = $this->input->post('username');
		}
		
		$grants_data = $this->input->post('grants') != NULL ? $this->input->post('grants') : array();
		
		//Password has been changed OR first time password set
		if($this->input->post('password') != '')
		{
			$user_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$user_data['hash_version'] = '2';
		}
		
		if($this->User->save_user($person_data, $user_data, $grants_data, $user_id))
		{

				echo json_encode(array('success' => TRUE));
			
		}
		else//failure
		{
			$person_data = $this->xss_clean($person_data);

			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('error_database')));
		}
	}
	
	/*
	Elimina usuarios
	*/
	public function delete()
	{
		$users_to_delete = $this->xss_clean($this->input->post('ids'));

		if($this->User->delete_list($users_to_delete))
		{
			echo json_encode(array('success' => TRUE,'message' => $this->lang->line('users_successful_deleted').' '.
							count($users_to_delete).' '.$this->lang->line('users_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE,'message' => $this->lang->line('users_cannot_be_deleted')));
		}
	}
}
?>