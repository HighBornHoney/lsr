<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class lsr_module extends CModule
{
    public $MODULE_ID = 'lsr.module';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    public function __construct()
    {
        include __DIR__ . '/version.php';

        if (isset($arModuleVersion['VERSION'], $arModuleVersion['VERSION_DATE'])) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = 'Модуль ЛСР';
        $this->MODULE_DESCRIPTION = 'Модуль устанавливает компонент формы создания заявки на объект недвижимости.';
    }

    public function DoInstall(): void
    {
        global $USER;

        if (!$USER->IsAdmin()) {
            return;
        }

        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallDB();
        $this->InstallFiles();
    }

    public function DoUninstall(): void
    {
        global $USER;

        if (!$USER->IsAdmin()) {
            return;
        }

        $this->UnInstallFiles();
        $this->UnInstallDB();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallDB(): void
    {
        global $DB;

        $DB->RunSQLBatch(
            __DIR__ . '/db/install.sql'
        );
    }

    public function UnInstallDB(): void
    {
        global $DB;

        $DB->RunSQLBatch(
            __DIR__ . '/db/uninstall.sql'
        );
    }

    public function InstallFiles(): void
    {
        CopyDirFiles(
            $_SERVER['DOCUMENT_ROOT'] . '/local/modules/lsr.module/install/components',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components',
            true,
            true
        );

        CopyDirFiles(
            $_SERVER['DOCUMENT_ROOT'] . '/local/modules/lsr.module/admin',
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin',
            true,
            true
        );
    }

    public function UnInstallFiles(): bool
    {
        DeleteDirFilesEx('/local/components/lsr');

        DeleteDirFiles(
            $_SERVER['DOCUMENT_ROOT'] . '/local/modules/lsr.module/admin',
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin'
        );
        return true;
    }
}
