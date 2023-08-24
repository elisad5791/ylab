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
	<?$arSection = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"])->GetNext();?>
	<div class="card w-50 mx-auto my-3">
		<div class="card-body">
			<h5 class="card-title"><?=$arItem["NAME"]?></h5>
			<h6 class="card-subtitle mb-2 text-body-secondary">Группа: <?=$arSection["NAME"]?></h6>
			<p class="card-text">
				<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
					<?=$arProperty["DISPLAY_VALUE"]?>
				<?endforeach;?>
			</p>
		</div>
	</div>
<?endforeach;?>
</div>
