<?php  if (sfConfig::get('app_aBlog_disqus_enabled', true)):?>
<script type="text/javascript">
var disqus_shortname = "<?php echo $disqus_shortname ?>";
console.log(disqus_shortname);
(function () {
  var s = document.createElement('script'); s.async = true;
  s.src = "http://disqus.com/forums/"+disqus_shortname+"/count.js";
  (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>
<?php endif ?>