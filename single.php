<?php
/**
 * The Template for displaying all single posts.
 *
 * @package blanq
 * @since blanq 1.0
 */

get_header(); ?>

<div class="container">
  <div class="row">

		<div id="primary" class="content-area span8">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php blanq_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php blanq_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>

  </div><!-- /row -->
</div><!-- /container -->

<?php get_footer(); ?>