<?php
use Wishbox\JShopping\AddonHelper;

defined('_JEXEC') or die;

echo AddonHelper::renderSettingsForm($this->row->alias);
