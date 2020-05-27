<?php 
// No direct access
defined('_JEXEC') or die; 
//Displays module output
?>
<div class="wrapper">
    <div class="featuredArticle">
        <!--If exists video, play video. Else show image of article.-->
        <?php if ($videoLink) : ?>
            <iframe width="300" height="300" src="<?php echo $videoLink; ?>">
            </iframe>
        <?php else : ?>
            <img width="300" height="300" src="<?php echo $articleImage; ?>"></img>
        <?php endif; ?>
        <div class="featuredArticleText">
            <!--Displays Custom Header if exists, else use article title-->
            <?php if ($displayHeader) : ?>
                <h3><?php echo $displayHeader; ?></h3>
            <?php else : ?>
                <h3><?php echo $articleTitle; ?></h3>
            <?php endif; ?>
            <!--Displays Text if exists-->
            <?php if ($displayText) : ?>
                <p><?php echo $displayText; ?></p>
            <?php endif; ?>
            <!--Displays who has liked it-->
            <p><b>Users who like this: </b><?php echo "Work In Progress"; ?></p>
            <!--Displays those in your school that has deployed it-->
            <p><b>Users who deploy this: </b><?php echo "Work In Progress"; ?></p>
            <!--Displays play button-->
            <p>
                <a>▶ Play</a>
            </p>
        </div>
    </div>
</div>