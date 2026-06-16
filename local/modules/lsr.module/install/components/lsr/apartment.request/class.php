<?php

use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loader::includeModule('lsr.module');

class LsrAparmentRequestComponent extends CBitrixComponent
{
    public function executeComponent(): void
    {
        $this->includeComponentTemplate();
    }
}
