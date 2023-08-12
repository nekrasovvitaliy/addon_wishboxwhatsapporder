<?php
/**
 * @package    Joomla.Plugins
 * @subpackage  Jshoppingorder.Wishboxorderrepeat
 * @author     Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @copyright  (C) 2023 WishBox
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Plugin\Jshoppingcheckout\Wishboxwhatsapporder\Extension;

use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Table\ConfigTable;
use Joomla\Component\Jshopping\Site\Table\VendorTable;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;
use Wishbox\JShoppingPlugin;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property ConfigTable $config
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
final class Wishboxwhatsapporder extends JShoppingPlugin implements SubscriberInterface
{
	/**
	 *
	 */
	protected string $addonAlias = 'wishboxwhatsapporder';

    /**
     * Returns an array of events this subscriber will listen to.
     *
     * @return string[]
     *
     * @since 4.1.0
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onBeforeDisplayCheckoutStep5View' => 'onBeforeDisplayCheckoutStep5View',
	        'onEndCheckoutStep5' => 'onEndCheckoutStep5'
        ];
    }

    /**
     * Affects constructor behavior. If true, language files will be loaded automatically.
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $autoloadLanguage = true;

    /**
     * Constructor.
     *
     * @param   DispatcherInterface  $dispatcher  The dispatcher
     * @param   array                $config      An optional associative array of configuration settings
     *
     * @since   4.2.0
     */
    public function __construct(DispatcherInterface $dispatcher, array $config)
    {
        parent::__construct($dispatcher, $config);
    }

    /**
     * @param   Event $event Event.
     *
     * @return void
     *
     * @since  1.0.0
     * @noinspection PhpUnused
     */
    public function onBeforeDisplayCheckoutStep5View(Event $event): void
    {
        $view = $event->getArgument(0);
		$html = $this->getRenderer('button')->render();
		$view->_tmp_ext_html_previewfinish_before_button .= $html;
        $event->setArgument(0, $view);
    }

	/**
	 * @param   Event $event Event.
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @noinspection PhpUnused
	 */
	public function onEndCheckoutStep5(Event $event): void
	{
		$order = $event->getArgument(0);
		/**
		 * @var VendorTable $vendorTable
		 */
		$vendorTable = JSFactory::getTable('vendor');
		$vendorTable->loadMain();
		$text = $this->getRenderer('message')->render(
			[
				'order' => $order,
				'config' => $this->config,
				'vendorTable' => $vendorTable
			]
		);
		$adminPhone = $this->addonParams->get('admin_phone', '');
		$url = 'https://wa.me/'.$adminPhone.'?text='.urlencode($text);
		$this->app->redirect($url);
	}
}
