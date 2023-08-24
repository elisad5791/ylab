<?
use \Bitrix\Main\Page\Asset;
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
		<?$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap_v4/bootstrap.min.css");?>	
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
	
						