<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Contact_lib
{
	private $CI;

  	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function get_contact()
	{
		$response = $this->CI->Contact->get_contact(3);
		return $response;
	}

	public function all_total_contact()
	{
		return $this->CI->Contact->all_total_contact();
	}

	public function unread_total_contact()
	{
		return $this->CI->Contact->unread_total_contact();
	}
	
}

?>
