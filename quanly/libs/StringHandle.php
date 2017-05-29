<?php

function replaceEditor($input)
{
	$new_string = preg_replace("#font-size(.+?);#", "", $input);
	$new_string = preg_replace("#font-family(.+?);#", "", $new_string);
	
	return $new_string;
}

?>