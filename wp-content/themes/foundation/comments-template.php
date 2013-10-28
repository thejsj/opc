<li <?php comment_class(); ?>>

<?php // COMMENT META
	$datetime = get_comment_time();
	$date = date('F j, Y', strtotime($datetime));
	$time = date('g:i A', strtotime($datetime));
	$timestamp = $date . ' at ' . $time;
?>

<?php if ($comment->comment_approved == '0') : ?>
	<div class="alert-message success">
		<p><?php _e('Your comment is awaiting moderation.') ?></p>
	</div>
<?php endif; ?>	
	<article id="comment-<?php comment_ID(); ?>" class="clearfix">
		<div class="clearfix">				
			<div class="comment-avatar-block">
				<?php echo get_avatar($comment,$size='60',$default=get_bloginfo('template_directory') . '/img/default-avatar.png' ); ?>
			</div>				
			<div class="comment-body-block">
				<div class="comment-meta clearfix">
					<ul>
						<li>
							<h4><?php echo get_comment_author_link(); ?> <?php edit_comment_link(__('Edit Comment <span class="sosa-icon">&grave;</span>'),'<span>', '</span>'); ?></h4>
						</li>
						<li class="divider">//</li>
						<li>
							<time datetime="<?php echo $datetime; ?>" class="clearfix"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php echo $timestamp; ?></a></time>
						</li>
					</ul>
				</div>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
				<?php // comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	</article>
<!-- 
</li> is added by wordpress automatically 
-->
