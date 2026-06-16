<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Мебельная компания");

$APPLICATION->IncludeComponent(
    "lsr:apartment.request",
    "",
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
