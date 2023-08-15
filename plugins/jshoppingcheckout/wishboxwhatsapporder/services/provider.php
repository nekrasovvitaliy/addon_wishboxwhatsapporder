<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Jshoppingorder.Wishboxwhatsapporder
 *
 * @copyright Copyright (c) 2013-2023 Wishbox
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Jshoppingcheckout\Wishboxwhatsapporder\Extension\Wishboxwhatsapporder;

return new class implements ServiceProviderInterface {
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   4.2.0
	 */
	public function register(Container $container)
	{
		$container->set(
			PluginInterface::class,
			function (Container $container) {
				$plugin = new Wishboxwhatsapporder(
					$container->get(DispatcherInterface::class),
					(array) PluginHelper::getPlugin('jshoppingcheckout', 'wishboxwhatsapporder')
				);
				$plugin->setApplication(Factory::getApplication());

				return $plugin;
			}
		);
	}
};
