<?php

/*
 * $query_obj is object returned by the active record query result.
 * so, it can be access like $query_obj->key to get a value.
 * now, this method return the value of an attribute whose name matches with the 
 * give $return_key from the row, which can be identify by the $key and $val.
 * which $key indicates the attribute name and $val indicates its value.
 * 
 * $key and $val should identify single row.
 * if there's multi hit, do not return.
 */
function searchFromQueryResult($query_obj, $key, $val, $return_key){
	foreach($query_obj as $row){
		if($row->$key == $val){
			return $row->$return_key;
		}
	}
}

?>
