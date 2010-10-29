<?
class SelectUserBean extends RequestBean {
	    
	private $userId;
	
    public function getUserList() {
    	return ArrayUtil::toIndexedArray(UserServiceUtil::getUsers(), "id", "fullName");
    }
    
    public function setUserId($userId) {
    	$this->userId = $userId;
    }
    
    public function getUserId() {
    	return $this->userId;
    }
	
}
?>
