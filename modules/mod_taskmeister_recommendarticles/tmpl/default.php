<?php 
// No direct access
defined('_JEXEC') or die; 
//Displays module output
?>

<!-- Display out custom header/text-->
<div class="customtext">
    <?php if ($displayHeader) : ?>
        <h3><?php echo $displayHeader; ?></h3>
    <?php endif; ?>
</div>

<?php 
//Display selected mode for debug reasons
//echo "Selected - ". $params->get('filter').": ". $resultsSelected ."<br>";
//Convert the string results of the recommended articles into an array
$list2 = json_decode($recommendedContents);
?>

<!--If mode selected is choice_teacher-->
<?php if (($params->get('filter')) == "choice_teacher") : ?>
  <?php if ($teachersRecommendationDict) : ?>
      <?php foreach ($teachersRecommendationDict as $name => $contents) : ?>
        <ul>
        <h3><?php echo $name; ?>'s Recommendation</h3>
        <div class="articlesRow">
          <!-- Arrow button to scroll left-->
          <i class="arrowLeft" onmouseover="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
                  left: left - 300,
                  behavior: 'smooth',
                });" 
                onclick="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
                  left: left - 300,
                  behavior: 'smooth',
                });"></i>
          <!--Displays list of recommended articles based on the article contents-->
          <div class="recommendedArticles dragscroll" id= "recommendation">
            <!--For loop for the items in the list-->
            <?php $contentList = json_decode($contents); ?>
            <?php foreach ($contentList as $key => $value) : ?>
            <!--Url link to the article page-->
            <a href="?option=com_content&view=article&id=<?php echo $key; ?>" itemprop="url">
                <div class="article">
                  <!--Image of the article-->
                  <img onerror="this.src='/taskmeisterx/modules/mod_taskmeister_recommendarticles/img/default.jpg';" src="<?php echo json_decode($value[1])->image_intro; ?>" width="100%" height="100%" />
                  <!--Text found on the article-->
                  <p><?php echo json_encode($value[0]); ?></p>
                </div>
            </a>
            <?php endforeach; ?>
          </div>
          <!-- Arrow button to scroll right-->
          <i class="arrowRight" onclick="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
                  left: left + 300,
                  behavior: 'smooth',
                });"
                onmouseover="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
                  left: left + 300,
                  behavior: 'smooth',
                });"></i>
        </div>
        </ul>
      <?php endforeach; ?>
  <?php else : ?>
    You don't have a teacher yet.
  <?php endif; ?>
<!--Default display if not choice_teacher-->
<?php else : ?>
  <?php if ($list2) :?>
  <ul class="scrollbarnews<?php echo $moduleclass_sfx; ?> mod-list">
  <div class="articlesRow">
    <!-- Arrow button to scroll left-->
    <i class="arrowLeft" onmouseover="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
            left: left - 300,
            behavior: 'smooth',
          });" 
          onclick="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
            left: left - 300,
            behavior: 'smooth',
          });"></i>
    <!--Displays list of recommended articles based on the article contents-->
    <div class="recommendedArticles dragscroll" id= "recommendation">
      <!--For loop for the items in the list-->
      <?php $count = 0; //For counting the number of articles in list?>
      <?php foreach ($list2 as $key => $value) : ?>
        <?php $count+=1; ?>
        <!--Url link to the article page-->
        <a title="<?echo $value[0]; ?>" href="?option=com_content&view=article&id=<?php echo $key; ?>" itemprop="url">
          <?php if ($displayMode=="display_ranking") : ?>
            <div class="rankedArticle" title="Match: <?php echo json_encode($value[2]); ?>%">
              <?php if ($count>9) : ?>
                <h4><?php echo $count; ?></h4>
              <?php else : ?>
                <h2><?php echo $count;?></h2>
              <?php endif; ?>
              <!--Image of the article-->
              <img onerror="this.src='/taskmeisterx/modules/mod_taskmeister_recommendarticles/img/default.jpg';" src="<?php echo json_decode($value[1])->image_intro; ?>" width="100%" height="100%" />
              <!--Text found on the article-->
              <p>
              <?php if (strlen($value[0])>50) echo substr($value[0], 0, 50)."...";
                else echo $value[0]; ?></p>
            </div>
          <?php else : ?>
            <div class="article">
              <!--Image of the article-->
              <img onerror="this.src='/taskmeisterx/modules/mod_taskmeister_recommendarticles/img/default.jpg';" src="<?php echo json_decode($value[1])->image_intro; ?>" width="100%" height="100%" />
              <!--Text found on the article-->
              <p class="articleSimilarity">Match: <?php echo json_encode($value[2]); ?>%</p>
              <p>
              <?php if (strlen($value[0])>50) echo substr($value[0], 0, 50)."...";
                else echo $value[0]; ?></p>
            </div>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
    <!-- Arrow button to scroll right-->
    <i class="arrowRight" onclick="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
            left: left + 300,
            behavior: 'smooth',
          });"
          onmouseover="var left = this.closest('div').querySelector('.recommendedArticles').scrollLeft; this.closest('div').querySelector('.recommendedArticles').scrollTo({
            left: left + 300,
            behavior: 'smooth',
          });"></i>
  </div>
  </ul>
  <?php if ($displayText) : ?>
        <?php echo $displayText; ?>
  <?php endif; ?>
  <?php else :?>
      Cannot find relevant articles
  <?php endif; ?>
<?php endif; ?>
  <script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
