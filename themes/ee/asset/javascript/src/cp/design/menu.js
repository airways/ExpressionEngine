/*!
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2016, EllisLab, Inc.
 * @license		https://expressionengine.com/license
 * @link		https://ellislab.com
 * @since		Version 3.0
 * @filesource
 */

$(document).ready(function () {
	$('.sidebar .folder-list .remove a.m-link').click(function (e) {
		var modalIs = '.' + $(this).attr('rel');

		$(modalIs + " .checklist").html(''); // Reset it
		$(modalIs + " .checklist").append('<li>' + $(this).data('confirm') + '</li>');
		$(modalIs + " input[name='group_name']").val($(this).data('group_name'));

		e.preventDefault();
	})
});