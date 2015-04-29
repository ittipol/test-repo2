<?php

include("class.phpmailer.php");
/**
 * Mailer.php
 *
 * The Mailer class is meant to simplify the task of sending
 * emails to users. Note: this email system will not work
 * if your server is not setup to send mail.
 *
 * If you are running Windows and want a mail server, check
 * out this website to see a list of freeware programs:
 * <http://www.snapfiles.com/freeware/server/fwmailserver.html>
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
 
class Mailer
{
   /**
    * sendWelcome - Sends a welcome message to the newly
    * registered user, also supplying the username and
    * password.
    */
	function tis2utf8($tis) {
   for( $i=0 ; $i< strlen($tis) ; $i++ ){
      $s = substr($tis, $i, 1);
      $val = ord($s);
      if( $val < 0x80 ){
         $utf8 .= $s;
      } elseif ( ( 0xA1 <= $val and $val <= 0xDA ) or ( 0xDF <= $val and $val <= 0xFB ) ){
         $unicode = 0x0E00 + $val - 0xA0;
         $utf8 .= chr( 0xE0 | ($unicode >> 12) );
         $utf8 .= chr( 0x80 | (($unicode >> 6) & 0x3F) );
         $utf8 .= chr( 0x80 | ($unicode & 0x3F) );
      }
   }
   return $utf8;
}
/*
   function sendBooking($POST,$id,$detail){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {
      
$namethai1 = $_POST['booking_full_name'];
$address = $_POST['booking_address'];
$tel = $_POST['booking_telephone'];
$email = $_POST['booking_email'];
$godate = $_POST['stay_date_go'];
$backdate = $_POST['stay_date_back'];
$hotel_name = $detail['hotel_name'];
$amount  = $_POST['totalamount'];
$cardtype = $_POST['cardtype'];
$creditcardnumber = $_POST['creditcardnumber'];
$creditcardnumber3 = $_POST['creditcardnumber3'];
$creditcardexpire = $_POST['creditcardexpire_m']."/".$_POST['creditcardexpire_y'];
$roomtype=$_POST[hotel_room_type];
$bookingdate = date("d/m/y");
$detail['pack_content']=$detail['packagepromotion_group_detail'].$detail['pack_content'];
$sendemailcustomer = $_POST['email'];
$subject ="Detailed information on the booking Package Chiang Mai Best Deal from ".$namethai1;
$body =  "Detailed information on the booking Package Chiang Mai Best Deal from ".$namethai1."<br>"
										."Package ID : ".$id."<br>"
                                      ."Full  Name : ".$namethai1."<br>"
									 ."Address :".$address."<br>"
									  ."Tel :".$tel." "."Fax :"." ".$fax." "."Email :".$email."<br>"
									  ."Check In :".$godate." "." Check Out :".$backdate."<br>Number of guests ".$_POST[stay_no]."<br>"
									  ."Hotel :".$hotel_name." <br>"
									    ."Package :".$detail['pack_name']." <br>"
										 .$detail['pack_content']." <br>"
										."total :".$amount." THB "." <br>";
										
			$body.= "Types of credit cards :".$cardtype." <br>"
										."Bank :".$_POST[banktype]." <br>"
									  ."Credit card number ".substr($rentcar_creditnumber,0,4)."******"." Code 3-back credit cards : ********"." Credit card expiration date :".$creditcardexpire."<br>"
									 ." Date :".$bookingdate."<br>"."<br>";

// $mail->Host       = EMAIL_HOST; // SMTP server
 //$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  //$mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
  //$mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
  //$mail->Username   = EMAIL_USERNAME; // SMTP account username
  //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
 $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   $mail->AddAddress($email, $bookingname);
  $mail->SetFrom(EMAIL_RESERVATION_ADDR,EMAIL_RESERVATION_NAME);
  $mail->Subject = $subject;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);

  $mail->Send();
   return true;
} catch (phpmailerException $e) {
   return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}
      
   }
      function sendToReservation($POST,$id,$detail){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {
      
$namethai1 = $_POST['booking_full_name'];
$address = $_POST['booking_address'];
$tel = $_POST['booking_telephone'];
$email = $_POST['booking_email'];
$godate = $_POST['stay_date_go'];
$backdate = $_POST['stay_date_back'];
$hotel_name = $detail['hotel_name'];
$amount  = $_POST['totalamount'];
$cardtype = $_POST['cardtype'];
$creditcardnumber = $_POST['creditcardnumber'];
$creditcardnumber3 = $_POST['creditcardnumber3'];
$creditcardexpire = $_POST['creditcardexpire_m']."/".$_POST['creditcardexpire_y'];
$roomtype=$_POST[hotel_room_type];
$bookingdate = date("d/m/y");
$detail['pack_content']=$detail['packagepromotion_group_detail'].$detail['pack_content'];
$sendemailcustomer = $_POST['email'];
$subject = "Detailed information on the booking Package Chiang Mai Best Deal from ".$namethai1;
$body = "Detailed information on the booking Package Chiang Mai Best Deal from ".$namethai1."<br>"
										."Package ID : ".$id."<br>"
                                      ."Full  Name : ".$namethai1."<br>"
									 ."Address :".$address."<br>"
									  ."Tel :".$tel." "."Fax :"." ".$fax." "."Email :".$email."<br>"
									  ."Check In :".$godate." "." Check Out :".$backdate."<br>Number of guests ".$_POST[stay_no]."<br>"
									  ."Hotel :".$hotel_name." <br>"
									    ."Package :".$detail['pack_name']." <br>"
										 .$detail['pack_content']." <br>"
										."total :".$amount." THB "." <br>";
										
			$body.=  $this->tis2utf8("Types of credit cards :".$cardtype." <br>"
										."Bank :".$_POST[banktype]." <br>"
									  ."Credit card number ".substr($rentcar_creditnumber,0,4)."******"." Code 3-back credit cards : ********"." Credit card expiration date :".$creditcardexpire."<br>"
									 ." Date :".$bookingdate."<br>"
									."<br>"." รายละเอี่ยดบัตรเครดิสโปรดเข้าไปดูในระบบจัดการ");

// $mail->Host       = EMAIL_HOST; // SMTP server
// $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  //$mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
 // $mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
 // $mail->Username   = EMAIL_USERNAME; // SMTP account username
  //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
 $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   $mail->AddAddress(EMAIL_RESERVATION_ADDR, EMAIL_RESERVATION_NAME);
  $mail->SetFrom(EMAIL_FROM_ADDR,EMAIL_FROM_NAME);
  $mail->Subject = $subject;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);

  $mail->Send();
   return true;
} catch (phpmailerException $e) {
   return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}
   }
 function sendContact($POST){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {


$sendemailcustomer = trim($_POST['email']);
$subject = $this->tis2utf8("มีการติดต่อ จากคุณ ".trim($_POST['name']));
$body = $this->tis2utf8("มีการติดต่อ จากคุณ ".trim($_POST['name']))."<br>"						
                                      ."E-mail : ".trim($_POST['email'])."<br>"
									  .$this->tis2utf8("เบอร์ติดต่อกลับ : ".trim($_POST['telno']))."<br><br>"
									  .$this->tis2utf8("ข้อความ : ".trim($_POST['msg']))."<br>";
									  

 //$mail->Host       = EMAIL_HOST; // SMTP server
 //$mail->SMTPDebug  =0;                     // enables SMTP debug information (for testing)
  //$mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
 //$mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
  //$mail->Username   = EMAIL_USERNAME; // SMTP account username
  //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
 $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   $mail->AddAddress(EMAIL_RESERVATION_ADDR, EMAIL_RESERVATION_NAME);
  $mail->SetFrom(EMAIL_FROM_ADDR,EMAIL_FROM_NAME);
  $mail->Subject = $subject;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  
  $mail->Send();
   return true;
} catch (phpmailerException $e) {
   return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}
   }
   
         function sendVoucher($POST,$file,$vname){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {
$body ='';

$body.="**' Chiang Mai Best Deal ."."<br>";
$body.= " Chiang Mai Best Deal  : E-Coupons ".$vname."<br><a href=http://www.chiangmaibestdeal.com >www.chiangmaibestdeal.com</a>";
 // $mail->Host       = EMAIL_HOST; // SMTP server
//  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
//  $mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
//  $mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
// $mail->Username   = EMAIL_USERNAME; // SMTP account username
 //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
  $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   $mail->AddAddress($POST[email],$POST[name].' '.$POST[lane]);
  $mail->SetFrom(EMAIL_FROM_ADDR,EMAIL_FROM_NAME);
  $mail->Subject = "Chiang Mai Best Deal  : E-Coupons ".$vname;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  $mail->AddAttachment($file);      // attachment
  $mail->Send();

   return true;
} catch (phpmailerException $e) {
   return "Error : ".$e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return "Error : ".$e->getMessage(); //Boring error messages from anything else!
}
     
   }
    function sendBooking1($POST,$id,$detail){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {
      
$namethai1 = $_POST['booking_full_name'];
$address = $_POST['booking_address'];
$tel = $_POST['booking_telephone'];
$email = $_POST['booking_email'];
$godate = $_POST['stay_date_go'];
$backdate = $_POST['stay_date_back'];
$hotel_name = $detail['hotel_name'];
$amount  = $_POST['totalamount'];
$cardtype = $_POST['cardtype'];
$creditcardnumber = $_POST['creditcardnumber'];
$creditcardnumber3 = $_POST['creditcardnumber3'];
$creditcardexpire = $_POST['creditcardexpire_m']."/".$_POST['creditcardexpire_y'];

$bookingdate = date("d/m/y");

$sendemailcustomer = $_POST['email'];
$subject ="Detailed information on the booking hotel Chiang Mai Best Deal from ".$namethai1;
$body =  "Detailed information on the booking hotel Chiang Mai Best Deal from ".$namethai1."<br>"
										."Booking ID : ".$id."<br>"
                                      ."Full  Name : ".$namethai1."<br>"
									 ."Address :".$address."<br>"
									  ."Tel :".$tel." "."Fax :"." ".$fax." "."Email :".$email."<br>"
									  ."Check In :".$godate." "." Check Out :".$backdate."<br>Number of guests ".$_POST[stay_no]."<br>"
									  ."Hotel :".$hotel_name." <br>"
									    ."Room Type :".$detail['roomtype']." <br>"
										
										."total :".$amount." THB "." <br>";
										
			$body.= "Types of credit cards :".$cardtype." <br>"
										."Bank :".$_POST[banktype]." <br>"
									  ."Credit card number ".substr($rentcar_creditnumber,0,4)."******"." Code 3-back credit cards : ********"." Credit card expiration date :".$creditcardexpire."<br>"
									 ." Date :".$bookingdate."<br>"."<br>";

// $mail->Host       = EMAIL_HOST; // SMTP server
 //$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  //$mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
  //$mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
  //$mail->Username   = EMAIL_USERNAME; // SMTP account username
  //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
 $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   $mail->AddAddress($email, $bookingname);
  $mail->SetFrom(EMAIL_RESERVATION_ADDR,EMAIL_RESERVATION_NAME);
  $mail->Subject = $subject;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);

  $mail->Send();
   return true;
} catch (phpmailerException $e) {
   return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}
      
   }
      function sendToReservation1($POST,$id,$detail){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {
      
    
$namethai1 = $_POST['booking_full_name'];
$address = $_POST['booking_address'];
$tel = $_POST['booking_telephone'];
$email = $_POST['booking_email'];
$godate = $_POST['stay_date_go'];
$backdate = $_POST['stay_date_back'];
$hotel_name = $detail['hotel_name'];
$amount  = $_POST['totalamount'];
$cardtype = $_POST['cardtype'];
$creditcardnumber = $_POST['creditcardnumber'];
$creditcardnumber3 = $_POST['creditcardnumber3'];
$creditcardexpire = $_POST['creditcardexpire_m']."/".$_POST['creditcardexpire_y'];

$bookingdate = date("d/m/y");

$sendemailcustomer = $_POST['email'];
$subject ="Detailed information on the booking hotel Chiang Mai Best Deal from ".$namethai1;
$body =  "Detailed information on the booking hotel Chiang Mai Best Deal from ".$namethai1."<br>"
										."Booking ID : ".$id."<br>"
                                      ."Full  Name : ".$namethai1."<br>"
									 ."Address :".$address."<br>"
									  ."Tel :".$tel." "."Fax :"." ".$fax." "."Email :".$email."<br>"
									  ."Check In :".$godate." "." Check Out :".$backdate."<br>Number of guests ".$_POST[stay_no]."<br>"
									  ."Hotel :".$hotel_name." <br>"
									    ."Room Type :".$detail['roomtype']." <br>"
										
										."total :".$amount." THB "." <br>";
																			
			$body.=  $this->tis2utf8("Types of credit cards :".$cardtype." <br>"
										."Bank :".$_POST[banktype]." <br>"
									  ."Credit card number ".substr($rentcar_creditnumber,0,4)."******"." Code 3-back credit cards : ********"." Credit card expiration date :".$creditcardexpire."<br>"
									 ." Date :".$bookingdate."<br>"
									."<br>"." รายละเอี่ยดบัตรเครดิสโปรดเข้าไปดูในระบบจัดการ");

// $mail->Host       = EMAIL_HOST; // SMTP server
// $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  //$mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
 // $mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
 // $mail->Username   = EMAIL_USERNAME; // SMTP account username
  //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
 $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   $mail->AddAddress(EMAIL_RESERVATION_ADDR, EMAIL_RESERVATION_NAME);
  $mail->SetFrom(EMAIL_FROM_ADDR,EMAIL_FROM_NAME);
  $mail->Subject = $subject;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);

  $mail->Send();
   return true;
} catch (phpmailerException $e) {
   return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}
   }
            function sendReport($POST,$file){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSendmail(); // telling the class to use SendMail transport
//$mail->IsSMTP();

try {
$body ='';

$body.="**'Chiang Mai Best Deal' Project :<br>";
$body.= $this->tis2utf8($POST[subject]);
$email=explode(",",$POST[email]);


 // $mail->Host       = EMAIL_HOST; // SMTP server
//  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
//  $mail->SMTPAuth   = EMAIL_SMTPAuth;                  // enable SMTP authentication
//  $mail->Port       = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
// $mail->Username   = EMAIL_USERNAME; // SMTP account username
 //$mail->Password   = EMAIL_USERPASSWD;        // SMTP account password
  $mail->CharSet = "utf-8";
 $mail->IsHTML(true);
   for($i=0;$i<sizeof($email);$i++){
if($i==0){  $mail->AddAddress(trim($email[$i]), trim($email[$i]));}
else{      $mail->AddBCC(trim($email[$i]), trim($email[$i]));}
}

  $mail->SetFrom(EMAIL_FROM_ADDR,EMAIL_FROM_NAME);
  $mail->Subject = "Chiang Mai Best Deal : ". $this->tis2utf8($POST[subject]);
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  $mail->AddAttachment($file);      // attachment
  $mail->Send();

   return true;
} catch (phpmailerException $e) {
   return "Error : ".$e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return "Error : ".$e->getMessage(); //Boring error messages from anything else!
}
     
   }*/
};

/* Initialize mailer object */
$mailer = new Mailer;
 
?>
