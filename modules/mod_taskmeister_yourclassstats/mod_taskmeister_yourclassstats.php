<?php
/**
 * Your Class Stats Module Entry Point
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


$displayHeader = modYourClassesStats::getHeader($params);//invoke helper class method
$displayText = modYourClassesStats::getText($params);//invoke helper class method
$displayMode = $params->get('display');//Gets display mode of the stats
$maxTags = intval($params->get('maxTags'));//Gets the max number of tags to display

//Use factory
use Joomla\CMS\Factory;
$db = Factory::getDbo();//Sets database variable
$me = Factory::getUser();//Sets user variable
$userID = $me->id;//Sets user id

if ($userID!=0){//if User id isnt a guest
    //Querying the database
    $query = $db->getQuery(true);
    $query->select($db->quoteName(array('es_teacherid','es_students')))//Gets the teacher id and their class
        ->from($db->quoteName('#__customtables_table_teacherstats'))//From the custom teacher stats table
        ->where($db->quoteName('es_teacherid') . ' = ' . $userID);//Where the teacher id is equal to the current user id
    $db->setQuery($query);
    $results = $db->loadAssocList();//Save results as $results2

    if ($results){//If teacher data exists
        foreach ($results as $row){//Extract teacher data
            $teacher = JFactory::getUser($row['es_teacherid']);//Get Teacher Profile
            $teacherName = $teacher->name;//Get Teacher Name
            //Gets the class
            $studentsList = json_decode($row['es_students']);
        }
        //Initialize Preferences Score Array
        $fullPreferencesScore = array();
        $dislikedPreferencesScore = array();
        //Loop base on students list
        foreach ($studentsList as $row){
            $query = $db->getQuery(true);
            $query->select($db->quoteName(array('es_userid','es_userpreference')))//Get user id, user preference
                ->from($db->quoteName('#__customtables_table_userstats'))//From our external user stats table
                ->where($db->quoteName('es_userid') . ' = ' . $row);//Where it is the current user's userid
            $db->setQuery($query);
            $results2 = $db->loadAssocList();//Save results as $results2
            foreach ($results2 as $row2){//Loop for each student found
                $studentPreferences = json_decode($row2['es_userpreference']);//Gets the student's preferences
                foreach ($studentPreferences as $key => $value){//Loop for each student's preference
                    if (isset($fullPreferencesScore[$key])) $fullPreferencesScore[$key] += $value;//If alr exists in the dictionary, increment the score
                    else $fullPreferencesScore[$key] = $value;//Else create as a new score
                    if ($value == 0){//If the student dislikes the tag
                        if ($dislikedPreferencesScore[$key]) $dislikedPreferencesScore[$key] += 1;//Increment its dislike score instead
                        else $dislikedPreferencesScore[$key] = 1;
                    }
                }
            }
        }
        //Sort Preference Score by highest first
        arsort($fullPreferencesScore);
        arsort($dislikedPreferencesScore);
        //Limit scores based on max tags size
        //Save old array
        $oldFullPreferencesScore = $fullPreferencesScore;
        $oldDislikedPreferencesScore = $dislikedPreferencesScore;
        //Clear array
        $fullPreferencesScore = array();
        $dislikedPreferencesScore = array();
        //Push array base on limited value
        $count=0;//Initialize count
        //Loop for each preference recorded
        foreach($oldFullPreferencesScore as $key => $value){
            if ($maxTags==0 || $count<$maxTags){//If yet to exceed the max number of tags or if max tags == 0
                $fullPreferencesScore[$key] = $value;//Save the tag into new array
                $count+=1;//Increment counter
            } 
        }
        $count=0; //Reset counter
        //Loop for each disliked preference recorded
        foreach($oldDislikedPreferencesScore as $key => $value){
            if ($maxTags==0 || $count<$maxTags){//If yet to exceed max number of tags or max number == 0
                $dislikedPreferencesScore[$key] = $value;//Save the tag into new array
                $count+=1;//Increment counter
            } 
        }
        //Sets up arrays
        $likePreferencesScore = array();
        foreach ($fullPreferencesScore as $key => $value){//Loop for each preference
            if ($value>0) $likePreferencesScore[$key] = $value;//If value is more than 0, Save tag into new array
        }
        //Display html view of your class stats
        require JModuleHelper::getLayoutPath('mod_taskmeister_yourclassstats');
    }
    else{
        //Hide confusing debug msg
        //echo "<br><h3>You have to be a teacher to see this feature</h3>";
    }   
}
else{
    //Hide confusing debug msg
    //echo "<br><h3>You have to be a teacher to see this feature</h3>";
}
