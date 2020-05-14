<?php
/**
 * Helper class for Recommend Articles
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
class ModRecommendArticlesHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getText($params)//Function to get text from the parameter fields
    {
        return $params->get('customtext');
    }
    public static function getHeader($params)//Function to get text from the parameter fields
    {
        return $params->get('customheader');
    }
    function getArticleList($params){//Function to get selection from parameter fields
        //Call our recommender
        JPluginHelper::importPlugin('taskmeister','tm_recommender');
        $dispatcher = JDispatcher::getInstance();
        //Initialize result
        $results = array("Calculating... ");
        //Check parameters
        switch($params){
            case 'choice_liked':
            case 'choice_personal':
                $results = $dispatcher->trigger( 'recommendmostLikedArticles', array());
                break;
            case 'choice_deployed':
                $results = $dispatcher->trigger( 'recommendmostDeployedArticles', array());
                break;
            case 'choice_random':
            case 'choice_new':
                $results = array("Not implemented yet. Please select another filter. ");
                break;
        }
        
        //Return string
        return json_encode($results[0]) ;
    }
}