<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Автомобили");
?>

<?$APPLICATION->IncludeComponent("ylab:auto.list", "", array(
    'COMMERCIAL' => isset($_GET['commercial']) && $_GET['commercial'] == 'on',
    'COLOR' => $_GET['color'] ?? 0,
    'AGE' => isset($_GET['age']) && $_GET['age'] == 'on'
));?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>