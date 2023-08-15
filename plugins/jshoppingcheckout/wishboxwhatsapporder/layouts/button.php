<?php
/**
 * @copyright Copyright (c) 2013-2023 Wishbox
 * @license     GNU General Public License version 2 or later
 * @noinspection PhpUndefinedVariableInspection
 */

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;
?>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('previewfinish_btn').style.display = 'none';
    });
</script>
<input onclick="if (this.checked) { document.getElementById('wishboxwhatsapporder_confirm').style.display = 'none'; document.getElementById('previewfinish_btn').style.display = 'inline'; } else { document.getElementById('wishboxwhatsapporder_confirm').style.display = 'inline'; document.getElementById('previewfinish_btn').style.display = 'none'; }" type="checkbox" value="1" /> <?php echo Text::_('PLG_JSHOPPINGCHECKOUT_WISHBOXWHATSAPPORDER_I_DO_NOT_HAVE_WHATS_APP'); ?>
<br />
<br />
<input name="wishboxwhatsapporder" type="hidden" value="0" />
<button
		class="btn btn-success button"
        id="wishboxwhatsapporder_confirm"
		type="button"
		onclick="this.form.elements.wishboxwhatsapporder.value=1;this.form.submit();"
>
	<?php echo Text::_('PLG_JSHOPPINGCHECKOUT_WISHBOXWHATSAPPORDER_CONFIRM_ORDER_IN_WHATS_APP'); ?>
</button>
<br />
<br />
