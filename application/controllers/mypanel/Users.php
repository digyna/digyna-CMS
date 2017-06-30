<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Persons.php");

class Users extends Persons
{
	public function __construct()
	{
		parent::__construct('users');	
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

		$data_rows = array();
		foreach($users->result() as $person)
		{
			$data_rows[] = get_person_data_row($person, $this);
		}

		$data_rows = $this->xss_clean($data_rows);

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}
}
?>