<?php get_header(); ?>	
<!-- PAGE WRAP BEGINS -->
<section class="container">	

	<!-- PAGE CONTENT BEGINS -->
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : ?>
			<?php the_post(); ?> 
			
			<section class="content page-content">
				<h2><?php the_title();?></h2>
				<?php the_content(); ?>
			</section>
			
		<?php endwhile; ?>
	<?php endif;?>
	<!-- PAGE CONTENT ENDS -->

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>