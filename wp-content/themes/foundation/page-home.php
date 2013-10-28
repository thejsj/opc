<?php 
/*

Template Name: Home Page

*/
get_header(); ?>	
<!-- PAGE WRAP BEGINS -->
<section class="container home-container">	

	<h2 class='comunicaos_title'>Nuestros Últimos Comunicados</h2>
	<?php $the_query = get_latest_communicados(); ?>
	<!-- List of Communicados Beging -->
	<?php if ( $the_query->have_posts() ) : ?>
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : ?>
		<?php $the_query->the_post(); ?>
			
			<section class="content page-content">
				<h3><?php the_title();?></h3>
				<div class='featured_image'>
					<img src='<?php echo get_communicados_featured_image(get_the_ID(), 'small'); ?>' alt='<?php the_title();?>' />
				</div>
				<?php the_excerpt(); ?>
			</section>

		<?php endwhile; ?>
		<!-- end of the loop -->
	<!-- pagination here -->
	<?php wp_reset_postdata(); ?>
	<?php else:  ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	----

	<!-- List all Sponsors -->
	<?php $ordered_posts = get_sponsors(); ?>
	<?php $sponsor_types = get_sponsor_types(); ?>
	<?php foreach($ordered_posts as $key => $category){ ?>
	<div class="sponsor_container">
		<h3><?php echo $sponsor_types[$key]; ?></h3>
		<?php foreach($category as $post){ ?>
		<div class="single_sponsor">
			<h4><?php echo $post->post_title; ?><h4>
			<img height='50' src='<?php echo $post->sponsor_image; ?>' >
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<!-- End Sponsors -->

	<!-- List all videos -->
	<?php $all_videos = get_videos(5); ?>
	<div class="video_container">
		<h3>OPC Videos</h3>
		<?php foreach($all_videos as $post){ ?>
		<div class="single_video">
			<h4><?php echo $post->post_title; ?><h4>
			<?php echo generate_youtube_embed_code($post->youtube_id); ?>
		</div>
		<?php } ?>
	</div>
	<!-- End List al videos -->

	<?php echo get_social_media_links('facebook'); ?>
	<?php echo get_social_media_links('twitter'); ?>
	<?php echo get_social_media_links('youtube'); ?>

</section>
<?php get_footer(); ?>