<?php

namespace Lsr\Module\Controller;

use Bitrix\Main\Engine\ActionFilter\Attribute\Rule\Prefilters;
use Bitrix\Main\Engine\Controller;
use Lsr\Module\Service\ApartmentService;

class ApartmentController extends Controller
{
    #[Prefilters([])]
    public function listAction(ApartmentService $apartmentService, $houseId): array
    {
        return $apartmentService->getApartmentsByHouse($houseId);
    }
}
