<?php get_header(); ?>	
<!-- Page Content Beging -->
<?php if(have_posts()) : ?>
	<?php while(have_posts()) : ?>
		<?php the_post(); ?> 
			<div class="page-heading">
				<div class="container">
					<div class="row-fluid">
						<div class="span8 content text-center">
							<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h1>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="page-content sidebar-position-without responsive-sidebar-bottom">
					<div class="row">
						<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-uncategorized blog-post communicado" id="post-<?php the_ID(); ?>">
						<?php if(has_communicado_image(get_the_ID())) : ?>
							<div class="content span10 text-center">
								<div class="container">
									<div class="row">
										<!-- Display Image to the Left -->
										<div class='content span4'>
											<div class='featured-image'>
												<img src='<?php echo get_communicados_featured_image(get_the_ID(), 'medium'); ?>' alt='<?php the_title();?>' />
											</div>
										</div>
										<!-- Display Content to the left -->
										<div class='content span6'>
											<div class="post-info">
												<!-- Date, Author and Categories -->
												<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  
												<p>Categorias: <?php the_category(', '); ?></p>
											</div>
											<div class="post-description">
												<?php the_content(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php else: ?>
							<!-- Only Display content -->
							<div class="content span10 text-center">
								<div class="post-info">
									<!-- Date, Author and Categories -->
									<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  
									<p>Categorias: <?php the_category(', '); ?></p>
								</div>
								<div class="post-description">
									<?php the_content(); ?>
								</div>
							</div>
						<?php endif; ?>
						</article>
						<div class="content span8 text-center">
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
