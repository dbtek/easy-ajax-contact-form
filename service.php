<?php
/**
 * Easy Ajax Contact Form
 * © 2014, Ismail Demirbilek
 */

/*
 * Email addresses to send messages
 * Multiple mail addresses supported
 */

$emailAddresses = array(
    'your-email-address@example.com',
    'your-email-address-2@example.com'
);

error_reporting(0);
date_default_timezone_set('America/Los_Angeles');
require "lib/phpmailer/class.phpmailer.php";

session_name("easy-contact");
session_start();


foreach ($_POST as $key => $val) {
    $_POST[$key] = stripslashes($_POST[$key]);
    $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

// Create new message object
$message = new Message($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);

try {
    // Check validities
    if(!$message->isNameValid())
        throw new Exception('Name field is too short.');
    if(!$message->isEmailValid())
        throw new Exception('Email is not valid.');
    if(!$message->isSubjectValid())
        throw new Exception('Subject field is too short.');
    if(!$message->isMessageValid())
        throw new Exception('Message field is too short.');

    if ((int)$_POST['captcha'] != $_SESSION['expected'])
        throw new Exception('Captcha code is wrong.');

    $message->send($emailAddresses);
    echo json_encode(array('status' => 'ok','log' => 'Mail sent.'));
}
catch (Exception $ex){
    $error = $ex->getMessage();
    echo json_encode(array('status' => 'fail','log' => $error));
}

/**
 * Class Message
 */
Class Message {

    var $name;
    var $email;
    var $subject;
    var $message;

    public function __construct($name, $email, $subject, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function send($emailAddresses) {
        $phpMailer = new PHPMailer();
        $phpMailer->IsMail();

        $phpMailer->AddReplyTo($this->email, $this->name);

        foreach($emailAddresses as $emailAddress)
            $phpMailer->AddAddress($emailAddress);

        $phpMailer->SetFrom($this->email, $this->name);
        $phpMailer->Subject = 'Contact form message: '.$this->subject.' from '.$this->name.'.';

        $msg = 'Name:	    ' . $this->name.'<br />'.
               'Email:	    ' . $this->email.'<br />'.
               'IP Address:	' . $_SERVER['REMOTE_ADDR'] . '<br /><br />'.
               'Message:<br /><br />'.
               nl2br($this->message);

        $phpMailer->MsgHTML($msg);

        $phpMailer->Send();
    }

    public function isEmailValid() {
        if($this->isTextValid($this->email))
            return preg_match('/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/', $this->email);
        return false;
    }

    public function isNameValid() {
        return $this->isTextValid($this->name);
    }

    public function isSubjectValid() {
        return $this->isTextValid($this->subject);
    }

    public function isMessageValid(){
        return $this->isTextValid($this->message);
    }

    public function isTextValid($text) {
        $length = 3;
        return mb_strlen(strip_tags($text), 'utf-8') >= $length;
    }

}