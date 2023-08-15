<?php
/**
 * @package    Joomla.Plugins
 * @subpackage  Jshoppingorder.Wishboxorderrepeat
 * @author     Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @copyright  (C) 2023 WishBox
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @noinspection PhpUnused
 */
namespace Joomla\Plugin\Jshoppingcheckout\Wishboxwhatsapporder\Extension;

use Joomla\CMS\Document\HtmlDocument;
use Joomla\Component\Jshopping\Site\Lib\JSFactory;
use Joomla\Component\Jshopping\Site\Table\ConfigTable;
use Joomla\Component\Jshopping\Site\Table\OrderTable;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;
use Joomla\Registry\Registry;
use Wishbox\JShoppingPlugin;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * @property ConfigTable $config
 * @property Registry $addonParams
 * @since 1.0.0
 *
 * @noinspection PhpUnused
 */
final class Wishboxwhatsapporder extends JShoppingPlugin implements SubscriberInterface
{
	/**
	 * @var   string Addon alias
	 * @since 1.0.0
	 * @noinspection PhpUnused
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
			'onLoadStep5save' => 'onLoadStep5save',
			'onEndCheckoutStep5' => 'onEndCheckoutStep5',
			'onBeforeDisplayCheckoutFinish' => 'onBeforeDisplayCheckoutFinish'
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
		$view->_tmp_ext_html_previewfinish_before_button .= $html; // phpcs:ignore
		$event->setArgument(0, $view);
	}

	/**
	 * @param   Event $event Event.
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @noinspection PhpUnused
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function onLoadStep5save(Event $event): void
	{
		$wishboxwhatsapporder = $this->app->input->getInt('wishboxwhatsapporder', 0);
		/** @noinspection PhpPossiblePolymorphicInvocationInspection */
		$this->app->setUserState('com_jshopping.wishboxwhatsapporder', $wishboxwhatsapporder);
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

	}

	/**
	 * @param   Event $event Event.
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @noinspection PhpUnused
	 */
	public function onBeforeDisplayCheckoutFinish(Event $event): void
	{
		$orderId = $event->getArgument(1);

		/** @noinspection PhpPossiblePolymorphicInvocationInspection */
		$wishboxwhatsapporder = $this->app->getUserState('com_jshopping.wishboxwhatsapporder');

		if (!$wishboxwhatsapporder)
		{
			return;
		}

		/** @noinspection PhpPossiblePolymorphicInvocationInspection */
		$this->app->setUserState('com_jshopping.wishboxwhatsapporder', 0);

		$orderTable = JSFactory::getTable('order');
		$orderTable->load($orderId);
		$url = $this->getUrl($orderTable);

		/** @var HtmlDocument $document */
		/** @noinspection PhpPossiblePolymorphicInvocationInspection */
		$document = $this->app->getDocument();
		$wa       = $document->getWebAssetManager();
		$wa->addInlineScript(
			"
				var newWindow = window.open('" . $url . "');",
			[],
			['type' => 'module']
		);
	}

	/**
	 * @param   OrderTable  $orderTable Order table
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private function getUrl(OrderTable $orderTable): string
	{
		$vendorTable = JSFactory::getTable('vendor');
		$vendorTable->loadMain();
		$text = $this->getRenderer('message')->render(
			[
				'orderTable' => $orderTable,
				'config' => $this->config,
				'vendorTable' => $vendorTable
			]
		);
		$adminPhone = $this->addonParams->get('admin_phone', '');

		return 'https://wa.me/' . $adminPhone . '?text=' . urlencode($text);
	}
}
