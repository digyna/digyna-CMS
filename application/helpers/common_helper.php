<?php

function cortar_palabras($texto, $largor = 20, $puntos = "...") 
{ 
   $palabras = explode(' ', $texto); 
   if (count($palabras) > $largor) 
   { 
   	return implode(' ', array_slice($palabras, 0, $largor)) ." ". $puntos; 
   } 
   else
   {
   	return $texto; 
   } 
}

function dateDiff($date,$to=NULL) {

  $date = preg_replace('/:[0-9][0-9][0-9]/','',$date);
  $time = strtotime($date);

  if(is_null($to)) {
    $to=time();
  }

  $diff = $to - $time;
  $info = array();
  if($diff>631138520) {
    // Decadas
    $info['decadas'] = ($diff - ($diff%315569260))/315569260;
    $diff = $diff%315569260;
  }
  elseif($diff>315569260) {
    // Decadas
    $info['hace 1 decada'] = ($diff - ($diff%315569260))/315569260;
    $diff = $diff%315569260;
  }
  elseif($diff>63113852) {
    // Años
    $info['años'] = ($diff - ($diff%31556926))/31556926;
    $diff = $diff%31556926;
  }
  elseif($diff>31556926) {
    // Años
    $info['hace 1 año'] = ($diff - ($diff%31556926))/31556926;
    $diff = $diff%31556926;
  }
   elseif($diff>5259486) {
    // Meses
    $info['meses'] = ($diff - ($diff%2629743))/2629743;
    $diff = $diff%2629743;
  }
  elseif($diff>2629743) {
    // Meses
    $info['hace 1 mes'] = ($diff - ($diff%2629743))/2629743;
    $diff = $diff%2629743;
  }
  elseif($diff>1209600) {
    // Semanas
    $info['semanas'] = ($diff - ($diff%604800))/604800;
    $diff = $diff%604800;
  }
  elseif($diff>604800) {
    // Semanas
    $info['hace 1 semana'] = ($diff - ($diff%604800))/604800;
    $diff = $diff%604800;
  }
  elseif($diff>172800) {
    // Dias
    $info['dias'] = ($diff - ($diff%86400))/86400;
    $diff = $diff%86400;
  }
  elseif($diff>86400) {
    // Dias
    $info['ayer'] = ($diff - ($diff%86400))/86400;
    $diff = $diff%86400;
  }
  elseif($diff>7200) {
    // Horas
    $info['horas'] = ($diff - ($diff%3600))/3600;
    $diff = $diff%3600;
  }
  elseif($diff>3600) {
    // Hora
    $info['hace 1 hora'] = ($diff - ($diff%3600))/3600;
    $diff = $diff%3600;
  }
  elseif($diff>60) {
    // Minutos
    $info['minutos'] = ($diff - ($diff%60))/60;
    $diff = $diff%60;
  }
  elseif($diff>0) {
  // Segundos
    $info['segundos'] = $diff;
  }
  $f = '';
  foreach($info as $k=>$v) {
    if($v>1){
    	$f .= "hace $v $k, ";
    }else{
    	$f .= "$k, ";
    }
  }
  return substr($f,0,-2);
}



?>
