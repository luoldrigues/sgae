<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host='.$_SERVER['DB_HOST'].';dbname='.$_SERVER['DB_NAME'],
			'username'   => $_SERVER['DB_USER'],
			'password'   => $_SERVER['DB_PASS'],
		),
	),
);
