<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

fn_register_hooks(
	'update_profile',
	'update_product_amount',
	'place_order',
	'change_order_status'
);