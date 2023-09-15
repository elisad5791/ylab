<?php
use Bitrix\Highloadblock\HighloadBlockTable;
use CBitrixComponent;
use Bitrix\Main\Loader;
use Bitrix\Main\Grid\Options;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\UI\Filter\Options as FilterOptions;
use CDatabase;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

class AnimalsGridComponent extends CBitrixComponent implements Controllerable, Errorable
{
    static protected $componentCounter = 0;
    protected $errorCollection;

    public function configureActions()
    {
        return [];
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();
    }

    public function deleteAnimalAction($id)
    {
        Loader::requireModule('highloadblock');
        $animalClass = HighloadBlockTable::compileEntity('Animals')->getDataClass();
        $animalClass::delete($id);
        return $id;
    }

    public function saveAnimalAction($name, $kind, $gender, $origin, $date, $id)
    {
        Loader::requireModule('highloadblock');
        $animalClass = HighloadBlockTable::compileEntity('Animals')->getDataClass();
        $date = ConvertTimeStamp(strtotime($date), 'SHORT');
        if ($id == 0) {
            $animalClass::add([
                'UF_NAME' => $name,
                'UF_KIND' => $kind,
                'UF_GENDER' => $gender,
                'UF_ORIGIN' => $origin,
                'UF_DATE' => $date
            ]);
        } else {
            $animalClass::update($id, [
                'UF_NAME' => $name,
                'UF_KIND' => $kind,
                'UF_GENDER' => $gender,
                'UF_ORIGIN' => $origin,
                'UF_DATE' => $date
            ]);
        }
        return true;
    }

    public function editAnimalAction($id)
    {
        Loader::requireModule('highloadblock');
        $animalClass = HighloadBlockTable::compileEntity('Animals')->getDataClass();
        $result = $animalClass::query()->addFilter('ID', $id)->setSelect(['*'])->fetch();
        $result['UF_DATE'] = CDatabase::FormatDate($result['UF_DATE'], "DD.MM.YYYY HH:MI:SS", "YYYY-MM-DD");
        return $result;
    }

    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code)
    {
        return $this->errorCollection->getErrorByCode($code);
    }
    
	public function executeComponent()
	{
        $arResult = &$this->arResult;
        self::$componentCounter++;
        Loader::requireModule('highloadblock');

        $listId = 'animals_grid_list_' . self::$componentCounter;
        $gridId = 'animals_grid_' . self::$componentCounter;
        $navId = 'animals_grid_nav_' .  self::$componentCounter;

        $nav = new PageNavigation($navId);
        $nav->allowAllRecords(true)->setPageSize(5)->initFromUri();
        
        $options = new Options($gridId);
        $sortData = $options->getSorting(['sort' => ['ID' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);
        $fieldSort = array_keys($sortData['sort'])[0];
        $directionSort = array_values($sortData['sort'])[0];

        $arSelect = [
            '*', 
            'UF_KIND_NAME' => 'UF_KIND_REF.UF_NAME',
            'UF_GENDER_NAME' => 'UF_GENDER_REF.UF_NAME'
        ];

        $filterOption = new FilterOptions($gridId);
        $filterData = $filterOption->getFilter([]);
        $filterFields = ['UF_ORIGIN', 'UF_KIND'];
        $arFilter = [];
        foreach ($filterData as $k => $v) {
            if (in_array($k, $filterFields)) {
                $arFilter[$k] = $v;            
            }
        }

        $animalClass = HighloadBlockTable::compileEntity('Animals')->getDataClass();
        $query = $animalClass::query()->setSelect($arSelect)->setFilter($arFilter)->countTotal(true);
        $query->addOrder($fieldSort, $directionSort);
        if ($nav) {
            $query->setOffset($nav->getOffset());
            $query->setLimit($nav->getLimit());
        }
        $result = $query->exec();
        $totalCount = $result->getCount();
        $nav->setRecordCount($totalCount);
        
        $columns = [
            ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true],
            ['id' => 'UF_NAME', 'name' => 'Кличка', 'sort' => 'UF_NAME', 'default' => true],
            ['id' => 'UF_KIND_NAME', 'name' => 'Вид', 'sort' => 'UF_KIND_NAME', 'default' => true],
            ['id' => 'UF_GENDER_NAME', 'name' => 'Пол', 'sort' => 'UF_GENDER_NAME', 'default' => true],
            ['id' => 'UF_DATE', 'name' => 'Дата рождения', 'sort' => 'UF_DATE', 'default' => true],
            ['id' => 'UF_ORIGIN', 'name' => 'Происхождение', 'sort' => 'UF_ORIGIN', 'default' => true]
        ];

        $rows = [];
        while ($item = $result->fetch()) {
            $row = [
                'data' => $item,
                'actions' => [
                    [
                        'text'    => 'Удалить',
                        'onclick' => 'deleteAnimal(' .  $item['ID'] .')'
                    ],
                    [
                        'text' => 'Редактировать',
                        'onclick' => 'editAnimal(' . $item['ID'] . ')'
                    ]
                ],
                'attrs' => []
            ];
            $rows[] = $row;
        }

        $kindClass = HighloadBlockTable::compileEntity('Kinds')->getDataClass();
        $kindData = $kindClass::query()->setSelect(['ID', 'UF_NAME'])->fetchAll();
        $kindItems = array_column($kindData, 'UF_NAME', 'ID');

        $genderClass = HighloadBlockTable::compileEntity('Genders')->getDataClass();
        $genderData = $genderClass::query()->setSelect(['ID', 'UF_NAME'])->fetchAll();
        $genderItems = array_column($genderData, 'UF_NAME', 'ID');

        $arResult = [
            'LIST_ID' => $listId, 
            'GRID_ID' => $gridId,
            'NAV_ID' => $navId,
            'COLUMNS' => $columns,
            'ROWS' => $rows,
            'NAV_OBJECT' => $nav,
            'TOTAL_ROWS_COUNT' => $totalCount,
            'ACTION_PANEL' => null,
            'KIND_ITEMS' => $kindItems,
            'GENDER_ITEMS' => $genderItems
        ];

        $this->includeComponentTemplate();
	}
}