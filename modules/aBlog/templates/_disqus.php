<div id="disqus_thread"></div>
<?php if ($disqus_shortname = sfConfig::get('app_aBlog_disqus_shortname')): ?>
<script type="text/javascript">

  var disqus_identifier = <?php echo($id)?>;

  (function() {
   var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
   dsq.src = "http://<?php echo $disqus_shortname?>.disqus.com/embed.js";
   (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=<?php echo $disqus_shortname ?>">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
<?php endif ?>