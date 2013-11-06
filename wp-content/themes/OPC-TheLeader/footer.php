	<!-- FOOTER BEGINS -->
	<div class="copyright">
		<div class="container">
			<div class="row-fluid">
				<div class="span6">
					<p>&copy; <?php echo copyright(2013); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
				<div class="span6 a-right">
					<a class='social-media-link ' href='<?php echo get_social_media_links('facebook'); ?>'>
					<img src='<?php bloginfo('template_url'); ?>/img/clean-icon-set/facebook.png'>
					</a>
					<a class='social-media-link ' href='<?php echo get_social_media_links('twitter'); ?>'>
						<img src='<?php bloginfo('template_url'); ?>/img/clean-icon-set/twitter.png'>
					</a>
					<a class='social-media-link ' href='<?php echo get_social_media_links('youtube'); ?>'>
						<img src='<?php bloginfo('template_url'); ?>/img/clean-icon-set/youtube.png'>
					</a>
					<a class='' href='<?php the_permalink(952); ?>'>Contáctenos</a>
				</div>
			</div>
		</div>
	</div>
	<!-- FOOTER ENDS -->
</div><!-- END .page -->

<div class="back-to-top hidden-phone hidden-tablet" style="display: block;">
	<i class="icon-chevron-up"></i>
	<span>Back to top</span>
</div>


<?php wp_footer(); ?>
<!-- DON'T FORGET ANALYTICS -->
<!--
	<script>
	  var _gaq=[['_setAccount','UA-35795719-1'],['_trackPageview']];
	  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	  s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
-->  
</body>
</html>