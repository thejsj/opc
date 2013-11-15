<?php 
/*

Template Name: Home Page

*/
get_header(); ?>	
<!-- PAGE WRAP BEGINS -->
<section class="container home-container">	
	<!-- List of Communicados Begins -->
	<div class="page-content sidebar-position-without responsive-sidebar-bottom">
		<div class="row">
			<div class="content span9 text-center">
				<h2 class='comunicados-title'><?php echo get_custom_text('home_page_communicados_text'); ?></h2>
				<?php $the_query = get_latest_communicados(); ?>
				<!-- Show Posts -->
				<?php if($the_query->have_posts()) : ?>		
					<div class="all-posts">	
					<!-- Post List Begin -->
					<?php while($the_query->have_posts()) : ?>
						<?php $the_query->the_post(); ?> 						
						<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-uncategorized blog-post linear-layout" id="post-<?php the_ID(); ?>">
						<h3 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post-info">
							<!-- Date, Author and Categories -->
							<?php the_date( 'm/j/y', 'Publicado: ' ); ?> <?php echo opc_get_the_author($post->post_author, 'por '); ?>  
							<?php echo_the_categories();?>
						</div>
						<div class="post-images nav-type-small span2">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo get_communicados_featured_image(get_the_ID(), 'small'); ?>" alt='<?php the_title();?>'>
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
						<div class="left"></div>
						<div class="right"></div>
						<div class="clear"></div>
					</div>
				<?php else : ?>
					<h2>Sorry!</h2>
					<p>No posts have been published just yet.</p>	
				<?php endif;?>
				<!-- List all Sponsors -->
				<div class="all-sponsors">
					<?php $ordered_posts = get_sponsors(); ?>
					<?php $sponsor_types = get_sponsor_types(); ?>
					<?php foreach($ordered_posts as $key => $category){ ?>
					<div class="sponsor-container">
						<h3><?php echo get_custom_text('home_page_sponsor_' . $key) ?></h3>
						<?php foreach($category as $post){ ?>
						<div class="single-sponsor">
							<h4><?php echo $post->post_title; ?><h4>
							<div class="img-container">
								<img src='<?php echo $post->sponsor_image; ?>' >
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<!-- End Sponsors -->
			</div>			
		</div>
	</div>	

	<!-- List all videos -->
	<div class="page-content video-container">
		<div class="row">
			<div class="content span9 text-center">
				<h3><?php echo get_custom_text('home_page_videos_title'); ?></h3>
			</div>
			<div class="content span9 text-center">
				<div class="row">
				<?php $all_videos = get_videos(5); ?>
				<?php foreach($all_videos as $post){ ?>

					<div class="single-video span2">
						<?php echo generate_youtube_embed_code($post->youtube_id, 200, 160); ?>
						<h4><?php echo $post->post_title; ?></h4>
					</div>
				
				<?php } ?>
				</div>
				<!-- End List al videos -->
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>