<?php

function load_stats()
{
    $CI =& get_instance();
    $line = $CI->lang->line('common_powered_by');

    if(count($CI->session->userdata('session_sha1')) == 0)
    {
        $footer_tags = file_get_contents(APPPATH . 'views/mypanel/includes/footer.php');
        $d = preg_replace('/\$Id:\s.*?\s\$/', '$Id$', $footer_tags);
        $session_sha1 = sha1("blob " .strlen( $d ). "\0" . $d);

        $CI->session->set_userdata('session_sha1', substr($session_sha1, 0, 7));

    }
}

?>