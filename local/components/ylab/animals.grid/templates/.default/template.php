<?
use CAjax;
use Bitrix\UI\Buttons\Button;
use Bitrix\UI\Buttons\Color;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?
$listId = $arResult['LIST_ID'];
$gridId = $arResult['GRID_ID']; 

$columns = $arResult['COLUMNS']; 
$rows = $arResult['ROWS'];

$nav = $arResult['NAV_OBJECT'];
$count = $arResult['TOTAL_ROWS_COUNT']; 
$actions = $arResult['ACTION_PANEL']; 

$kindItems = $arResult['KIND_ITEMS'];
$genderItems = $arResult['GENDER_ITEMS'];

$button = new Button(['color' => Color::PRIMARY, 'text' => 'Добавить', 'classList' => ['add-button']]);
$buttonRender = $button->render();
?>

<div class="container">
	<h1 class="my-3">
		<? $APPLICATION->ShowTitle(false); ?>
	</h1>

    <div>
        <?= $buttonRender ?>
    </div>

    <form id='new-animal'>
        <div class="ui-form my-3 d-none" id="add-form">
            <div class="ui-form-row-inline">
                <input type="hidden" name="id" value="0">
                <div class="ui-form-row">
                    <div class="ui-form-label">
                        <div class="ui-ctl-label-text">Кличка</div>
                    </div>
                    <div class="ui-form-content">
                        <div class="ui-ctl ui-ctl-textbox ui-ctl-w100">
                            <input type="text" class="ui-ctl-element" name="name">
                        </div>
                    </div>
                </div>
                <div class="ui-form-row">
                    <div class="ui-form-label">
                        <div class="ui-ctl-label-text">Вид животного</div>
                    </div>
                    <div class="ui-form-content">
                        <div class="ui-ctl ui-ctl-after-icon ui-ctl-dropdown ui-ctl-w100">
                            <div class="ui-ctl-after ui-ctl-icon-angle"></div>
                            <select class="ui-ctl-element" name="kind">
                                <? foreach ($kindItems as $key => $value): ?>
                                    <option value="<?= $key ?>">
                                        <?= $value ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ui-form-row">
                    <div class="ui-form-label">
                        <div class="ui-ctl-label-text">Пол животного</div>
                    </div>
                    <div class="ui-form-content">
                        <div class="ui-ctl ui-ctl-after-icon ui-ctl-dropdown ui-ctl-w100">
                            <div class="ui-ctl-after ui-ctl-icon-angle"></div>
                            <select class="ui-ctl-element" name="gender">
                                <? foreach ($genderItems as $key => $value): ?>
                                    <option value="<?= $key ?>">
                                        <?= $value ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ui-form-row">
                    <div class="ui-form-label">
                        <div class="ui-ctl-label-text">Дата рождения</div>
                    </div>
                    <div class="ui-form-content">
                        <div class="ui-ctl ui-ctl-textbox ui-ctl-w100">
                            <input type="date" class="ui-ctl-element" name="date">
                        </div>
                    </div>
                </div>
                <div class="ui-form-row">
                    <div class="ui-form-label">
                        <div class="ui-ctl-label-text">Происхождение</div>
                    </div>
                    <div class="ui-form-content">
                        <div class="ui-ctl ui-ctl-textbox ui-ctl-w100">
                            <input type="text" class="ui-ctl-element" name="origin">
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-form-row-inline">
                <div class="ui-form-row">
                    <div class="ui-form-content">
                        <div class="ui-ctl ui-ctl-textbox ui-ctl-w100">
                            <button class="ui-btn ui-btn-primary" id="save-button"
                                data-action="saveAnimal" type="button">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <? $APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
        'FILTER_ID' => $gridId,
        'GRID_ID' => $gridId,
        'FILTER' => [
            ['id' => 'UF_KIND', 'name' => 'Вид животного', 'type' => 'list', 'items' => $kindItems, 'default' => true],
            ['id' => 'UF_ORIGIN', 'name' => 'Происхождение', 'type' => 'string', 'default' => true]
        ],
        'ENABLE_LABEL' => true
    ]); ?>

    <?$APPLICATION->includeComponent(
        "bitrix:main.ui.grid",
        "",
        [
            'AJAX_ID' => CAjax::getComponentId('bitrix:main.ui.grid', '.default', $listId),
            'AJAX_MODE' => 'Y',
            'AJAX_OPTION_HISTORY' => 'N',
            'AJAX_OPTION_JUMP' => 'N',
            'AJAX_OPTION_SHADOW' => 'N',
            'AJAX_OPTION_STYLE' => 'N',
            'AJAX_OPTION_ADDITIONAL' => $listId,
            'GRID_ID' => $gridId,
            'ACTION_PANEL' => $actions,
            'COLUMNS' => $columns,
            'ROWS' => $rows,
            'NAV_OBJECT' => $nav,
            'TOTAL_ROWS_COUNT' => $count,
            'SHOW_CHECK_ALL_CHECKBOXES' => false,
            'SHOW_ROW_CHECKBOXES' => false
        ]
    );?>
</div>