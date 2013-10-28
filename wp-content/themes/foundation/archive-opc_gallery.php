<?php get_header(); ?>	
<!-- PAGE WRAP BEGINS -->
<section class="container">	

	<!-- Show Post Type Title -->
	<?php if ( is_post_type_archive() ) { ?>
		<h1><?php post_type_archive_title(); ?></h1>
	<?php } ?>

	<!-- Show Posts -->
	<div class='posts_container'>
	<?php if(have_posts()) : ?>				
		
		<!-- Post List Begin -->
		<?php while(have_posts()) : ?>
			<?php the_post(); ?> 						
			<article class="content list-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				<?php $images = get_acf_gallery_images(get_the_ID()); ?>
				<div class='images'>
					<ul>
					<?php foreach($images as $image) : ?>
						<li><img src="<?php echo $image->src; ?>" alt="<?php echo $image->alt; ?>"></li>
					<?php endforeach; ?>
					</ul>
				</div>
				<?php the_excerpt(); ?>
			</article>
		<?php endwhile; ?>
		<!-- Post List End -->
		
		<nav class="post-list-nav">
			<?php pagination('&lsaquo;&lsaquo;', '&rsaquo;&rsaquo;'); ?>
		</nav>
	<?php else : ?>
		<h2>Sorry!</h2>
		<p>No posts have been published just yet.</p>	
	<?php endif;?>
	</div>
</section>
<?php get_footer(); ?>