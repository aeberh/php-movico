<?php
class UserService extends UserServiceBase {

	public function create($firstName, $lastName, $default) {
		$user = $this->createUser();
		$user->setCreateDate(Date::createNow());
		return $this->doUpdate($user, $firstName, $lastName, $default);
	}
	
	public function update($id, $firstName, $lastName, $default) {
		$user = $this->getUser($id);
		return $this->doUpdate($user, $firstName, $lastName, $default);
	}
	
	private function doUpdate(User $user, $firstName, $lastName, $default) {
		$this->validate($firstName, $lastName);
		$user->setFirstName($firstName);
		$user->setLastName($lastName);
		$user->setDefault($default);
		return $this->updateUser($user);
	}
	
	private function validate($firstName, $lastName) {
		if(empty($firstName)) {
			throw new InvalidFirstNameException();
		}
		if(empty($lastName)) {
			throw new InvalidLastNameException();
		}
	}
	
}
?>