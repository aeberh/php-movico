<?php
class Role extends RoleModel {

	public function getUsersConcat() {
		return implode(", ", $this->getUsers());
	}
	
}
?>