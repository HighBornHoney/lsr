<?php

namespace Lsr\Module;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;

class RequestsTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'b_lsr_requests';
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

            new Fields\StringField('EMAIL', [
                'required' => true,
            ]),

            new Fields\StringField('PHONE', [
                'required' => true,
            ]),

            new Fields\IntegerField('APARTMENT_ID', [
                'required' => true,
            ]),

            new Fields\DatetimeField('CREATED_AT', [
                'default_value' => function () {
                    return new \Bitrix\Main\Type\DateTime();
                }
            ]),

            new Fields\Relations\Reference(
                'APARTMENT',
                ApartmentsTable::class,
                ['=this.APARTMENT_ID' => 'ref.ID']
            ),
        ];
    }
}
