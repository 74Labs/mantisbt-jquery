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

form_security_validate('plugin_jQuery_config_edit');

auth_reauthenticate();
access_ensure_global_level(config_get('manage_plugin_threshold'));

$f_use_cdn = gpc_get_int('use_cdn', OFF);

if (current_user_is_administrator()) {
	if (plugin_config_get('use_cdn') != $f_use_cdn) {
		plugin_config_set('use_cdn', $f_use_cdn);
	}
}

form_security_purge('plugin_jQuery_config_edit');

print_successful_redirect(plugin_page('config', true));