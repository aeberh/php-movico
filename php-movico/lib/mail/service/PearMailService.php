<?php
class PearMailService implements MailService {
	
	private $settings;
	
	public function __construct() {
		$this->settings = Singleton::create("Settings");
	}
	
	public function send(MailMessage $message) {
		$from = $this->getFrom($message);
		$to = $this->getTo($message);
		//$cc = $message->getCcAddresses();
		//$bcc = $message->getBccAddresses();
		
		$headers = array(
			"From" => $message->getFrom(),
			"To" => $message->getToAddressList(),
			"Subject" => $message->getSubject()
		);
		$smtp = Mail::factory("smtp", array(
			"host" => $this->settings->getSmtpHost(),
			"port" => $this->settings->getSmtpPort(),
			"auth" => $this->settings->getSmtpAuth(),
			"username" => $this->settings->getSmtpUsername(),
			"password" => $this->settings->getSmtpPassword()
		));
 
		$mail = $smtp->send($to, $headers, $message->getBody());
 
		if (PEAR::isError($mail)) {
			throw new MailDeliveryException();
		}
	}
	
	private function getFrom(MailMessage $message) {
		$result = $message->getFrom();
		if(empty($result)) {
			$result = $this->settings->getSmtpDefaultFrom();
			if(empty($result)) {
				throw new EmptyFromAddressException();
			}
		}
		EmailAddress::validate($result);
		return $result;
	}
	
	private function getTo(MailMessage $message) {
		return $message->getToAddresses();
	}
	
}
?>