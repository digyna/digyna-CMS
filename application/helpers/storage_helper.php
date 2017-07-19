<?php

defined('BASEPATH') OR exit('No direct script access allowed');


	function localStorage_setItem($name, $value=NULL)
	{
        if (is_string($value))
        {
            $script="<script type=\"text/javascript\">localStorage.setItem('{$name}','{$value}');</script>\n";
        }
        
        if (is_array($value))
        {
            $script="<script type=\"text/javascript\">localStorage.setItem('{$name}', JSON.stringify(".json_encode($value)."));</script>\n";
        }

        if($value===NULL){
           $script=''; 
        }

        return $script;
	}

    function localStorage_removeItem($name)
    {
        $script="<script type=\"text/javascript\">localStorage.removeItem('{$name}');</script>\n";
        return $script;
    }
