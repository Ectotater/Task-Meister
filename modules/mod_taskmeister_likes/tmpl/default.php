<?php 
// No direct access
defined('_JEXEC') or die; 
//Displays module output
use Joomla\CMS\Factory;
$db = Factory::getDbo();
$me = Factory::getUser();

//Querying
$query = $db->getQuery(true);
$query->select($db->quoteName(array('title','id','hits','featured','catid')))
    ->from($db->quoteName('#__content'))
    ->where($db->quoteName('id') . ' = ' . JRequest::getVar('id'));
$db->setQuery($query);
$results = $db->loadAssocList();
foreach ($results as $row) {
    $articleID = $row['id'];
    $articleTitle = $row['title'];
    $articleCat = $row['catid'];
    $articleHits = $row['hits'];
    $articleFeatured =  $row['featured'];
}

//Set Alert Message
if ($me->id == 0){
    $thumbsUp = modTMLikes::loginFirst();//Invoke thumbs up method
    $thumbsDown = modTMLikes::loginFirst();//Invoke thumbs down method
} 
else {
    $thumbsUp = modTMLikes::giveThumbsUp();//Invoke thumbs up method
    $thumbsDown = modTMLikes::giveThumbsDown();//Invoke thumbs down method
    }

?>

<div class="customtext">
    <?php if ($displayHeader) : ?>
        <h3><?php echo $displayHeader; ?></h3>
    <?php endif; ?>
    <?php if ($displayText) : ?>
        <?php echo $displayText; ?>
    <?php endif; ?>
</div>
<div id="thumbsBox">
    <button id= "thumbsUp" type="button" onclick="alert('<?php echo $thumbsUp; ?>')">👍</button>
    <button id = "thumbsDown" type="button" onclick="alert('<?php echo $thumbsDown ?>')">👎</button>
</div>