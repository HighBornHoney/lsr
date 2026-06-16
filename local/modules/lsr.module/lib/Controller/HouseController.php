<?php

namespace Lsr\Module\Controller;

use Bitrix\Main\Engine\ActionFilter\Attribute\Rule\Prefilters;
use Bitrix\Main\Engine\Controller;
use Lsr\Module\Service\HouseService;

class HouseController extends Controller
{
    #[Prefilters([])]
    public function listAction(HouseService $houseService): array
    {
        return $houseService->getHouses();
    }
}
