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
				<!-- Show Posts -->
				<?php if(have_posts()) : ?>		
					<div class="">	
					<!-- Post List Begin -->
					<?php while(have_posts()) : ?>	
						<?php the_post(); ?> 						
						<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-uncategorized blog-post linear-layout" id="post-<?php the_ID(); ?>">
						<h3 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post-info">
							<!-- Date, Author and Categories -->
							<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  
							<p>Categorias: <?php the_category(', '); ?></p>
						</div>
						<div class="post-images nav-type-small span2">
							<?php $images = get_acf_gallery_images(get_the_ID()); ?>
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $images[0]->src; ?>" alt="<?php echo $image[0]->alt; ?>" />
							</a>
							<div class="blog-mask">
								<div class="mask-content">
									<a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
								</div>
							</div>
						</div>	
						<div class="post-description"><?php the_excerpt(); ?></div>
						<div class="clear"></div>
					</article>		
					<?php endwhile; ?>
					<!-- Post List End -->
					</div>
					<div class="articles-nav">
						<?php pagination('&lsaquo;&lsaquo;', '&rsaquo;&rsaquo;'); ?>
						<div class="left"></div>
						<div class="right"></div>
						<div class="clear"></div>
					</div>
				<?php else : ?>
					<h2>Sorry!</h2>
					<p>No posts have been published just yet.</p>	
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>