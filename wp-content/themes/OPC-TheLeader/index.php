<?php get_header(); ?>	
<!-- PAGE WRAP BEGINS -->
<section class="container">	

	<!-- POST LIST BEGINS -->
	<h1>BLOG</h1>
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : ?>
			<?php the_post(); ?> 						
			<article class="content list-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				<?php the_excerpt(); ?>
			</article>
		<?php endwhile; ?>
		<nav class="post-list-nav">
			<?php pagination('&lsaquo;&lsaquo;', '&rsaquo;&rsaquo;'); ?>
		</nav>	
	<?php else : ?>
		<h2>Sorry!</h2>
		<p>No posts have been published just yet.</p>	
	<?php endif;?>
	<!-- POST LIST ENDS -->

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

</section>
<?php get_footer(); ?>