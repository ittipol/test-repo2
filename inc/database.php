<?php
/**
 * Database.php
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 17, 2004
 */
include("constants.php");
      
class MySQLDB
{
   var $connection;         //The MySQL database connection
   var $num_active_users;   //Number of active users viewing site
   var $num_active_guests;  //Number of active guests viewing site
   var $num_members;        //Number of signed-up users
   /* Note: call getNumMembers() to access $num_members! */

   /* Class constructor */
   function MySQLDB(){
      /* Make connection to database */
      $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
      mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());
	   if(!SET_CHARSETUTF8){
      mysql_set_charset('tis620',  $this->connection); 
	  }else{
mysql_set_charset('utf8',  $this->connection); 
}
	  mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

      /**
       * Only query database to find out number of members
       * when getNumMembers() is called for the first time,
       * until then, default value set.
       */
      $this->num_members = -1;
      
   //   if(TRACK_VISITORS){
         /* Calculate number of users at site */
 //        $this->calcNumActiveUsers();
      
         /* Calculate number of guests at site */
   //      $this->calcNumActiveGuests();
    //  }
   }

   /**
    * confirmUserPass - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given password is the same password in the database
    * for that user. If the user doesn't exist or if the
    * passwords don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserPass($username, $password){
      /* Add slashes if necessary (for query) */
      if(!get_magic_quotes_gpc()) {
	      $username = addslashes($username);
      }

      /* Verify that user is in database */
      $q = "SELECT password FROM ".TBL_USERS." WHERE username = '$username'";
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_num_rows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve password from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['password'] = stripslashes($dbarray['password']);
      $password = stripslashes($password);

      /* Validate that password is correct */
      if($password == $dbarray['password']){
         return 0; //Success! Username and password confirmed
      }
      else{
         return 2; //Indicates password failure
      }
   }
   
   /**
    * confirmUserID - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given userid is the same userid in the database
    * for that user. If the user doesn't exist or if the
    * userids don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserID($member_code, $userid){
      /* Add slashes if necessary (for query) */


      /* Verify that user is in database */
      $q = "SELECT member_id FROM ".TBL_USERS." WHERE member_code = '$member_code'";
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_num_rows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve userid from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['member_id'] = stripslashes($dbarray['member_id']);
      $userid = stripslashes($userid);

      /* Validate that userid is correct */
      if(trim($userid) == $dbarray['member_id']){
         return 0; //Success! Username and userid confirmed
      }
      else{
         return 2; //Indicates userid invalid
      }
   }
   
   /**
    * usernameTaken - Returns true if the username has
    * been taken by another user, false otherwise.
    */
   function usernameTaken($username){
      if(!get_magic_quotes_gpc()){
         $username = addslashes($username);
      }
      $q = "SELECT username FROM ".TBL_USERS." WHERE username = '$username'";
      $result = mysql_query($q, $this->connection);
      return (mysql_num_rows($result) > 0);
   }
      
   /**
    * nameTaken - Returns true if the username has
    * been taken by another user, false otherwise.
    */
   function nameTaken($name,$lastname){
      if(!get_magic_quotes_gpc()){
         $name = addslashes($name);
      }
	   if(!get_magic_quotes_gpc()){
         $lastname = addslashes($lastname);
      }
      $q = "SELECT member_name FROM ".TBL_USERS." WHERE member_name = '$name' and member_lastname='$lastname'";
      $result = mysql_query($q, $this->connection);
      return (mysql_num_rows($result) > 0);
   }
   /**
    * usernameBanned - Returns true if the username has
    * been banned by the administrator.
    */
   function usernameBanned($username){
      if(!get_magic_quotes_gpc()){
         $username = addslashes($username);
      }
      $q = "SELECT username FROM ".TBL_BANNED_USERS." WHERE username = '$username'";
      $result = mysql_query($q, $this->connection);
      return (mysql_num_rows($result) > 0);
   }
   
   /**
    * addNewUser - Inserts the given (username, password, email)
    * info into the database. Appropriate user level is set.
    * Returns true on success, false otherwise.
    */
   function addNewUser($POST){
   
	  
      $q = "INSERT INTO ".TBL_USERS." (agent_code,member_name,member_lastname,member_address,member_telephone,member_email,member_country_code,member_country_area,agent_name,country_id,register_date)  VALUES ('".trim($POST[agentcode])."', '".trim($POST[firstname])."', '".trim($POST[lastname])."', '".trim($POST[address])."', '".trim($POST[telephone])."', '".trim($POST[email])."','".trim($POST[countrycode])."','".trim($POST[countryarea])."','".trim($POST[agentname])."','".trim($POST[country_id])."',NOW())";
    mysql_query($q, $this->connection);
	$id=mysql_insert_id($this->connection);
	
      $q = "SELECT country_code FROM ".TBL_COUNTRY." WHERE country_id = '".trim($POST[country_id])."'";
      $result = mysql_query($q, $this->connection);
     

      /* Retrieve userid from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
	  $num=$id;
	  $num=($num<10) ? "00$num" : $num;
	  $num=($num<100 && $num>=10) ? "0$num" : $num;
    $member_code=  $dbarray['country_code'].$num;
	$q = "UPDATE ".TBL_USERS." SET member_code = '$member_code' WHERE member_id = '$id'";
	 $result = mysql_query($q, $this->connection);
	 
	 return  array("CODE"=>$member_code,"ID"=>$id);
   }
   
   /**
    * updateUserField - Updates a field, specified by the field
    * parameter, in the user's row of the database.
    */
   function updateUserField($username, $field, $value){
      $q = "UPDATE ".TBL_USERS." SET ".$field." = '$value' WHERE username = '$username'";
      return mysql_query($q, $this->connection);
   }
    function updateUserAllField($username, $array_field, $array_value){
      $q = "UPDATE ".TBL_USERS." SET ";
	  for($i=0;$i<sizeof($array_field);$i++){
	 $q .= $array_field[$i]." = '".$array_value[$i]."'";
	 if($i<sizeof($array_field)-1){
	 $q .= ",";
	 }
	 }
	   $q .= " WHERE username = '$username'";
      return mysql_query($q, $this->connection) or die($form->setError('save_error',mysql_error()));
   }
   /**
    * getUserInfo - Returns the result array from a mysql
    * query asking for all information stored regarding
    * the given username. If query fails, NULL is returned.
    */
   function getUserInfo($member_code){
      $q = "SELECT * FROM ".TBL_USERS." WHERE member_code = '$member_code'";
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_num_rows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_array($result);
      return $dbarray;
   }
   
   /**
    * getNumMembers - Returns the number of signed-up users
    * of the website, banned members not included. The first
    * time the function is called on page load, the database
    * is queried, on subsequent calls, the stored result
    * is returned. This is to improve efficiency, effectively
    * not querying the database when no call is made.
    */
   function getNumMembers(){
      if($this->num_members < 0){
         $q = "SELECT * FROM ".TBL_USERS;
         $result = mysql_query($q, $this->connection);
         $this->num_members = mysql_num_rows($result);
      }
      return $this->num_members;
   }
   
   /**
    * calcNumActiveUsers - Finds out how many active users
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveUsers(){
      /* Calculate number of users at site */
      $q = "SELECT * FROM ".TBL_ACTIVE_USERS;
      $result = mysql_query($q, $this->connection);
      $this->num_active_users = mysql_num_rows($result);
   }
   
   /**
    * calcNumActiveGuests - Finds out how many active guests
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveGuests(){
      /* Calculate number of guests at site */
      $q = "SELECT * FROM ".TBL_ACTIVE_GUESTS;
      $result = mysql_query($q, $this->connection);
      $this->num_active_guests = mysql_num_rows($result);
   }
   
   /**
    * addActiveUser - Updates username's last active timestamp
    * in the database, and also adds him to the table of
    * active users, or updates timestamp if already there.
    */
   function addActiveUser($username, $time){
      $q = "UPDATE ".TBL_USERS." SET timestamp = '$time' WHERE username = '$username'";
      mysql_query($q, $this->connection);
      
      if(!TRACK_VISITORS) return;
      $q = "REPLACE INTO ".TBL_ACTIVE_USERS." VALUES ('$username', '$time')";
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }
   
   /* addActiveGuest - Adds guest to active guests table */
   function addActiveGuest($ip, $time){
      if(!TRACK_VISITORS) return;
      $q = "REPLACE INTO ".TBL_ACTIVE_GUESTS." VALUES ('$ip', '$time')";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* These functions are self explanatory, no need for comments */
   
   /* removeActiveUser */
   function removeActiveUser($username){
      if(!TRACK_VISITORS) return;
      $q = "DELETE FROM ".TBL_ACTIVE_USERS." WHERE username = '$username'";
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }
   
   /* removeActiveGuest */
   function removeActiveGuest($ip){
      if(!TRACK_VISITORS) return;
      $q = "DELETE FROM ".TBL_ACTIVE_GUESTS." WHERE ip = '$ip'";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* removeInactiveUsers */
   function removeInactiveUsers(){
      if(!TRACK_VISITORS) return;
      $timeout = time()-USER_TIMEOUT*60;
      $q = "DELETE FROM ".TBL_ACTIVE_USERS." WHERE timestamp < $timeout";
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }

   /* removeInactiveGuests */
   function removeInactiveGuests(){
      if(!TRACK_VISITORS) return;
      $timeout = time()-GUEST_TIMEOUT*60;
      $q = "DELETE FROM ".TBL_ACTIVE_GUESTS." WHERE timestamp < $timeout";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   /* get data to array list */
   function getQueryData($q){
 // echo $q;
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_num_rows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_array($result,MYSQL_ASSOC);
      return $dbarray;
   }
    /* get multi row data to array list */
   function getQueryMultiData($q){
  
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_num_rows($result) < 1)){
         return NULL;
      }
      /* Return result array */
	    $dbarray=array();
	for($i=0;$i<mysql_num_rows($result);$i++){
      $dbarray[$i] = mysql_fetch_array($result,MYSQL_ASSOC);
	  }
      return $dbarray;
   }
   
   
   /**
    * query - Performs the given query on the database and
    * returns the result, which may be false, true or a
    * resource identifier.
    */
	
   function query($query){
      return mysql_query($query, $this->connection);
   }
};

/* Create database connection */
$database = new MySQLDB;

?>
