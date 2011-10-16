<?php
class ApplicationConstants extends ApplicationBean {
	
	const DAY_FORMAT = "%a";
	const DATE_FORMAT = "%d-%m-%Y";
	const SMALL_DATE_FORMAT = "%d-%m";
	const TIME_FORMAT = "%H:%M";
	
	const ROLE_GLOBAL_ADMIN = "Administrator";
	const ROLE_PLAYER_ADMIN = "PlayerManager";
	const ROLE_NEWS_ADMIN = "NewsManager";
	const ROLE_CLUB_ADMIN = "ClubManager";
	const ROLE_GAME_ADMIN = "GameManager";
	const ROLE_PICTURE_ADMIN = "PictureManager";
	
	private $teamNos;
	private $rankings;
	private $roles;
	
	private $jevotaClubId;
	
	public function __construct() {
		$this->teamNos = ArrayUtil::makeAssociative(
			array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", 
			"REC A", "REC B", "REC C", "REC D", "REC E", "REC F",
			"REC G", "REC H", "REC I", "REC J")
		);
		$this->rankings = ArrayUtil::makeAssociative(
			array("NG", "E6", "E4", "E2", "E0", "D6", "D4", "D2", "D0",
			"C6", "C4", "C2", "C0")
		);
		$this->jevotaClubId = PingpongClubServiceUtil::getJevota()->getClubId();
		$this->roles = array(self::ROLE_GLOBAL_ADMIN, self::ROLE_NEWS_ADMIN, self::ROLE_CLUB_ADMIN, self::ROLE_GAME_ADMIN, self::ROLE_PLAYER_ADMIN);
	}
	
	public function getPlayersMap() {
		$players = PingpongPlayerServiceUtil::getUsersSortedByFirstName();
		return ArrayUtil::toIndexedArray($players, "playerId", "fullName");
	}
	
	public function getDayFormat() {
		return self::DAY_FORMAT;
	}
	
	public function getDateFormat() {
		return self::DATE_FORMAT;
	}
	
	public function getSmallDateFormat() {
		return self::SMALL_DATE_FORMAT;
	}
	
	public function getTimeFormat() {
		return self::TIME_FORMAT;
	}
	
	public function getDateTimeFormat() {
		return self::DATE_FORMAT."&nbsp;&nbsp;&nbsp;".self::TIME_FORMAT;
	}
	
	public function getTeamNos() {
		return $this->teamNos;
	}
	
	public function getRankings() {
		return $this->rankings;
	}
	
	public function getJevotaClubId() {
		return $this->jevotaClubId;
	}
	
	public function getRoles() {
		return $this->roles;
	}
	
}
?>