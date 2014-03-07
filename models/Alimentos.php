<?php
class Alimentos extends ActiveRecord\Model {

	public function toJSON() {
		return json_encode(get_object_vars($this));
	}
}
?>