<?php
/**
 * @copyright  (C) 2023 WishBox
 * @license    GNU General Public License version 2 or later
 */
use Joomla\CMS\Factory;
use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Table\AddonTable;
use Joomla\Database\DatabaseDriver;

defined('_JEXEC') or die;

$db = Factory::getContainer()->get(DatabaseDriver::class);
/** @var AddonTable $addonTable */
$addonTable = JSFactory::getTable('addon', 'jshop');
$addonTable->loadAlias('wishboxwhatsapporder');
$addonTable->name = 'Wishbox Whats app order';
$addonTable->version = '1.0.0';
$addonTable->uninstall = '/components/com_jshopping/addons/wishboxwhatsapporder/uninstall.php';
$addonTable->store();
$addonTable->installJoomlaExtension(
	[
		'name'		=> 'plg_jshoppingcheckout_wishboxwhatsapporder',
		'type'		=> 'plugin',
		'element'	=> 'wishboxwhatsapporder',
		'folder'	=> 'jshoppingcheckout',
		'client_id'	=> '0',
		'enabled'	=> 1
	],
	true
);
