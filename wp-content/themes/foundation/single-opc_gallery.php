<?php get_header(); ?>	

<section class="container">	
	<!-- Post Content - Begin -->
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : ?>
			<?php the_post(); ?> 
			
			<article class="content list-content">
				<!-- Title -->
				<h2><?php the_title();?></h2>
				<!-- Date, Author and Categories -->
				<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  

				<div class='main_gallery_container'>
					<?php echo get_acf_gallery_shortcode(get_the_ID()); ?>
				</div>
				</div>
				<?php the_content(); ?>
			</article>

		<?php endwhile; ?>
		<nav class="post-nav">
			<?php next_post_link('%link', '&lsaquo; &lsaquo;'); ?>
			<?php previous_post_link('%link', '&rsaquo; &rsaquo;'); ?>
		</nav>				
	<?php endif;?>
	<!-- Post Conent - End -->
</section>
<?php get_footer(); ?>