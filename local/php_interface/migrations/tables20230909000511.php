<?php

namespace Sprint\Migration;

use Bitrix\Main\Application;
use Ylab\Mix\Orm\ColorTable;
use Ylab\Mix\Orm\AutoTable;

class tables20230909000511 extends Version
{
    protected $description = "Таблицы автомобилей и цветов";

    protected $moduleVersion = "4.2.4";

    /**
     * @return bool|void
     */
    public function up()
    {
        $conn = Application::getConnection();
       if (!$conn->isTableExists(ColorTable::getTableName())) {
        ColorTable::getEntity()->createDbTable();
       }
       if (!$conn->isTableExists(AutoTable::getTableName())) {
        AutoTable::getEntity()->createDbTable();
       }
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $conn = Application::getConnection();
        if ($conn->isTableExists(AutoTable::getTableName())) {
            $conn->dropTable(AutoTable::getTableName());
        }
        if ($conn->isTableExists(ColorTable::getTableName())) {
            $conn->dropTable(ColorTable::getTableName());
        }
    }
}
