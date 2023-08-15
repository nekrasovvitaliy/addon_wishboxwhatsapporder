<?php
namespace PHPSTORM_META {
    override(\Psr\Container\ContainerInterface::get(0), map(['' => '@',]));
	override(
		\Joomla\Component\Jshopping\Site\Lib\JSFactory::getTable(0),
		map([
			'addon' => Joomla\Component\Jshopping\Site\Table\AddonTable::class,
			'order' => \Joomla\Component\Jshopping\Site\Table\OrderTable::class,
			'vendor' => \Joomla\Component\Jshopping\Site\Table\VendorTable::class,
		])
	);
}