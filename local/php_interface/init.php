<? 
include_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/functions.php'); 
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "codeHandler");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "codeHandler");
?>