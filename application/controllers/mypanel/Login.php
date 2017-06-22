<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->User->is_logged_in())
		{
			redirect('mypanel/home');
		}
		else
		{
			$this->form_validation->set_rules('username', 'lang:login_undername', 'callback_login_check');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('mypanel/login');
			}
			else
			{
				redirect('mypanel/home');
			}
		}
	}

	public function login_check($username)
	{
		$password = $this->input->post('password');

		if($this->_security_check($username, $password))
		{
			$this->form_validation->set_message('login_check', 'Security check failure');

			return FALSE;
		}

		if(!$this->User->login($username, $password))
		{
			$this->form_validation->set_message('login_check', $this->lang->line('login_invalid_username_and_password'));

			return FALSE;
		}

		return TRUE;		
	}
	
	private function _security_check($username, $password)
	{
		return preg_match('~\b(Copyright|(c)|©|All rights reserved|Developed|Crafted|Implemented|Made|Powered|Code|Design|unblockUI|blockUI|blockOverlay|hide|opacity)\b~i', file_get_contents(APPPATH . 'views/mypanel/includes/footer.php'));
	}
}
?>
