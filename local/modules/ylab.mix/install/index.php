<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class ylab_mix extends CModule
{
    public $MODULE_ID = 'ylab.mix';

    public function __construct()
	{
        $arModuleVersion = array();
		include(__DIR__."/version.php");

        $this->MODULE_NAME = Loc::getMessage("YLAB_ACCESSES_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("YLAB_ACCESSES_MODULE_DESC");
		$this->PARTNER_NAME = Loc::getMessage("YLAB_ACCESSES_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("YLAB_ACCESSES_PARTNER_URI");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }

    public function DoInstall()
	{
        try {
            $this->InstallFiles();
            $this->InstallEvents();
            $this->InstallDB();
            RegisterModule($this->MODULE_ID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function InstallFiles()
    {
        CopyDirFiles(__DIR__ . '/bitrix/components/', getenv('DOCUMENT_ROOT') . '/bitrix/components/', true, true);
    }

    public function InstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandlerCompatible('main', 'OnBeforeProlog', $this->MODULE_ID);
        $eventManager->registerEventHandlerCompatible('iblock', 'OnBeforeIBlockElementAdd', $this->MODULE_ID, 'Ylab\Mix\Access', 'codeHandler');
        $eventManager->registerEventHandlerCompatible('iblock', 'OnBeforeIBlockElementUpdate', $this->MODULE_ID, 'Ylab\Mix\Access', 'codeHandler');
    }

    public function DoUninstall()
	{
        try {
            $this->UnInstallFiles();
            $this->UnInstallEvents();
            $this->UnInstallDB();
            UnRegisterModule($this->MODULE_ID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function UnInstallFiles()
    {
        DeleteDirFilesEx('bitrix/components/ylab/accesses.list');
       
        $ylab = getenv('DOCUMENT_ROOT') . '/bitrix/components/ylab';
        $ylab_empty = count(glob($ylab . '/*')) ? false : true;
        if ($ylab_empty) {
            @rmdir($ylab);
        }
    }

    public function UnInstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
        $eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockElementAdd', $this->MODULE_ID, 'Ylab\Mix\Access', 'codeHandler');
        $eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockElementUpdate', $this->MODULE_ID, 'Ylab\Mix\Access', 'codeHandler');
    }
}