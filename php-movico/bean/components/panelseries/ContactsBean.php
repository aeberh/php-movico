<?
class ContactsBean extends RequestBean {
	
	private $contacts;
	
	public function __construct() {
		$this->contacts[] = new Contact("Peter Mesotten", "Solution Engineer");
		$this->contacts[] = new Contact("Jan Janssen", "Truckchauffeur");
	}
	
	public function getContacts() {
		return $this->contacts;
	}
	
}
?>