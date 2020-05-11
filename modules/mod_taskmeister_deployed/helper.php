<?php
/**
 * Helper class for Taskmeister Deployed module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modTMDeployed
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getText($params)
    {
        return $params->get('customtext');
    }
    public static function getHeader($params)
    {
        return $params->get('customheader');
    }
    public static function giveThumbsUp(){//Give thumbs up
        return 'You gave a thumbs up!'; 
    }
    public static function giveThumbsDown(){//Give thumbs down
        return 'You gave a thumbs down!'; 
    }
    public static function loginFirst(){//Give thumbs down
        return 'Login first!!!'; 
    }

}