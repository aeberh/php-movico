<?php
class EditableUserBean extends SessionBean {
	
	private $users;
	
	public function getUsers() {
		if(!isset($this->users)) {
			$this->users = UserServiceUtil::getUsers();
		}
		return $this->users;
	}
	
	public function save() {
		foreach ($this->getUsers() as $user) {
			UserServiceUtil::updateUser($user);
		}
		MessageUtil::info("Users were succesfully updated!");
		return null;
	}
	
}
?>