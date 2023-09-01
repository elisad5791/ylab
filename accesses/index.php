<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доступы");
?>

<?$APPLICATION->IncludeComponent(
	"ylab:accesses.list", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_CODE" => "accesses",
		"ACTIVE_TYPE" => "A",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>