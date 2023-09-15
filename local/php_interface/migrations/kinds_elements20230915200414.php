<?php

namespace Sprint\Migration;


class kinds_elements20230915200414 extends Version
{
    protected $description   = "Миграция для элементов highload блока видов животных";
    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $this->getExchangeManager()
             ->HlblockElementsImport()
             ->setExchangeResource('hlblock_elements.xml')
             ->setLimit(20)
             ->execute(function ($item) {
                 $this->getHelperManager()
                      ->Hlblock()
                      ->addElement(
                          $item['hlblock_id'],
                          $item['fields']
                      );
             });
    }

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function down()
    {
        $helper = $this->getHelperManager()->Hlblock();
        $elements = $helper->getElements('Kinds');
        foreach ($elements as $element) {
            $helper->deleteElement('Kinds', $element['ID']);
        } 
    }
}
