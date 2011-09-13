<?php
interface MailService {
	
	public function send(MailMessage $message);
	
}
?>