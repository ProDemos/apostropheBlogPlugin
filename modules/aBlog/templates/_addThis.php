<?php if ($addthis_username = sfConfig::get('app_aBlog_add_this')): ?>
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style">
		<a href="http://addthis.com/bookmark.php?v=250&amp;username=<?php echo $addthis_username ?>" class="addthis_button_compact"
		addthis:url="url to blog engine show success"
		addthis:title="blog title"
		addthis:description="Excerpt from the blog">Share</a>
		<span class="addthis_separator">|</span>
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_myspace"></a>
		<a class="addthis_button_google"></a>
		<a class="addthis_button_twitter"></a>
	</div>
	<!-- AddThis Button END -->	
<?php endif ?>
<?php use_javascript('http://s7.addthis.com/js/250/addthis_widget.js#username='.$addthis_username) ?>