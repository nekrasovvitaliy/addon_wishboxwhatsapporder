<?php
use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Table\AddonTable;

defined('_JEXEC') or die;

/**
 * @var AddonTable $addonTable
 */
$addonTable = JSFactory::getTable('addon');
$addonTable->loadAlias('wishboxwhatsapporder');
$addonTable->delete();
$addonTable->deleteFolders(
    [
        'components/com_jshopping/addons/wishboxwhatsapporder',
        'components/com_jshopping/lang/addon_wishboxwhatsapporder',
        'plugins/jshoppingadmin/wishboxorderrepeat'
    ]
);
$addonTable->deleteFiles(
    [

    ]
);
