<?php

namespace Lsr\Module\Service;

use Bitrix\Main\Application;
use Bitrix\Main\DB\DuplicateEntryException;
use Bitrix\Main\PhoneNumber\Parser;
use Bitrix\Main\PhoneNumber\Format;
use DomainException;
use Lsr\Module\RequestsTable;

class RequestService
{
    public function createRequest(
        string $name,
        string $email,
        string $phone,
        int $apartmentId
    ): int {
        $connection = Application::getConnection();
        $connection->startTransaction();

        try {
            $phone = $this->normalizePhone($phone);
            $this->validateEmail($email);

            $this->reserveApartment($connection, $apartmentId);

            $requestId = $this->insertRequest(
                $name,
                $email,
                $phone,
                $apartmentId
            );

            $connection->commitTransaction();

            return $requestId;
        } catch (\Throwable $e) {
            $connection->rollbackTransaction();
            throw $e;
        }
    }

    private function normalizePhone(string $phone): string
    {
        $phoneNumber = Parser::getInstance()->parse($phone);

        if (!$phoneNumber->isValid()) {
            throw new DomainException('Некорректный номер телефона');
        }

        return $phoneNumber->format(Format::E164);
    }

    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException('Некорректный email');
        }
    }

    private function reserveApartment($connection, int $apartmentId): void
    {
        $apartmentId = (int)$apartmentId;

        $connection->queryExecute(
            "
            UPDATE b_lsr_apartments
            SET STATUS = 'reserved'
            WHERE ID = {$apartmentId}
              AND STATUS = 'free'
        "
        );

        if ($connection->getAffectedRowsCount() === 0) {
            throw new DomainException('Выберите другой объект недвижимости');
        }
    }

    private function insertRequest(
        string $name,
        string $email,
        string $phone,
        int $apartmentId
    ): int {
        try {
            $result = RequestsTable::add([
                'NAME' => $name,
                'EMAIL' => $email,
                'PHONE' => $phone,
                'APARTMENT_ID' => $apartmentId,
            ]);
        } catch (DuplicateEntryException $e) {
            $message = $e->getMessage();

            if (str_contains($message, 'UX_PHONE')) {
                throw new DomainException('Для этого номера телефона уже была заявка');
            } elseif (str_contains($message, 'UX_EMAIL')) {
                throw new DomainException('Для этого email уже была заявка');
            } else {
                throw new DomainException('Дубликат записи');
            }
        }

        if (!$result->isSuccess()) {
            throw new DomainException(
                implode(', ', $result->getErrorMessages())
            );
        }

        return (int)$result->getId();
    }
}
