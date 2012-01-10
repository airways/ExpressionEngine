<?php

/*
=====================================================
 ExpressionEngine - by EllisLab
-----------------------------------------------------
 http://expressionengine.com/
-----------------------------------------------------
 Copyright (c) 2004 - 2011 EllisLab, Inc.
=====================================================
 THIS IS COPYRIGHTED SOFTWARE
 PLEASE READ THE LICENSE AGREEMENT
 http://expressionengine.com/user_guide/license.html
=====================================================
 File: rte.link.php
-----------------------------------------------------
 Purpose: Link RTE Tool
=====================================================

*/

$rte_tool_info = array(
	'rte_name'			=> 'Link',
	'rte_version'		=> '1.0',
	'rte_author'		=> 'Aaron Gustafson',
	'rte_author_url'	=> 'http://easy-designs.net/',
	'rte_description'	=> 'Triggers the RTE to link the selected text',
	'rte_definition'	=> Link_rte::definition()
);

Class Link_rte {
	
	private $EE;
	
	/** -------------------------------------
	/**  Constructor
	/** -------------------------------------*/
	function __construct()
	{
		// Make a local reference of the ExpressionEngine super object
		$this->EE =& get_instance();
		
		// Anything else we need?
	}

	function definition()
	{
		ob_start(); ?>
		
		toolbar.addButton({
			name: 'link',
	        label: "∞",
	        handler: function( $ed ){
				$ed.linkSelection( prompt('Where should this link go?') );
			}
	    });
		
<?php	$buffer = ob_get_contents();
		ob_end_clean(); 
		return $buffer;
	}

} // END Link_rte

/* End of file rte.link.php */
/* Location: ./system/expressionengine/rte_tools/link/rte.link.php */