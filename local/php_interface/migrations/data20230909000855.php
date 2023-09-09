<?php

namespace Sprint\Migration;

use Bitrix\Main\Application;
use Bitrix\Main\Type\Date;
use Ylab\Mix\Orm\ColorTable;
use Ylab\Mix\Orm\AutoTable;
use Ylab\Mix\Helper\Color;
use Exception;

class data20230909000855 extends Version
{
    protected $description = " Данные для таблиц автомобилей и цветов";

    protected $moduleVersion = "4.2.4";

    /**
     * @return bool|void
     */
    public function up()
    {
        $colorData = [
            ['CODE' => 'white', 'NAME' => 'Белый'],
            ['CODE' => 'black', 'NAME' => 'Черный'],
            ['CODE' => 'red', 'NAME' => 'Красный'],
            ['CODE' => 'blue', 'NAME' => 'Синий']
        ];
        foreach ($colorData as $item) {
            $obj = ColorTable::getEntity()->createObject();
            $obj['CODE'] = $item['CODE'];
            $obj['NAME'] = $item['NAME'];
            $result = $obj->save();
            if (!$result->isSuccess()) {
                throw new Exception(implode(', ', $result->getErrorMessages()));
            }
        }

        $autoData = [
            [
                'MARK' => 'ВАЗ',
                'MODEL' => 'Лада Калина',
                'PRODUCTION_DATE' => (new Date())->setDate(2020, 1, 31),
                'CAPACITY' => 430,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('white')
            ],
            [
                'MARK' => 'Audi',
                'MODEL' => 'A8',
                'PRODUCTION_DATE' => (new Date())->setDate(2018, 1, 31),
                'CAPACITY' => 520,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('red')
            ],
            [
                'MARK' => 'Ford',
                'MODEL' => 'Transit',
                'PRODUCTION_DATE' => (new Date())->setDate(2019, 7, 25),
                'CAPACITY' => 1200,
                'COMMERCIAL' => 'Y',
                'COLOR_ID' => Color::getColorIdByColorCode('blue')
            ],
            [
                'MARK' => 'Kia',
                'MODEL' => 'Rio',
                'PRODUCTION_DATE' => (new Date())->setDate(2021, 1, 15),
                'CAPACITY' => 550,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('black')
            ],
            [
                'MARK' => 'Mazda',
                'MODEL' => 'CX-5',
                'PRODUCTION_DATE' => (new Date())->setDate(2020, 6, 15),
                'CAPACITY' => 580,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('white')
            ],
            [
                'MARK' => 'Skoda',
                'MODEL' => 'Octavia',
                'PRODUCTION_DATE' => (new Date())->setDate(2022, 3, 20),
                'CAPACITY' => 550,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('red')
            ],
            [
                'MARK' => 'Volkswagen',
                'MODEL' => 'Polo',
                'PRODUCTION_DATE' => (new Date())->setDate(2021, 6, 20),
                'CAPACITY' => 530,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('white')
            ],
            [
                'MARK' => 'УАЗ',
                'MODEL' => 'Профи',
                'PRODUCTION_DATE' => (new Date())->setDate(2023, 1, 31),
                'CAPACITY' => 1500,
                'COMMERCIAL' => 'Y',
                'COLOR_ID' => Color::getColorIdByColorCode('blue')
            ],
            [
                'MARK' => 'Jeep',
                'MODEL' => 'Compass',
                'PRODUCTION_DATE' => (new Date())->setDate(2022, 3, 31),
                'CAPACITY' => 650,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('black')
            ],
            [
                'MARK' => 'Fiat',
                'MODEL' => '500',
                'PRODUCTION_DATE' => (new Date())->setDate(2021, 5, 5),
                'CAPACITY' => 380,
                'COMMERCIAL' => 'N',
                'COLOR_ID' => Color::getColorIdByColorCode('white')
            ]
        ];
        foreach ($autoData as $item) {
            $obj = AutoTable::getEntity()->createObject();
            $obj['MARK'] = $item['MARK'];
            $obj['MODEL'] = $item['MODEL'];
            $obj['PRODUCTION_DATE'] = $item['PRODUCTION_DATE'];
            $obj['CAPACITY'] = $item['CAPACITY'];
            $obj['COMMERCIAL'] = $item['COMMERCIAL'];
            $obj['COLOR_ID'] = $item['COLOR_ID'];

            $result = $obj->save();
            if (!$result->isSuccess()) {
                throw new Exception(implode(', ', $result->getErrorMessages()));
            }
        }
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $conn = Application::getConnection();
        if ($conn->isTableExists(AutoTable::getTableName())) {
            $conn->truncateTable(AutoTable::getTableName());
        }
        $conn = Application::getConnection();
        if ($conn->isTableExists(ColorTable::getTableName())) {
            $conn->truncateTable(ColorTable::getTableName());
        }
    }
}