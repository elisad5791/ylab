<?php

namespace Sprint\Migration;

use CIBlockElement;

class product_elements20230825090333 extends Version
{
    protected $description   = "Элементы инфоблока Продукты";
    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @return bool|void
     */
    public function up()
    {
        $this->getExchangeManager()
             ->IblockElementsImport()
             ->setExchangeResource('iblock_elements.xml')
             ->setLimit(20)
             ->execute(function ($item) {
                 $this->getHelperManager()
                      ->Iblock()
                      ->addElement(
                          $item['iblock_id'],
                          $item['fields'],
                          $item['properties']
                      );
             });
    }

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @return bool|void
     */
    public function down()
    {
        //Удаляем все элементы по 10 штук за раз

        $helper = $this->getHelperManager();
        $iblockId1 = $helper->Iblock()->getIblockIdIfExists('products');

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $dbRes = CIBlockElement::GetList([], ['IBLOCK_ID' => $iblockId1], false, ['nTopCount' => 10]);

        $bFound = 0;

        while ($aItem = $dbRes->Fetch()) {
            $helper->Iblock()->deleteElement($aItem['ID']);
            $this->out('deleted %d', $aItem['ID']);
            $bFound++;
        }

        if ($bFound) {
            $this->restart();
        }
    }
}
