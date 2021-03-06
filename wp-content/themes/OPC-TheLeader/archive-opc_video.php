<?php get_header(); ?>	
<!-- Show Post Type Title -->
<?php if ( is_post_type_archive() ) { ?>
	<div class="page-heading">
		<div class="container">
			<div class="row-fluid">
				<div class="span8 content text-center">
					<h1><?php post_type_archive_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<!-- Show Posts -->
		
<div class="container">
	<div class="page-content sidebar-position-without responsive-sidebar-bottom">
		<div class="row">
			<div class="content span8 text-center">
				<div class="">
				<!-- Post List Begin -->
				<?php if(have_posts()) : ?>		
					<?php while(have_posts()) : ?>
						<?php the_post(); ?> 						
						<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-uncategorized blog-post" id="post-<?php the_ID(); ?>">
							<h3 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
							</h3>
							<div class="post-info">
								<!-- Date, Author and Categories -->
								<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?> 
							</div>
							<div class='video'>
								<?php echo generate_youtube_embed_code(get_post_meta(get_the_ID(), 'youtube_id', true), 450, 270); ?>
							</div>
							<div class="post-description"><?php the_excerpt(); ?></div>
							<div class="clear"></div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<h2>Sorry!</h2>
					<p>No posts have been published just yet.</p>	
				<?php endif;?>
				<!-- Post List End -->
				</div>
				<div class="articles-nav">
					<?php pagination('&lsaquo;&lsaquo;', '&rsaquo;&rsaquo;'); ?>
					<div class="left"></div>
					<div class="right"></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>


