<?php
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;
?>
<input name="wishboxwhatsapporder" type="hidden" value="174" />
<button
        class="btn btn-success button"
        type="button"
        onclick="this.form.elements.wishboxwhatsapporder.value=1;this.form.submit();"
>
    <?php echo Text::_('PLG_JSHOPPINGCHECKOUT_WISHBOXWHATSAPPORDER_CONFIRM_ORDER_IN_WHATS_APP'); ?>
</button>
<br />
<br />
