<?php

namespace Lsr\Module\Service;

use Lsr\Module\HousesTable;

class HouseService
{
    public function getHouses(): array
    {
        return HousesTable::getList()
            ->fetchAll();
    }
}
