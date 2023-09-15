<?php

namespace Sprint\Migration;


class animals20230915195832 extends Version
{
  protected $description = "Миграция для highload блока животных";

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
        'NAME' => 'Animals',
        'TABLE_NAME' => 'ylab_hl_animals',
        'LANG' =>
          array(
            'ru' =>
              array(
                'NAME' => 'Животные',
              ),
            'en' =>
              array(
                'NAME' => 'Animals',
              ),
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
          'ru' => 'Кличка',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Name',
          'ru' => 'Кличка',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Name',
          'ru' => 'Кличка',
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
      'FIELD_NAME' => 'UF_KIND',
      'USER_TYPE_ID' => 'hlblock',
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
          'DISPLAY' => 'LIST',
          'LIST_HEIGHT' => 1,
          'HLBLOCK_ID' => 'Kinds',
          'HLFIELD_ID' => 'UF_NAME',
          'DEFAULT_VALUE' => 0,
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Kind',
          'ru' => 'Вид',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Kind',
          'ru' => 'Вид',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Kind',
          'ru' => 'Вид',
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
      'FIELD_NAME' => 'UF_GENDER',
      'USER_TYPE_ID' => 'hlblock',
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
          'DISPLAY' => 'LIST',
          'LIST_HEIGHT' => 1,
          'HLBLOCK_ID' => 'Genders',
          'HLFIELD_ID' => 'UF_NAME',
          'DEFAULT_VALUE' => 0,
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Gender',
          'ru' => 'Пол',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Gender',
          'ru' => 'Пол',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Gender',
          'ru' => 'Пол',
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
      'FIELD_NAME' => 'UF_DATE',
      'USER_TYPE_ID' => 'date',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'N',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'DEFAULT_VALUE' =>
            array(
              'TYPE' => 'NONE',
              'VALUE' => '',
            ),
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Date of birth',
          'ru' => 'Дата рождения',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Date of birth',
          'ru' => 'Дата рождения',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Date of birth',
          'ru' => 'Дата рождения',
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
      'FIELD_NAME' => 'UF_ORIGIN',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'N',
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
          'en' => 'Origin',
          'ru' => 'Происхождение',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Origin',
          'ru' => 'Происхождение',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Origin',
          'ru' => 'Происхождение',
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
    $helper->Hlblock()->deleteHlblockIfExists('Animals');
  }
}