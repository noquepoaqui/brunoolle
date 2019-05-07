<?php
// Before removing this file, please verify the PHP ini setting `auto_prepend_file` does not point to this.

if (file_exists('/var/bigdata/users/web465/web/http/wp-content/plugins/wordfence/waf/bootstrap.php')) {
	define("WFWAF_LOG_PATH", '/var/bigdata/users/web465/web/http/wp-content/wflogs/');
	include_once '/var/bigdata/users/web465/web/http/wp-content/plugins/wordfence/waf/bootstrap.php';
}
?>