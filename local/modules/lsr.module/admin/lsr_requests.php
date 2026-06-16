<?php

use Bitrix\Main\Loader;
use Lsr\Module\RequestsTable;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin.php';

global $APPLICATION;

$APPLICATION->SetTitle('Заявки на недвижимость');

Loader::includeModule('lsr.module');

$res = RequestsTable::getList([
    'select' => [
        'ID',
        'NAME',
        'EMAIL',
        'PHONE',
        'APARTMENT_ID',
        'CREATED_AT',
    ],
    'order' => ['ID' => 'DESC'],
]);

$data = [];
while ($row = $res->fetch()) {
    $data[] = $row;
}

$tableId = 'tbl_lsr_requests';
$lAdmin = new CAdminList($tableId);

$rsData = new CDBResult();
$rsData->InitFromArray($data);

$rsData = new CAdminResult($rsData, $tableId);

$lAdmin->AddHeaders([
    ['id' => 'ID', 'content' => 'ID', 'default' => true],
    ['id' => 'NAME', 'content' => 'Name', 'default' => true],
    ['id' => 'EMAIL', 'content' => 'Email', 'default' => true],
    ['id' => 'PHONE', 'content' => 'Phone', 'default' => true],
    ['id' => 'APARTMENT_ID', 'content' => 'Apartment ID', 'default' => true],
    ['id' => 'CREATED_AT', 'content' => 'Created', 'default' => true],
]);

while ($ar = $rsData->Fetch()) {
    $row = $lAdmin->AddRow($ar['ID'], $ar);

    $row->AddViewField('ID', $ar['ID']);
    $row->AddViewField('NAME', htmlspecialcharsbx($ar['NAME']));
    $row->AddViewField('EMAIL', htmlspecialcharsbx($ar['EMAIL']));
    $row->AddViewField('PHONE', htmlspecialcharsbx($ar['PHONE']));
    $row->AddViewField('APARTMENT_ID', $ar['APARTMENT_ID']);
    $row->AddViewField('CREATED_AT', $ar['CREATED_AT']);
}

$lAdmin->CheckListMode();

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';

$lAdmin->DisplayList();

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';
