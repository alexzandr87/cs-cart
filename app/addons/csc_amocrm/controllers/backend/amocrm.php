<?php
use Tygh\Registry;
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if ($mode == 'check_message')
	{
		$_SESSION['message_data'] = $_REQUEST;
		$msg = Registry::get('view')->fetch('addons/csc_amocrm/components/accept_message_send.tpl');
		fn_set_notification('I', __("accept_message_send"), $msg);
		exit;
	}

	if ($mode == 'send_feedback')
	{
		fn_set_notification('N', __("success"), __("feedback_has_been_sent"));

		return array(CONTROLLER_STATUS_OK, 'addons.update?addon=csc_amocrm');
	}
}
else
{
	if ($mode == 'messages_report')
	{

	}
	
	if ($mode == 'send_message')
	{
		$data = $_SESSION['message_data'];
		fn_print_r($data);
		unset($_SESSION['message_data']);
	}

	if ($mode == 'send')
	{
		$tabs = array(
			'sms' => array(
	            'title' => __('sms'),
	            'js' => true
	        ),
	        'viber' => array (
	            'title' => __('viber'),
	            'js' => true
	        ),
	        'omni' => array (
	            'title' => __('omni'),
	            'js' => true
	        )
		);

		Registry::set('navigation.tabs', $tabs);
	}
	if ($mode == 'refresh_balance')
	{
		$balance = fn_get_amocrm_balance();

		Registry::get('view')->assign('balance', $balance);
		Registry::get('view')->display('addons/csc_amocrm/components/balance_info.tpl');

		exit;
	}
}