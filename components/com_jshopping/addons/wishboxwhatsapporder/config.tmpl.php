<?php
/**
 * @copyright  (C) 2023 WishBox
 * @license    GNU General Public License version 2 or later
 */
use Wishbox\JShopping\AddonHelper;

defined('_JEXEC') or die;

echo AddonHelper::renderSettingsForm($this->row->alias);
