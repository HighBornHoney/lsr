<?php

namespace Lsr\Module\Service;

use Lsr\Module\ApartmentsTable;

class ApartmentService
{
    public function getApartmentsByHouse(int $houseId): array
    {
        return ApartmentsTable::getList([
            'select' => ['*'],
            'filter' => ['=HOUSE_ID' => $houseId],
            'order' => ['ID' => 'ASC'],
        ])
            ->fetchAll();
    }
}
