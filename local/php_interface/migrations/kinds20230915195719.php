<?php

namespace Sprint\Migration;


class kinds20230915195719 extends Version
{
  protected $description = "Миграция для highload блока видов животных";

  protected $moduleVersion = "4.2.4";

  /**
   * @throws Exceptions\HelperException
   * @return bool|void
   */
  public function up()
  {
    $helper = $this->getHelperManager();
    $hlblockId = $helper->Hlblock()->saveHlblock(
      array(
        'NAME' => 'Kinds',
        'TABLE_NAME' => 'ylab_hl_kinds',
        'LANG' =>
          array(
            'ru' =>
              array(
                'NAME' => 'Виды',
              ),
            'en' =>
              array(
                'NAME' => 'Kinds',
              ),
          ),
      )
    );
    $helper->Hlblock()->saveField($hlblockId, array(
      'FIELD_NAME' => 'UF_CODE',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'Y',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'SIZE' => 20,
          'ROWS' => 1,
          'REGEXP' => '',
          'MIN_LENGTH' => 0,
          'MAX_LENGTH' => 0,
          'DEFAULT_VALUE' => '',
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Code',
          'ru' => 'Код',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Code',
          'ru' => 'Код',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Code',
          'ru' => 'Код',
        ),
      'ERROR_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
      'HELP_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
    )
    );
    $helper->Hlblock()->saveField($hlblockId, array(
      'FIELD_NAME' => 'UF_NAME',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'Y',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'SIZE' => 20,
          'ROWS' => 1,
          'REGEXP' => '',
          'MIN_LENGTH' => 0,
          'MAX_LENGTH' => 0,
          'DEFAULT_VALUE' => '',
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Name',
          'ru' => 'Название',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Name',
          'ru' => 'Название',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Name',
          'ru' => 'Название',
        ),
      'ERROR_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
      'HELP_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
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
    $helper->Hlblock()->deleteHlblockIfExists('Kinds');
  }
}