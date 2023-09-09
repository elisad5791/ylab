<?
namespace Ylab\Mix\Orm;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ColorTable extends DataManager
{
    public static function getTableName()
    {
        return 'color';
    }

    public static function getMap()
    {
        return array(
            new Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Fields\StringField('CODE', array(
                'required' => true,
                'title' => Loc::getMessage('COLOR_FIELD_CODE')
            )),
            new Fields\StringField('NAME', array(
                'required' => true,
                'title' => Loc::getMessage('COLOR_FIELD_NAME')
            ))
        );
    }
}