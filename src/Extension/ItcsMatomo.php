<?php

/**
* Joomla.Plugin - itcs Matomo
* ------------------------------------------------------------------------
* @package     itcs Matomo
* @author      it-conserv.de
* @copyright   2023 it-conserv.de
* @license     GNU/GPLv3 <http://www.gnu.org/licenses/gpl-3.0.de.html>
* @link        https://it-conserv.de
* ------------------------------------------------------------------------
*/

namespace ITCS\Plugin\System\ItcsMatomo\Extension;

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;

/**
 * Matomo system plugin
 */
final class ItcsMatomo extends CMSPlugin
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
            $body = \str_replace('{matomo_opt_out}', $optout, $body);
            
            // Set analytics code			
            $pos = \strrpos($body, "</head>");
            
            if($pos > 0)
            {
                $body = \substr($body, 0, $pos).$hcode.substr($body, $pos);

            }
            
            $this->app->setBody($body);
        }
        
        return true;

    }

}
