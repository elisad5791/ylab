<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Животные");
?>

<?$APPLICATION->includeComponent("ylab:animals.grid", "");?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>