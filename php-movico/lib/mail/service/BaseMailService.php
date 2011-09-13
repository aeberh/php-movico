<?php
class BaseMailService implements MailService {
	
	private $settings;
	
	public function __construct() {
		$this->settings = Singleton::create("Settings");
	}
	
	public function send(MailMessage $message) {
		$message->validate();
		
		$from = $message->getFrom()->getFullAddress();
		$to = $message->getToAddressList();
		$cc = $message->getCcAddressList();
		$bcc = $message->getBccAddressList();
		
		$subject = $message->getSubject();
		$body = $message->getBody();
		
		$headers = "";
		if($message->isHtml()) {
			$headers .= "MIME-Version: 1.0\r\nContent-type: text/html;charset=iso-8859-1\r\n";
		}
		$headers .= "From: $from\r\n";
		$headers .= "To: $to\r\n";
		$headers .= "Cc: $cc\r\n";
		$headers .= "Bcc: $bcc\r\n";
		$ok = mail($to, $subject, $body, $headers);
		if(!$ok) {
			throw new MailDeliveryException();
		}
	}
	
}
?>