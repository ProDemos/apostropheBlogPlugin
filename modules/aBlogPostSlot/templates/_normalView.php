<?php slot("a-slot-controls-$name-$permid") ?>
	<li class="a-controls-item edit">
    <?php echo jq_link_to_function('edit', '', array(
  		'id' => 'a-slot-edit-'.$name.'-'.$permid, 
  		'class' => 'a-btn icon a-edit', 
  		'title' => 'Edit', 
  	)) ?>

  	<script type="text/javascript">
  	$(document).ready(function(){
  		var editBtn = $('#a-slot-edit-<?php echo $name ?>-<?php echo $permid ?>');
  		var editSlot = $('#a-slot-<?php echo $name ?>-<?php echo $permid ?>');
		
  		editBtn.click(function(event){
  			$(this).parent().addClass('editing-now');
  			$(editSlot).children('.a-slot-content').children('.a-slot-content-container').hide(); // Hide content
  			$(editSlot).children('.a-slot-content').children('.a-slot-form').fadeIn();	// I changed this to fadeIn from show() -- this seemed to help with the stroke re-draw bug we were experiencing.
  			aUI($(this).parents('.a-slot').attr('id'));
  			// $(editSlot).children('.a-messages').css('visibility','hidden'); // Hide the messages
  			return false;
  		});
  	})
  	</script>
	</li>
<?php end_slot() ?>

<?php // Look at $a_blog_post, not $value; posts can be deleted ?>
<?php if (!$a_blog_post): ?>
  <?php if ($editable): ?>
    Click edit to select a post.
  <?php endif ?>
<?php else: ?>
<div class="a-blog-post <?php echo count($a_blog_post->getAttachedMedia()) > 0? 'contains-media' : ''?> ">
<h3 class="a-blog-post-title"><?php echo link_to($a_blog_post->getTitle(), 'a_blog_post', $a_blog_post) ?></h3>
<ul class="a-blog-post-meta">
	<li class="date"><?php echo date('l F jS Y', strtotime($a_blog_post->getPublishedAt())) ?></li>
</ul>

<?php if ($a_blog_post->getAttachedMedia()): ?>
	<?php if (in_array('aSlideshowSlot', sfConfig::get('sf_enabled_modules'))): ?>
		<div class="a-blog-post-media">
			<?php include_component('aSlideshowSlot', 'slideshow', array(
				'items' => $a_blog_post->getAttachedMedia(),
				'id' => $a_blog_post->getId(),
				'options' => array('width' => 150, 'height' => 110, 'resizeType' => 'c', 'arrows' => false )
			)) ?>
		</div>
	<?php else: ?>
	  <ul class="a-blog-post-media">
	  <?php foreach ($a_blog_post->getAttachedMedia() as $media): ?>
	    <li><?php echo image_tag(str_replace(
	      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
	      array('120', '90', 'c', 'jpg',),
	      $media->image
	    )) ?></li>
	  <?php endforeach ?>
	  </ul>
  <?php endif ?>
<?php endif ?>

	<div class="a-blog-post-excerpt-container">
	<?php if (str_word_count(strip_tags($a_blog_post->getBody())) > 30): ?>
		<?php echo ($a_blog_post->getExcerpt()) ? $a_blog_post->getExcerpt() : $a_blog_post->getPreview(30) ?>
		<div class="a-blog-read-more"><?php echo link_to('Read More', 'a_blog_post', $a_blog_post, array('class' => 'a-blog-more')) ?></div>
	<?php else: ?>
		<?php echo ($a_blog_post->getBody()) ?>
	<?php endif ?>
	</div>
</div>
<?php endif ?>