<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>
<section id="comments-wrap">
	<!-- COMMENTS LIST BEGINS -->			
	<section class="comments-block clearfix">
		<?php if(have_comments()) : ?>
			<div id="comments-block-header">
				<h2><?php comments_number('Be the first to comment', 'One Comment', 'Comments (%)' );?></h2>
			</div>
			<hr/>				
			<div class="comments-list">
				<ol>
					<?php $comment_count = 0; ?>
					<?php wp_list_comments('type=comment&callback=custom_comments'); $comment_count++; ?>
				</ol>
			</div>
		<?php else : ?>
			<?php if(comments_open()) : ?>
				<div id="comments-block-header">
					<h2><?php comments_number('Be the first to comment', 'One Comment', 'Comments (%)' );?></h2>
				</div>
			<?php else : ?>
				<div id="comments-block-header">
					<h2>Comments are closed.</h2>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</section>
	<!-- COMMENTS LIST ENDS -->	
	<!-- COMMENT SUBMISSION BEGINS-->
	<section class="response-block clearfix">
		<?php if(comments_open()) : ?>
			<div id="respond">
				<h3><?php comment_form_title( 'Leave a Reply', 'Reply to %s' ); ?></h3>
				<div class="cancel-comment-reply">
					<?php cancel_comment_reply_link(); ?>
				</div>
					<?php if(get_option('comment_registration') && !is_user_logged_in()) : ?>
						<p>You must be <a href="<?php echo wp_login_url(get_permalink()); ?>">logged in</a> to post a comment.</p>
					<?php else : ?>
						<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
						<?php if(is_user_logged_in()) : ?>
							<p class="logged-in-notice">You are currently logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.</p>
						<?php else : ?>
							<div class="comment-form clearfix">
								<label for="author">Name<?php if ($req) echo "<span> *</span>"; ?></label>
								<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />							
							</div>
							<div class="comment-form clearfix">
								<label for="email">Email<?php if ($req) echo "<span> *</span>"; ?></label>
								<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
							</div>
						<?php endif; ?>
						<div class="comment-textarea clearfix">
							<label for="comment">Comment<?php if ($req) echo "<span> *</span>"; ?></label>
							<textarea name="comment" id="comment" cols="58" rows="6" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?>></textarea>			
						</div>
						<div>
							<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
							<?php comment_id_fields(); ?>
						</div>	
						<?php do_action('comment_form', $post->ID); ?>
					</form>
					<?php endif; // If registration required and not logged in ?>	
			</div>
		<?php endif; ?>
	</section>
	<!-- COMMENT SUBMISSION ENDS -->
</section>