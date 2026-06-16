<?php

namespace Lsr\Module\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Error;
use DomainException;
use Lsr\Module\Service\RequestService;
use Throwable;

class RequestController extends Controller
{
    public function createAction(
        RequestService $requestService,
        string $name,
        string $email,
        string $phone,
        int $apartmentId
    ): ?string {
        try {
            $id = $requestService->createRequest(
                $name,
                $email,
                $phone,
                $apartmentId
            );

            return 'ок';
        } catch (DomainException $e) {
            $this->addError(new Error($e->getMessage()));
            return null;
        } catch (Throwable $e) {
            $this->addError(new Error('Ошибка сервера'));
            return null;
        }
    }
}
