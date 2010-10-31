<?
class LoginBean extends SessionBean {
	
	private $username;
	private $password;
	
	
	public function login() {
		if($this->username == $this->password) {
			return "beans/session/logged-in";
		}
		$this->username = "";
		$this->password = "";
		return null;
	}
	
	public function toProfile() {
		return "beans/session/profile";
	}
	
	
	public function setUsername($username) {
		$this->username = $username;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
}
?>