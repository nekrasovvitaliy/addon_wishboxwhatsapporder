<?php
/**
 * @copyright Copyright (c) 2013-2023 Wishbox
 * @license     GNU General Public License version 2 or later
 * @noinspection PhpUndefinedVariableInspection
 */

use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

$orderTable = $displayData['orderTable'];
$config = $displayData['config'];
$vendorTable = $displayData['vendorTable'];
$orderItems = $orderTable->getAllItems();
?>
New Order Received @ <?php echo $vendorTable->shop_name; ?>

--------------------------------

Order number    : <?php echo $orderTable->order_number; ?>

Date            : <?php echo HTMLHelper::_('date', $orderTable->order_date, 'F d, Y'); ?>

Email           : <?php echo $orderTable->email; ?>

Total Amount    : <?php echo JSHelper::formatprice($orderTable->order_total); ?>


Order details:

<?php foreach ($orderItems as $orderItem) { ?>
<?php echo $orderItem->product_name; ?> x <?php echo $orderItem->product_quantity; ?> => <?php echo JSHelper::formatprice($orderItem->product_quantity * $orderItem->product_item_price); ?>

<?php echo $orderItem->product_attributes; ?>

<?php } ?>

--------------------------------

Subtotal: <?php echo JSHelper::formatprice($orderTable->order_total); ?>

Total: <?php echo JSHelper::formatprice($orderTable->order_subtotal); ?>

--------------------------------

Billing address: <?php echo $orderTable->street; ?>


Адрес доставки <?php echo $orderTable->d_street; ?>



Имя фамилия <?php echo $orderTable->f_name; ?> <?php echo $orderTable->l_name; ?>



Номер телефона <?php echo $orderTable->phone; ?>
