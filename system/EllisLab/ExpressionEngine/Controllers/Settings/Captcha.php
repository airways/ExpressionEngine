<?php

namespace EllisLab\ExpressionEngine\Controllers\Settings;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use CP_Controller;

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license		http://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 3.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine CP Captcha Settings Class
 *
 * @package		ExpressionEngine
 * @subpackage	Control Panel
 * @category	Control Panel
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class Captcha extends Settings {

	public function index()
	{
		$vars['sections'] = array(
			array(
				array(
					'title' => 'captcha_font',
					'desc' => 'captcha_font_desc',
					'fields' => array(
						'captcha_font' => array('type' => 'yes_no')
					)
				),
				array(
					'title' => 'captcha_rand',
					'desc' => 'captcha_rand_desc',
					'fields' => array(
						'captcha_rand' => array('type' => 'yes_no')
					)
				),
				array(
					'title' => 'captcha_require_members',
					'desc' => 'captcha_require_members_desc',
					'fields' => array(
						'captcha_require_members' => array('type' => 'yes_no')
					)
				)
			),
			'url_path_settings_title' => array(
				array(
					'title' => 'captcha_url',
					'desc' => 'captcha_url_desc',
					'fields' => array(
						'captcha_url' => array('type' => 'text')
					)
				),
				array(
					'title' => 'captcha_path',
					'desc' => 'captcha_path_desc',
					'fields' => array(
						'captcha_path' => array('type' => 'text')
					)
				)
			)
		);

		ee()->form_validation->set_rules(array(
			array(
				'field' => 'captcha_path',
				'label' => 'lang:captcha_path',
				'rules' => 'file_exists|writable'
			)
		));

		$base_url = cp_url('settings/captcha');

		if (AJAX_REQUEST)
		{
			ee()->form_validation->run_ajax();
			exit;
		}
		elseif (ee()->form_validation->run() !== FALSE)
		{
			if ($this->saveSettings($vars['sections']))
			{
				ee()->view->set_message('success', lang('preferences_updated'), lang('preferences_updated_desc'), TRUE);
			}

			ee()->functions->redirect($base_url);
		}
		elseif (ee()->form_validation->errors_exist())
		{
			ee()->view->set_message('issue', lang('settings_save_error'), lang('settings_save_error_desc'));
		}

		ee()->view->ajax_validate = TRUE;
		ee()->view->base_url = $base_url;
		ee()->view->cp_page_title = lang('captcha_settings');
		ee()->view->cp_page_title_alt = lang('captcha_settings_title');
		ee()->view->save_btn_text = 'btn_save_settings';
		ee()->view->save_btn_text_working = 'btn_save_settings_working';

		ee()->cp->render('_shared/form', $vars);
	}
}
// END CLASS

/* End of file Captcha.php */
/* Location: ./system/expressionengine/controllers/cp/Settings/Captcha.php */