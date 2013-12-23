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
			<div class="content span12">
				<div class="blog-masonry row isotope">	
				<!-- Post List Begin -->
				<?php if(have_posts()) : ?>		
					<?php while(have_posts()) : ?>
						<?php the_post(); ?> 						
						<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-uncategorized blog-post post-grid span4 isotope-item" id="post-<?php the_ID(); ?>">
							<div class="post-images">
								<?php if(get_communicados_featured_image(get_the_ID(), 'small')): ?>
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo get_communicados_featured_image(get_the_ID(), 'small'); ?>" alt='<?php the_title();?>'>
									</a>
								<?php elseif(get_communicados_featured_image(get_the_ID(), 'full')): ?>
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo get_communicados_featured_image(get_the_ID(), 'full'); ?>" alt='<?php the_title();?>'>
									</a>
								<?php endif; ?>
								<div class="blog-mask">
									<div class="mask-content">
										<a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
									</div>
								</div>
								
							</div>	
							<div class="post-information ">
								<h4 class="post-title">
									<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
								</h4>
								<div class="post-info">
									<span class="posted-on">Posted on October 24, 2013 at 3:45 am</span> 
									<span class="posted-by"> by <?php the_author(); ?>	
								</div>
								<div class="post-description"><?php the_excerpt(); ?></div>
								<div class="clear"></div>
							</div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<h2>Sorry!</h2>
					<p>No communicados have been published just yet.</p>	
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



					
