<?php
class UserService extends UserServiceBase {

	public function create($firstName, $lastName) {
		$user = $this->createUser();
		return $this->doUpdate($user, $firstName, $lastName);
	}
	
	public function update($id, $firstName, $lastName) {
		$user = $this->getUser($id);
		return $this->doUpdate($user, $firstName, $lastName);
	}
	
	private function doUpdate(User $user, $firstName, $lastName) {
		$this->validate($firstName, $lastName);
		$user->setFirstName($firstName);
		$user->setLastName($lastName);
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