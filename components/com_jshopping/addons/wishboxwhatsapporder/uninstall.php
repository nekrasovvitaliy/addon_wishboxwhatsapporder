<?php
/**
 * @copyright  (C) 2023 WishBox
 * @license    GNU General Public License version 2 or later
 */
use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Table\AddonTable;

defined('_JEXEC') or die;

$addonTable = JSFactory::getTable('addon');
$addonTable->loadAlias('wishboxwhatsapporder');
$addonTable->delete();
$addonTable->unInstallJoomlaExtension(
	'plugin',
	'wishboxwhatsapporder',
	'jshoppingcheckout',
);
$addonTable->deleteFolders(
	[
		'components/com_jshopping/addons/wishboxwhatsapporder',
		'plugins/jshoppingadmin/wishboxwhatsapporder',
		'plugins/jshoppingcheckout/wishboxwhatsapporder'
	]
);
$addonTable->deleteFiles(
	[

	]
);
