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

/**
 * Provides access to the jQuery library as a MantisBT plugin.
 */
class jQueryPlugin extends MantisPlugin {

	function register() {
		$this->name = 'jQuery';
		$this->description = lang_get( 'plugin_jQuery_description' );
		$this->page = 'config';

		$this->version = '1.3.2';
		$this->requires = array (
			'MantisCore' => '1.2.0'			
		);

		$this->author = 'Tomasz Sta&#324;czyk';
		$this->contact = 'tomasz.stanczyk@lab74.org';
		$this->url = 'http://www.lab74.org';
	}

	function config() {
		return array (
			'use_cdn' => true
		);
	}
	
	function init() {
		event_declare( 'EVENT_LAYOUT_RESOURCES_JQUERY_ONLOAD', EVENT_TYPE_DEFAULT );
	}	

	function hooks() {
		return array (
			'EVENT_LAYOUT_RESOURCES' => 'resources'			
		);
	}

	/**
	 * Create the resource link to load the jQuery library.
	 */
	function resources($p_event) {
		$html = '';
		$use_cdn = plugin_config_get('use_cdn');
		if ($use_cdn) {
			$html .= '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/' . $this->version . '/jquery.min.js"></script>'."\n";
		} else {
			$html .= '<script type="text/javascript" src="' . plugin_file('script.js') . '"</script>'."\n";
		}
		$html .= $this->render_ready_function();	
		return $html;
	}
	
	function render_ready_function() {
		$html = '<script type="text/javascript">'."\n".'//<![CDATA['."\n".'$(document).ready(function() {'."\n";
		$parts = event_signal( 'EVENT_LAYOUT_RESOURCES_JQUERY_ONLOAD' );
		foreach($parts as $part) {
			$html .= $part['onload'];
		}
		$html .= '});'."\n".'//]]>'."\n".'</script>'."\n";	
		return $html;		
	}
	
		
	
}