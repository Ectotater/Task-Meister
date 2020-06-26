<?php
/**
 * Recent Recommendations Module Entry Point
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die; // ensures that this file is being invoked from the Joomla! application. This is necessary to prevent variable injection and other security vulnerabilities. 
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';//used because our helper functions are defined within a class, and we only want the class defined once. 


$displayHeader = modRecentRecommend::getHeader($params);//set variable of header using helper class
$displayText = modRecentRecommend::getText($params);//set variable of text using helper class
$size = $params->get('size');


//Database code
use Joomla\CMS\Factory;
$db = Factory::getDbo();//Get database

//Querying SQL database for recent recommendations
$query = $db->getQuery(true);
$query->select($db->quoteName(array('*')))//Sets which columns of database
    ->from($db->quoteName('#__customtables_table_recommendationstats'))
    ->order($db->quoteName('id') . ' DESC');//Sets which database
$db->setQuery($query);
$results = $db->loadAssocList();//Save results of external article database query

if ($results){//If inside article table
    $counter = 0;//Initialize counter
    require JModuleHelper::getLayoutPath('mod_taskmeister_recentrecommendation');//call out default.php display
}

else{//If no recent recommendationa actions
    echo "No recent actions. ";

}