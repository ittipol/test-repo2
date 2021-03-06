<?php
/**
 * Session.php
 * 
 * The Session class is meant to simplify the task of keeping
 * track of logged in users and also guests.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
include("database.php");
include("mailer.php");
include("form.php");

class Session
{
   var $username;     //Username given on sign-up
   var $users_id;       
    var $userid;       //Random value generated on current login
 //  var $userlevel;    //The level to which the user pertains
 var $member_code;
   var $time;         //Time user was last active (page loaded)
   var $logged_in;    //True if user is logged in, false otherwise
   var $userinfo = array();  //The array holding all user info
   var $url;          //The page url current being viewed
   var $referrer;     //Last recorded site page viewed
   var $admin_login;
   /**
    * Note: referrer should really only be considered the actual
    * page referrer in process.php, any other time it may be
    * inaccurate.
    */

   /* Class constructor */
   function Session(){
      $this->time = time();
      $this->startSession();
   }

   /**
    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   function startSession(){
      global $database;  //The database connection
      session_start();   //Tell PHP to start the session

      /* Determine if user is logged in */
      $this->logged_in = $this->checkLogin();

      /**
       * Set guest value to users not logged in, and update
       * active guests table accordingly.
       */
      if(!$this->logged_in){
         $this->username = $_SESSION['username'] = GUEST_NAME;
        
      //   $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      }
      /* Update users last active timestamp */
     /* else{
         $database->addActiveUser($this->username, $this->time);
      }
      */
      /* Remove inactive visitors from database */
   /*   $database->removeInactiveUsers();
      $database->removeInactiveGuests();
      */
      /* Set referrer page */
      if(isset($_SESSION['url'])){
         $this->referrer = $_SESSION['url'];
      }else{
         $this->referrer = "/";
      }

      /* Set current url */
      $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
   }

   /**
    * checkLogin - Checks if the user has already previously
    * logged in, and a session with the user has already been
    * established. Also checks to see if user has been remembered.
    * If so, the database is queried to make sure of the user's 
    * authenticity. Returns true if the user has logged in.
    */
   function checkLogin(){
      global $database;  //The database connection
      /* Check if user has been remembered */
      if(isset($_COOKIE['member_code']) && isset($_COOKIE['cookid'])){
         $this->member_code = $_SESSION['member_code'] = $_COOKIE['member_code'];
         $this->userid   = $_SESSION['userid']   = $_COOKIE['cookid'];
      }

      /* Username and userid have been set and not guest */
      if(isset($_SESSION['member_code']) && isset($_SESSION['userid']) ){
         /* Confirm that username and userid are valid */
         if($database->confirmUserID($_SESSION['member_code'], $_SESSION['userid']) != 0){
            /* Variables are incorrect, user not logged in */
           unset($_SESSION['member_code']);
       unset($_SESSION['userid']);
		//print_r($_SESSION);
	
            return false;
         }

         /* User is logged in, set class variables */
         $this->userinfo  = $database->getUserInfo($_SESSION['member_code']);
	
         $this->member_code  = $this->userinfo['member_code'];
         $this->userid    = $this->userinfo['member_id'];

         return true;
      }
      /* User not logged in */
      else{
         return false;
      }
   }

   /**
    * login - The user has submitted his username and password
    * through the login form, this function checks the authenticity
    * of that information in the database and creates the session.
    * Effectively logging in the user if all goes well.
    */
   function login($member_code){
      global $database, $form;  //The database and form object

    
      $field = "login";  //Use field name for username
      if(!$member_code || strlen($member_code = trim($member_code)) == 0){
         $form->setError($field, "* Member Code not entered");
      }
     
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }

    

      /* Username and password correct, register session variables */
      $this->userinfo  = $database->getUserInfo($member_code);
	  if(!$this->userinfo['member_id']){
	     $form->setError($field, "* Member Code not Found !");
	   return false;
	  }
          $this->userid    = $_SESSION['userid']   =  $this->userinfo['member_id'];
		   $this->member_code  =  $_SESSION['member_code'] = $this->userinfo['member_code'];

      
      /* Insert userid into database and update active users table */
    /*  $database->updateUserField($this->username, "userid", $this->userid);
      $database->addActiveUser($this->username, $this->time);
      $database->removeActiveGuest($_SERVER['REMOTE_ADDR']);
*/
      /**
       * This is the cool part: the user has requested that we remember that
       * he's logged in, so we set two cookies. One to hold his username,
       * and one to hold his random value userid. It expires by the time
       * specified in constants.php. Now, next time he comes to our site, we will
       * log him in automatically, but only if he didn't log out before he left.
       */
  //    if($subremember){
         setcookie("member_code", $this->member_code, time()+COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   $this->userid,   time()+COOKIE_EXPIRE, COOKIE_PATH);
     // }

      /* Login completed successfully */
      return true;
   }

   /**
    * logout - Gets called when the user wants to be logged out of the
    * website. It deletes any cookies that were stored on the users
    * computer as a result of him wanting to be remembered, and also
    * unsets session variables and demotes his user level to guest.
    */
   function logout(){
      global $database;  //The database connection
      /**
       * Delete cookies - the time must be in the past,
       * so just negate what you added when creating the
       * cookie.
       */
      if(isset($_COOKIE['member_code']) && isset($_COOKIE['cookid'])){
         setcookie("member_code", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   "", time()-COOKIE_EXPIRE, COOKIE_PATH);
      }

      /* Unset PHP session variables */
	    unset($_SESSION['voucherid']);
      unset($_SESSION['member_code']);
      unset($_SESSION['userid']);

      /* Reflect fact that user has logged out */
      $this->logged_in = false;
      
      /**
       * Remove from active users table and add to
       * active guests tables.
       */
  //    $database->removeActiveUser($this->username);
  //    $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      
      /* Set user level to guest */
      $this->username  = GUEST_NAME;
    
   }

   /**
    * register - Gets called when the user has just submitted the
    * registration form. Determines if there were any errors with
    * the entry fields, if so, it records the errors and returns
    * 1. If no errors were found, it registers the new user and
    * returns 0. Returns 2 if registration failed.
    */
   function register($POST){
      global $database, $form, $mailer;  //The database, form and mailer object
   
      /* Username error checking */
   /*   $field = "user";  //Use field name for username
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered");
      }
      else{*/
         /* Spruce up username, check length */
      /*   $subuser = stripslashes($subuser);
         if(strlen($subuser) < 5){
            $form->setError($field, "* Username below 5 characters");
         }
         else if(strlen($subuser) > 30){
            $form->setError($field, "* Username above 30 characters");
         }*/
         /* Check if username is not alphanumeric */
         /*else if(!eregi("^([0-9a-zA-Z])+$", $subuser)){
            $form->setError($field, "* Username not alphanumeric");
         }*/
         /* Check if username is reserved */
       /*  else if(strcasecmp($subuser, GUEST_NAME) == 0){
            $form->setError($field, "* Username reserved word");
         }*/
         /* Check if username is already in use */
        // else
		$field = "name";
		 if($database->nameTaken($POST[firstname],$POST[lastname])){
            $form->setError($field, "* Name - Lastname  already in use");
         }
         /* Check if username is banned */
      /*   else if($database->usernameBanned($subuser)){
            $form->setError($field, "* Username banned");
         }*/
      

     
         /**
          * Note: I trimmed the password only after I checked the length
          * because if you fill the password field up with spaces
          * it looks like a lot more characters than 4, so it looks
          * kind of stupid to report "password too short".
          */
     // }
      
      /* Email error checking */
      $field = "email";  //Use field name for email
      if(!trim($POST[email])|| strlen($subemail = trim($POST[email])) == 0){
         $form->setError($field, "* Email not entered");
      }
      else{
         /* Check if valid email address */
         $regex = "^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
                 ."@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
                 ."\.([a-z]{2,}){1}$";
         if(!eregi($regex,trim($POST[email]))){
            $form->setError($field, "* Email invalid");
         }
         $subemail = stripslashes(trim($POST[email]));
      }
     
		 /* phone error checking */
   /*   $field = "phone";  //Use field phone 
      if(!$phone){
         $form->setError($field, "* Phone not entered");
      }
      else{*/
         /* Spruce up Phone and check length*/
       /*  $phone = stripslashes($phone);
         if(strlen($phone) < 4){
            $form->setError($field, "* Phone too short");
         }*/
   /* Check if Phone is not alphanumeric */
       /*  else if(!eregi("^([0-9-])+$", ($phone = trim($phone)))){
            $form->setError($field, "* Phone not alphanumeric");
         }
		 }*/
	 
   
		 
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return 1;  //Errors with form
      }
      /* No errors, add the new account to the */
      else{
	  $arraydb=$database->addNewUser($POST);
         if($arraydb[ID]){
		  $this->member_code=$arraydb[CODE];
		   $this->userid =$arraydb[ID];
		  $this->logged_in=true;
		  
            if(EMAIL_WELCOME){
               $mailer->sendWelcome($POST,$member_code);
            }
            return 0;  //New user added succesfully
         }else{
            return 2;  //Registration attempt failed
         }
      }
   }
   
   /**
    * editAccount - Attempts to edit the user's account information
    * including the password, which it first makes sure is correct
    * if entered, if so and the new password is in the right
    * format, the change is made. All other fields are changed
    * automatically.
    */
   function editAccount($subcurpass, $subnewpass, $subemail,$app_name,$country_id,$currency_code,$phone,$sex){
      global $database, $form;  //The database and form object
      /* New password entered */
      if($subnewpass){
         /* Current Password error checking */
         $field = "curpass";  //Use field name for current password
         if(!$subcurpass){
            $form->setError($field, "* Current Password not entered");
         }
         else{
            /* Check if password too short or is not alphanumeric */
            $subcurpass = stripslashes($subcurpass);
            if(strlen($subcurpass) < 4 ||
               !eregi("^([0-9a-z])+$", ($subcurpass = trim($subcurpass)))){
               $form->setError($field, "* Current Password incorrect");
            }
            /* Password entered is incorrect */
            if($database->confirmUserPass($this->username,md5($subcurpass)) != 0){
               $form->setError($field, "* Current Password incorrect");
            }
         }
         
         /* New Password error checking */
         $field = "newpass";  //Use field name for new password
         /* Spruce up password and check length*/
         $subpass = stripslashes($subnewpass);
         if(strlen($subnewpass) < 4){
            $form->setError($field, "* New Password too short");
         }
         /* Check if password is not alphanumeric */
         else if(!eregi("^([0-9a-z])+$", ($subnewpass = trim($subnewpass)))){
            $form->setError($field, "* New Password not alphanumeric");
         }
      }
      /* Change password attempted */
      else if($subcurpass){
         /* New Password error reporting */
         $field = "newpass";  //Use field name for new password
         $form->setError($field, "* New Password not entered");
      }
      
      /* Email error checking */
      $field = "email";  //Use field name for email
      if($subemail && strlen($subemail = trim($subemail)) > 0){
         /* Check if valid email address */
         $regex = "^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
                 ."@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
                 ."\.([a-z]{2,}){1}$";
         if(!eregi($regex,$subemail)){
            $form->setError($field, "* Email invalid");
         }
         $subemail = stripslashes($subemail);
      }
      /* app_name error checking */
      $field = "app_name";  //Use field app_name 
      if(!$app_name){
         $form->setError($field, "* App Name not entered");
      }
      else{
         /* Spruce up App Name and check length*/
         $app_name = stripslashes($app_name);
         if(strlen($app_name) < 4){
            $form->setError($field, "* App Name too short");
         }
         /* Check if App Name is not alphanumeric */
         else if(!eregi("^([0-9a-zA-Z])+$", ($app_name = trim($app_name)))){
            $form->setError($field, "* App Name not alphanumeric");
         }
		 }
		 /* phone error checking */
      $field = "phone";  //Use field phone 
      if(!$phone){
         $form->setError($field, "* Phone not entered");
      }
      else{
         /* Spruce up Phone and check length*/
         $phone = stripslashes($phone);
         if(strlen($phone) < 4){
            $form->setError($field, "* Phone too short");
         }
         /* Check if Phone is not alphanumeric */
         else if(!eregi("^([0-9-])+$", ($phone = trim($phone)))){
            $form->setError($field, "* Phone not alphanumeric");
         }
		 }
		 /* sex error checking */
      $field = "sex";  //Use field phone 
      if(!$sex){
         $form->setError($field, "* sex not entered");
      }
  
   
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return false;  //Errors with form
      }
      
      /* Update password since there were no errors */
      if($subcurpass && $subnewpass){
	
         $database->updateUserField($this->username,"password",md5($subnewpass));
      }
      
      /* Change Email */
      if($subemail){
         $database->updateUserField($this->username,"email",$subemail);
      }
	  $array_field=array("app_name","country_id","app_currency_code","phone","sex");
	  $array_value=array($app_name,$country_id,$currency_code,$phone,$sex);
        $database->updateUserAllField($this->username, $array_field, $array_value);
      /* Success! */
      return true;
   }
   
   /**
    * isAdmin - Returns true if currently logged in user is
    * an administrator, false otherwise.
    */
 /*  function isAdmin(){
      return ($this->userlevel == ADMIN_LEVEL ||
              $this->username  == ADMIN_NAME);
   }
   */
   /**
    * generateRandID - Generates a string made up of randomized
    * letters (lower and upper case) and digits and returns
    * the md5 hash of it to be used as a userid.
    */
   function generateRandID(){
      return md5($this->generateRandStr(16));
   }
   
   /**
    * generateRandStr - Generates a string made up of randomized
    * letters (lower and upper case) and digits, the length
    * is a specified parameter.
    */
   function generateRandStr($length){
      $randstr = "";
      for($i=0; $i<$length; $i++){
         $randnum = mt_rand(0,61);
         if($randnum < 10){
            $randstr .= chr($randnum+48);
         }else if($randnum < 36){
            $randstr .= chr($randnum+55);
         }else{
            $randstr .= chr($randnum+61);
         }
      }
      return $randstr;
   }
};


/**
 * Initialize session object - This must be initialized before
 * the form object because the form uses session variables,
 * which cannot be accessed unless the session has started.
 */
$session = new Session;

/* Initialize form object */
$form = new Form;

?>
