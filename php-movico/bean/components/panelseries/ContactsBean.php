<?
class ContactsBean extends RequestBean {
	
	private $contacts;
	
	public function __construct() {
		$this->contacts[] = new Contact("Peter Mesotten", 26, "Solution Engineer");
		$this->contacts[] = new Contact("Jan Janssen", 43, "Truckchauffeur");
		$this->contacts[] = new Contact("Ward Eerdekens", 21, "Accountant");
		$this->contacts[] = new Contact("Piet Haarbeek", 56, "Boekhouder");
	}
	
	public function getContactNames() {
		$result = array();
		foreach($this->contacts as $contact) {
			$result[] = $contact->getName();
		}
		return $result;
	}
	
	public function getContacts() {
		return $this->contacts;
	}
	
}
?>