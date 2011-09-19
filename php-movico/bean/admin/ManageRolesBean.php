<?php
class ManageRolesBean extends RequestBean {
	
	private $selected;
	private $selectedPlayerId;
	
	public function getRoles() {
		RoleServiceUtil::createAll(BeanLocator::get("ApplicationConstants")->getRoles());
		return RoleServiceUtil::getRoles();
	}
	
	public function __construct() {
		$this->selected = Context::hasParam(0) ? RoleServiceUtil::getRole(Context::getParam(0)) : new Role();
	}
	
	public function deletePlayer($playerId) {
		RoleServiceUtil::deleteMember($this->selected->getRoleId(), $playerId);
		MessageUtil::success("Speler werd succesvol verwijderd van de rol");
		return null;
	}
	
	public function addPlayer() {
		RoleServiceUtil::addMember($this->selected->getRoleId(), $this->selectedPlayerId);
		MessageUtil::success("Speler werd succesvol toegevoegd aan de rol");
		return null;
	}
	
	public function getAllPlayers() {
		$players = PingpongPlayerServiceUtil::getUsersSortedByFirstName();
		return ArrayUtil::toIndexedArray($players, "playerId", "fullName");
	}
	
	public function getPlayersWithRole() {
		return $this->selected->getUsers();
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
	public function getSelectedPlayerId() {
		return $this->selectedPlayerId;
	}
	
	public function setSelectedPlayerId($selectedPlayerId) {
		$this->selectedPlayerId = $selectedPlayerId;
	}
	
}
?>