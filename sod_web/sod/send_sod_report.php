<?php
ob_start();
#include_once("sod_mail2.php");
include_once("sod_mail.php");
#include_once("sod_mail3.php");
#include_once("sod_mail4.php");
$buffer = ob_get_contents();
ob_end_clean();
$message = 'Test';
$to = "admin@support.com";
$from = "admin@support.com";
$d = date('Y-m-d H:i:s');
$subject = "SOD Status - Unix - $d";
#$headers = "MIME-Version: 1.0" . "\r\n";
#$headers = 'Reply-To: admin@support.com' . "\r\n"; 
#$headers = "From: $from <($from)>\r\n";
#$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";

$headers = 'Reply-To: admin@support.com' . "\r\n" .
    'From: admin@support.com' . "\r\n" .
    'Content-type:text/html; charset=iso-8859-1\r\n' .
    'X-Mailer: PHP/' . phpversion();
    

mail($to,$subject,$buffer,$headers);
#mail($to, $subject, $message, $headers);

?>
