<?php
class Compatible {
	public static function compatible() {
		　　if(!function_exists("json_encode")) {
		　　	　　　　function json_encode($object) {
		　　	　　　　　　　　　　require_once(APPPATH . "third_party/JSON.php");
		　　	　　　　　　　　　　　　　　　　$json = new Services_JSON();
	　　　　　　return $json->encode($object);
	　　　　}
	　　}
	}
}
?>
