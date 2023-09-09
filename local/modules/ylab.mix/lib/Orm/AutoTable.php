<?
namespace Ylab\Mix\Orm;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);

class AutoTable extends DataManager
{
    public static function getTableName()
    {
        return 'auto';
    }

    public static function getMap()
    {
        return array(
            new Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Fields\StringField('MARK', array(
                'required' => true,
                'title' => Loc::getMessage('AUTO_FIELD_MARK')
            )),
            new Fields\StringField('MODEL', array(
                'required' => true,
                'title' => Loc::getMessage('AUTO_FIELD_MODEL')
            )),
            new Fields\DateField('PRODUCTION_DATE', array(
                'required' => true,
                'title' => Loc::getMessage('AUTO_FIELD_PRODUCTION')
            )),
            new Fields\IntegerField('CAPACITY', array(
                'required' => true,
                'title' => Loc::getMessage('AUTO_FIELD_CAPACITY')
            )),
            new Fields\BooleanField('COMMERCIAL', array(
                'required' => true,
                'values' => array('N', 'Y'),
                'title' => Loc::getMessage('AUTO_FIELD_COMMERCIAL')
            )),
            new Fields\IntegerField('COLOR_ID', array(
                'title' => Loc::getMessage('AUTO_FIELD_COLOR')
            )),
			new Fields\Relations\Reference('COLOR', ColorTable::class, Join::on('this.COLOR_ID', 'ref.ID'))
        );
    }

}