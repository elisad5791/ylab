<?
use Bitrix\Main\Security\Random;

function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function clearAccesses()
{
    CModule::IncludeModule('iblock');

    $filter = ['CODE' => 'accesses'];
    $accessesId = CIBlock::GetList([], $filter)->Fetch()['ID'];

    $currentDate = ConvertTimeStamp(time(), 'FULL');
    $arFilter = [
        'IBLOCK_ID' => $accessesId,
        '<DATE_ACTIVE_TO' => $currentDate
    ];
    $res = CIBlockElement::GetList([], $arFilter);

    while ($arItem = $res->Fetch()) {
        CIBlockElement::Delete($arItem['ID']);
    } 
    
    return 'clearAccesses();';
}

function codeHandler(&$arFields) {
    CModule::IncludeModule('iblock');

    $filter = ['CODE' => 'accesses'];
    $accessesId = CIBlock::GetList([], $filter)->Fetch()['ID'];

    if($accessesId == $arFields['IBLOCK_ID'] && strlen($arFields["CODE"]) <= 0) 
    { 
        $code = Random::getString(10, true);

        $arFilter = ['IBLOCK_CODE' => 'accesses'];
        $arSelect = ['CODE'];
        $rsItems = CIBlockElement::GetList(
            [],
            $arFilter,
            false,
            false,
            $arSelect
        );
        $codes = [];
        while ($arItem = $rsItems->fetch()) {
            $codes[] = $arItem['CODE'];
        }
        
        if (in_array($code, $codes)) {
            $code = Random::getString(10, true);
        }

        $arFields["CODE"] =  $code;
    }

    return;
}
?>