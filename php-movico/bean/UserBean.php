<?php
class UserBean extends RequestBean {
	
	private $users = null;
	
	private $editMode;
	
	private $firstName;
	private $lastName;
	private $id;
	
    public function getUsers() {
    	if($this->users === null) {
    		$this->users = $this->retrieveUsers();
    	}
    	return $this->users;
    }
    
    private function retrieveUsers() {
    	return UserServiceUtil::getUsers();
    }
    
    public function edit() {
    	$selectedUser = $this->getSelectedUser();
    	$this->id = $selectedUser->getId();
    	$this->firstName = $selectedUser->getFirstName();
    	$this->lastName = $selectedUser->getLastName();
    	$this->editMode = true;
    	return "edit_user";
    }
    
    public function save() {
    	try {
	    	if($this->editMode) {
		    	$user = UserServiceUtil::update($this->id, $this->firstName, $this->lastName);
	    	} else {
	    		$user = UserServiceUtil::create($this->firstName, $this->lastName);
	    	}
	    	$action = $this->editMode ? "aangepast":"toegevoegd";
    		MessageUtil::info("Gebruiker werd succesvol $action!");
    		return "index";
    	} catch(InvalidFirstNameException $e) {
    		MessageUtil::error("Ongeldige voornaam!");
    	} catch(InvalidLastNameException $e) {
    		MessageUtil::error("Ongeldige achternaam!");
    	}
    	return null;
    }
    
    public function back() {
    	return "index";
    }
    
    public function delete() {
    	$user = $this->getSelectedUser();
    	UserServiceUtil::deleteUser($user->getId());
    	MessageUtil::info("Gebruiker werd succesvol verwijderd!");
    	return null;
    }
    
    private function getSelectedUser() {
    	$users = $this->retrieveUsers();
    	return $users[$this->getSelectedRowIndex()];
    }
    
    public function create() {
    	$this->editMode = false;
    	return "edit_user";
    }
    
    public function getId() {
    	return $this->id;
    }
    
    public function setId($id) {
    	$this->id = $id;
    }
    
    public function getFirstName() {
    	return $this->firstName;
    }
    
    public function setFirstName($firstName) {
    	$this->firstName = $firstName;
    }
    
    public function getLastName() {
    	return $this->lastName;
    } 
    
    public function setLastName($lastName) {
    	$this->lastName = $lastName;
    }
    
    public function setEditMode($editMode) {
    	$this->editMode = $editMode;
    }
    
    public function getEditMode() {
    	return $this->editMode;
    }
        
}
?>