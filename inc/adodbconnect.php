<?php

 require_once( $_SERVER["DOCUMENT_ROOT"]."adodb5/adodb.inc.php");
$DB = NewADOConnection('mysql');
$DB->Connect($db_host, $database_user, $database_pass, $db_name);

function GetRow1($sql){
global $DB;
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
try {

$arr = $DB->Execute($sql); 
$num=$arr->RecordCount();
} catch (exception $e) {    print_r($e);}
return array("data"=>$arr->fields,"numrow"=>$num);
}
function UpdateInsert($sql){
global $DB;
try {
$rs = $DB->Execute($sql);
} catch (exception $e) {    print_r($e);}
}
function GetRowAll($sql){
global $DB;
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$recordSet = $DB->Execute($sql); 
if (!$recordSet) 
        print $DB->ErrorMsg(); 
    else
return $recordSet ;
}
?>