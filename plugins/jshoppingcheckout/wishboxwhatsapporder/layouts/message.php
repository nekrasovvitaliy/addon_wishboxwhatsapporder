<?php
/**
 * @copyright Copyright (c) 2013-2023 Wishbox
 * @license     GNU General Public License version 2 or later
 * @noinspection PhpUndefinedVariableInspection
 */

use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

$order = $displayData['order'];
$config = $displayData['config'];
$vendorTable = $displayData['vendorTable'];
$orderItems = $order->getAllItems();
?>
New Order Received @ <?php echo $vendorTable->shop_name; ?>

--------------------------------

Order number    : <?php echo $order->order_number; ?>

Date            : <?php echo HTMLHelper::_('date', $order->order_date, 'F d, Y'); ?>

Email           : <?php echo $order->email; ?>

Total Amount    : <?php echo JSHelper::formatprice($order->order_total); ?>


Order details:

<?php foreach ($orderItems as $orderItem) { ?>
    <?php echo $orderItem->product_name; ?> x <?php echo $orderItem->product_quantity; ?> => <?php echo JSHelper::formatprice($orderItem->product_quantity * $orderItem->product_item_price); ?>

<?php } ?>

--------------------------------

Subtotal: <?php echo JSHelper::formatprice($order->order_total); ?>

Total: <?php echo JSHelper::formatprice($order->order_subtotal); ?>

--------------------------------

Billing address: <?php echo $order->street; ?>


Адрес доставки <?php echo $order->d_street; ?>



Имя фамилия <?php echo $order->f_name; ?> <?php echo $order->l_name; ?>



Номер телефона <?php echo $order->phone; ?>