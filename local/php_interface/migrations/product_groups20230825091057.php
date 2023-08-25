<?php

namespace Sprint\Migration;

use CIBlockSection;


class product_groups20230825091057 extends Version
{
  protected $description = "Разделы инфоблока Продукты";

  protected $moduleVersion = "4.2.4";

  /**
   * @throws Exceptions\HelperException
   * @return bool|void
   */
  public function up()
  {
    $helper = $this->getHelperManager();

    $iblockId = $helper->Iblock()->getIblockIdIfExists(
      'products',
      'products'
    );

    $helper->Iblock()->addSectionsFromTree(
      $iblockId,
      array(
        0 =>
        array(
          'NAME' => 'Овощи и фрукты',
          'CODE' => '',
          'SORT' => '500',
          'ACTIVE' => 'Y',
          'XML_ID' => NULL,
          'DESCRIPTION' => '',
          'DESCRIPTION_TYPE' => 'text',
        ),
        1 =>
        array(
          'NAME' => 'Соки и нектары',
          'CODE' => '',
          'SORT' => '500',
          'ACTIVE' => 'Y',
          'XML_ID' => NULL,
          'DESCRIPTION' => '',
          'DESCRIPTION_TYPE' => 'text',
        ),
        2 =>
        array(
          'NAME' => 'Конфеты',
          'CODE' => '',
          'SORT' => '500',
          'ACTIVE' => 'Y',
          'XML_ID' => NULL,
          'DESCRIPTION' => '',
          'DESCRIPTION_TYPE' => 'text',
        ),
      )
    );
  }

  /**
   * @throws Exceptions\HelperException
   * @return bool|void
   */
  public function down()
  {
    $helper = $this->getHelperManager();
    $iblockId = $helper->Iblock()->getIblockIdIfExists('products');
    
    /** @noinspection PhpDynamicAsStaticMethodCallInspection */
    $rs_Section = CIBlockSection::GetList([], ['IBLOCK_ID' => $iblockId]);
    while ($ar_Section = $rs_Section->Fetch()) {
      /*CIBlockSection::Delete($ar_Section['ID']);*/
      $helper->Iblock()->deleteSection($ar_Section['ID']);
    }
  }
}