<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Variables
$categoryName = "Strongly Recommended";
?>

<ul class="scrollbarnews<?php echo $moduleclass_sfx; ?> mod-list">
<h3><?php echo $categoryName; ?><h3>
<div class="articlesRow">
  <i class="arrowLeft" onclick="document.getElementById('recommendation').scrollLeft -= 100;"></i>
  <div class="recommendedArticles" id= "recommendation">
    <?php foreach ($list as $item) : ?>
    <a href="<?php echo $item->link; ?>" itemprop="url">
        <div class="article">
          <img src="<?php echo json_decode($item->images)->image_intro; ?>" width="100%" height="100%" />
          <p><?php echo $item->title; ?></p>
        </div>
    </a>
    <?php endforeach; ?>
  </div>
  <i class="arrowRight" onclick="document.getElementById('recommendation').scrollLeft += 100;"></i>
</div>
</ul>
