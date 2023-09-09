<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="card w-50 mx-auto my-3">
		<div class="card-body">
			<h5 class="card-title"><?=$arItem["NAME"]?></h5>
			<p class="card-text">Доступ открыт с <?=$arItem["ACTIVE_FROM"]?> по <?=$arItem["ACTIVE_TO"]?></p>
		</div>
	</div>
<?endforeach;?>
</div>