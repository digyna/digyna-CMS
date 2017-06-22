<?php

function submodule_exist($module_id,$allowed_submodules)
{
    foreach($allowed_submodules as $submodule)
    {
        if (in_array($module_id, (array) $submodule))
        {
            return TRUE;
        }
    } 

    return FALSE;
}

?>
