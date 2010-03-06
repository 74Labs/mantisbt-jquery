<?php

# Copyright (C) 2010 Tomasz Stañczyk, Lab74.org
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

html_page_top( plugin_lang_get( 'title' ) );

print_manage_menu( );

?>

<br/>
<form action="<?php echo plugin_page( 'config_edit' )?>" method="post">
<?php echo form_security_field( 'plugin_jQuery_config_edit' ) ?>
<table align="center" class="width75" cellspacing="1">

<tr>
	<td class="form-title" colspan="3">
		<?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config' )?>
	</td>
</tr>

<?php if ( current_user_is_administrator() ) {?>

<tr <?php echo helper_alternate_class( )?>>
	<td class="category">
		<?php echo plugin_lang_get( 'use_cdn' )?>
		<br /><span class="small"><?php echo plugin_lang_get( 'use_cdn_info' )?></span>
	</td>
	<td class="center">
		<label><input type="radio" name="use_cdn" value="1" <?php echo( ON == plugin_config_get( 'use_cdn' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('enabled')?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="use_cdn" value="0" <?php echo( OFF == plugin_config_get( 'use_cdn' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('disabled')?></label>
	</td>
</tr>

<tr>
	<td class="center" colspan="3">
		<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' )?>" />
	</td>
</tr>

<?php } ?>

</table>
<form>

<?php
html_page_bottom();
