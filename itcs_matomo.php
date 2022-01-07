<?php
/*
# Plugin Matomo (formerly Piwik) based Plugin by it-conserv.de
# ------------------------------------------------------------------------
# Author    it-conserv.de
# Copyright (C) 2021 it-conserv.de All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: it-conserv.de
*/

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;


/**
 * Matomo system plugin
 */
class PlgSystemItcs_matomo extends CMSPlugin
{
	
	/**
	 * Application object
	 *
	 * @var    \Joomla\CMS\Application\CMSApplication
	 * @since  4.0.0
	 */
	protected $app;


	/**
	* Do something onAfterRender
	*/
	public function onAfterRender()
	{
		
		// Use this plugin only in site application.
		if ($this->app->isClient('site'))
		{	
		
			// Get the response body.
			$body = $this->app->getBody();

			// Get the Params
			$hcode = $this->params->get('hcode','');
			$optout = $this->params->get('optout','');
			
			
			// replace optout
			$body = str_replace('{matomo_opt_out}', $optout, $body);
			
			// Set analytics code			
			$pos = strrpos($body, "</head>");
			
			if($pos > 0)
			{
				$body = substr($body, 0, $pos).$hcode.substr($body, $pos);

			}
			
			$this->app->setBody($body);
		}
		
		return true;
		
		
	}

}