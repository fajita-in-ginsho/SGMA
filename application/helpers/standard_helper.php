<?php

function searchFromArrayOfArray($array_of_array, $key, $val, $return_key){
    
    foreach($array_of_array as $array){
		if($array[$key] == $val){
			return $array[$return_key];
		}
	}
}


?>
