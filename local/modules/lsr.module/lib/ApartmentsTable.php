<?php

namespace Lsr\Module;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;

class ApartmentsTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'b_lsr_apartments';
    }

    public static function getMap(): array
    {
        return [
            new Fields\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),

            new Fields\IntegerField('HOUSE_ID', [
                'required' => true,
            ]),

            new Fields\StringField('NUMBER', [
                'required' => true,
            ]),

            new Fields\EnumField('STATUS', [
                'values' => ['free', 'reserved', 'sold'],
                'default_value' => 'free',
            ]),

            new Fields\DatetimeField('CREATED_AT', [
                'default_value' => function () {
                    return new \Bitrix\Main\Type\DateTime();
                }
            ]),

            new Fields\Relations\Reference(
                'HOUSE',
                HousesTable::class,
                ['=this.HOUSE_ID' => 'ref.ID']
            ),
        ];
    }
}
