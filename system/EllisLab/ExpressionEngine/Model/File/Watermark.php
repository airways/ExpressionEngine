<?php

namespace EllisLab\ExpressionEngine\Model\File;

use EllisLab\ExpressionEngine\Service\Model\Model;

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
 * ExpressionEngine Watermark Model
 *
 * A model representing one of the watermarks associated with an image
 * manipulation belonging to an upload destination
 *
 * @package		ExpressionEngine
 * @subpackage	File
 * @category	Model
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class Watermark extends Model {

	protected static $_primary_key = 'wm_id';
	protected static $_table_name = 'file_watermarks';

	protected $wm_id;
	protected $wm_name;
	protected $wm_type;
	protected $wm_image_path;
	protected $wm_test_image_path;
	protected $wm_use_font;
	protected $wm_font;
	protected $wm_font_size;
	protected $wm_text;
	protected $wm_vrt_alignment;
	protected $wm_hor_alignment;
	protected $wm_padding;
	protected $wm_opacity;
	protected $wm_hor_offset;
	protected $wm_vrt_offset;
	protected $wm_x_transp;
	protected $wm_y_transp;
	protected $wm_font_color;
	protected $wm_use_drop_shadow;
	protected $wm_shadow_distance;
	protected $wm_shadow_color;
}
