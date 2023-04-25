<?php

if(defined('WP_CRON_CUSTOM_HTTP_BASIC_USERNAME') && defined('WP_CRON_CUSTOM_HTTP_BASIC_PASSWORD')) {
	function http_basic_cron_request($cron_request) {
		$headers = array('Authorization' => sprintf('Basic %s', base64_encode(WP_CRON_CUSTOM_HTTP_BASIC_USERNAME . ':' . WP_CRON_CUSTOM_HTTP_BASIC_PASSWORD)));

		$cron_request['args']['headers'] = isset($cron_request['args']['headers']) ? array_merge($cron_request['args']['headers'], $headers) : $headers;

		return $cron_request;
	}

	add_filter('cron_request', 'http_basic_cron_request');
}
