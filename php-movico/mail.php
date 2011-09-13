<?php
require_once("path.php");

$ms = new BaseMailService();
$msg = new MailMessage();
$msg->addToAddress(new EmailAddress("limburgie@gmail.com"));
$msg->setFrom(new EmailAddress("limburgie@gmail.com"));
$msg->setSubject("Test from Movico");
$msg->setBody("This is a body message");
$ms->send($msg);
?>