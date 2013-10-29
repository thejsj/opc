<?php get_header(); ?>	
<!-- Page Content Beging -->
<?php if(have_posts()) : ?>
	<?php while(have_posts()) : ?>
		<?php the_post(); ?> 
			<div class="page-heading">
				<div class="container">
					<div class="row-fluid">
						<div class="span8 content text-center">
							<h1><?php the_title();?></h1>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="page-content sidebar-position-without responsive-sidebar-bottom">
					<div class="row">
						<div class="content span12">
							<div class="">
								<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-uncategorized blog-post" id="post-<?php the_ID(); ?>">
									<h3 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
									</h3>
									<div class="post-info">
										<!-- Date, Author and Categories -->
										<?php the_date( 'j/m/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  
										<?php echo_the_categories(); ?>
									</div>
									<div class='featured_image'>
									<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
										the_post_thumbnail(); } ?>
									</div>
									<div class="post-description">
										<?php the_content(); ?>
									</div>
									<div class="clear"></div>
								</article>
							</div>
							<div class="articles-nav">
								<div class="left"><?php next_post_link('%link', '&lsaquo; &lsaquo; Entrada siguiente'); ?></div>
								<div class="right"><?php previous_post_link('%link', 'Entrada anterior &rsaquo; &rsaquo;'); ?></div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php endwhile; ?>
<?php endif;?>
<!-- Page Content End -->
<?php // get_sidebar(); ?>
<?php get_footer(); ?>
