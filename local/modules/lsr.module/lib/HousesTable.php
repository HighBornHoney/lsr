<?php

namespace Lsr\Module;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;

class HousesTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'b_lsr_houses';
    }

    public static function getMap(): array
    {
        return [
            new Fields\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),

            new Fields\StringField('NAME', [
                'required' => true,
            ]),

            new Fields\DatetimeField('CREATED_AT', [
                'default_value' => function () {
                    return new \Bitrix\Main\Type\DateTime();
                }
            ]),
        ];
    }
}
