<?php get_header(); ?>	

<section class="container">	

	<!-- Post Content - Begin -->
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : ?>
			<?php the_post(); ?> 
			
			<article class="content list-content">
				<!-- Title -->
				<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				<!-- Date, Author and Categories -->
				<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  
				<p>Categorias: <?php the_category(', '); ?></p>
				<!-- Featured Image -->
				<div class='featured_image'>
					<img src='<?php echo get_communicados_featured_image(get_the_ID(), 'small'); ?>' alt='<?php the_title();?>' />
				</div>
					
				<!-- The Content -->
				<?php the_content(); ?>

				<!-- Get Communicados Links -->
				<?php $links = get_comminucado_download_links(get_the_ID()); ?>
				<?php if($links): ?>
					<?php foreach($links as $link): ?>
						<a class='document_link <?php echo $link->type; ?>' href='<?php echo $link->href; ?>'>Download <?php echo $link->type; ?></a>
					<?php endforeach; ?>
				<?php endif; ?>
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