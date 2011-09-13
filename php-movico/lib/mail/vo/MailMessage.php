<?php
class MailMessage {
	
	private static $defaultFrom = null;
	
	private $from = "";
	private $to;
	private $cc;
	private $bcc;
	private $subject = "";
	private $body = "";
	private $html = false;
	
	public function __construct() {
		self::initDefaultFrom();
		$this->to = new ArrayList("EmailAddress");
		$this->cc = new ArrayList("EmailAddress");
		$this->bcc = new ArrayList("EmailAddress");
	}
	
	public function setFrom(EmailAddress $from) {
		$this->from = $from;
	}
	
	public function getFrom() {
		return $this->from;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function isHtml() {
		return $this->html;
	}
	
	public function addToAddress(EmailAddress $toAddress) {
		$this->to->add($toAddress);
	}
	
	public function getToAddressList() {
		return $this->to->join(", ");
	}
	
	public function addCcAddress(EmailAddress $ccAddress) {
		$this->cc->add($ccAddress);
	}
	
	public function getCcAddressList() {
		return $this->cc->join(", ");
	}
	
	public function addBccAddress(EmailAddress $bccAddress) {
		$this->bcc->add($bccAddress);
	}
	
	public function getBccAddressList() {
		return $this->bcc->join(", ");
	}
	
	public function getSubject() {
		return $this->subject;
	}
	
	public function setSubject($subject) {
		$this->subject = $subject;
	}
	
	public function getBody() {
		return $this->body;
	}
	
	public function setBody($body) {
		$this->body = $body;
	}
	
	public function validate() {
		if(empty($this->from)) {
			throw new EmptyFromAddressException();
		}
	}
	
	private static function initDefaultFrom() {
		if(!is_null(self::$defaultFrom)) {
			return;
		}
		$settings = Singleton::create("Settings");
		$email = $settings->getSmtpDefaultFromEmail();
		$name = $settings->getSmtpDefaultFromName();
		try {
			self::$defaultFrom = new EmailAddress($email, $name);
		} catch(InvalidEmailAddressException $e) {
			//do nothing
		}
	}
	
}
?>