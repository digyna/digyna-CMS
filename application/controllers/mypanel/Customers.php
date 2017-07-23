<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'controllers/mypanel/' ."Persons.php");

class Customers extends Persons
{
	public function __construct()
	{
		parent::__construct('customers');
	}

	public function add()
	{
		parent::has_module_grant('customers_add');
		$data= $this->view();
		$this->load->view('mypanel/customers/manage',$data);
	}

	public function edit($customer_id = -1)
	{
		$customer_id = $this->encryption->decrypt_url($customer_id);
		parent::has_module_grant('customers_edit');
		$data= $this->view($customer_id);
		$this->load->view('mypanel/customers/manage',$data);
	}

	public function InputValidator()
	{
		$isAvailable = FALSE;
		$response= array();
		$person_id= $this->encryption->decrypt_url($this->input->post('person_id'));
		$username = $this->xss_clean($this->input->post('username'));
		$email = $this->xss_clean($this->input->post('email'));
		$rfc = $this->xss_clean($this->input->post('rfc'));
		if(!empty($username)) {
			$exists = $this->Customer->check_username_exists(strtolower($username), $person_id);
			$isAvailable = !$exists ?TRUE:FALSE;
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
			$exists = $this->Person->check_email_exists(strtolower($email), $person_id);
			$isAvailable = !$exists ?TRUE:FALSE;

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

		if(!empty($rfc)) {
			$exists = $this->Customer->check_rfc_exists(strtolower($rfc), $person_id);
			$isAvailable = !$exists ?TRUE:FALSE;
			$response['valid']=$isAvailable;
		}

		echo json_encode($response);
	}

	/*
	Returns customer table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$customers = $this->Customer->search($search, $limit, $offset, $sort, $order);
		$total_rows = $this->Customer->get_found_rows($search);
		$permission = $this->User->get_module_grants('customers', $this->User->get_logged_in_user_info()->person_id);

		$data_rows = array();
		foreach($customers->result() as $person)
		{
			$data_rows[] = get_person_data_row($person, $this,$permission);
		}

		$data_rows = $this->xss_clean($data_rows);

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}
	
	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest()
	{
		$suggestions = $this->xss_clean($this->Customer->get_search_suggestions($this->input->get('term'), TRUE));

		echo json_encode($suggestions);
	}

	public function suggest_search()
	{
		$suggestions = $this->xss_clean($this->Customer->get_search_suggestions($this->input->post('term'), FALSE));

		echo json_encode($suggestions);
	}
	
	/*
	Loads the customer edit form
	*/
	public function view($customer_id = -1)
	{
		$info = $this->Customer->get_info($customer_id);
		foreach(get_object_vars($info) as $property => $value)
		{
			$info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $info;

		return $data;
	}
	
	/*
	Inserts/updates a customer
	*/
	public function save($customer_id = -1)
	{
		$first_name = $this->xss_clean($this->input->post('first_name'));
		$last_name = $this->xss_clean($this->input->post('last_name'));
		$email = $this->xss_clean(strtolower($this->input->post('email')));

		// format first and last name properly
		$first_name = $this->nameize($first_name);
		$last_name = $this->nameize($last_name);

		$person_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'gender' => $this->input->post('gender'),
			'email' => $email,
			'phone_number' => $this->input->post('phone_number'),
			'address_1' => $this->input->post('address_1'),
			'address_2' => $this->input->post('address_2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country'));

		$customer_data = array(
			'rfc' => $this->input->post('rfc') == '' ? NULL : $this->input->post('rfc'),
			'company_name' => $this->input->post('company_name') == '' ? NULL : $this->input->post('company_name'),
			'discount_percent' => $this->input->post('discount_percent') == '' ? 0.00 : $this->input->post('discount_percent'),
			'taxable' => $this->input->post('taxable') != NULL
		);

		//Edit customer
		if($customer_id != -1)
		{
			$customer_id = $this->encryption->decrypt_url($customer_id);
		}

		//Password has been changed OR first time password set
		if($this->input->post('password') != '')
		{
			$customer_data['username'] =  $this->input->post('username');
			$customer_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$customer_data['hash_version'] = '2';
		}

		if($this->Customer->save_customer($person_data, $customer_data, $customer_id))
		{
			echo json_encode(array('success' => TRUE));
		}
		else//failure
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('error_database')));
		}
	}
	
	/*
	This deletes customers from the customers table
	*/
	public function delete()
	{
		$customers_to_delete = $this->xss_clean($this->input->post('ids'));

		if($this->Customer->delete_list($customers_to_delete))
		{
			echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('customers_successful_deleted').' '.
							count($customers_to_delete).' '.$this->lang->line('customers_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('customers_cannot_be_deleted')));
		}
	}
}
?>