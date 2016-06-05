<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */

get_header(); ?>

	<!-- BLOG PAGE -->
	<section class="blog-page">
		<div class="site-content">
			<div class="main-content">
				
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

				<article class="post-entry individual-post">
					<div class="entry-wrap">
						<header class="entry-header">
							<div class="entry-meta">
								<time class="entry-time"><?php the_date(); ?></time>
							</div>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>
						<div class="entry-summary">
							<?php the_content(); ?>
						</div>
						<footer class="entry-footer">
							<div class="entry-meta">
								<span class="entry-terms author">Written by <?php the_author_posts_link(); ?></span>
								<span class="entry-terms category">Posted in <?php the_category(', '); ?></span>
								<span class="entry-terms comments"><?php comments_number( 'No comments yet!', '1 comment', '% comments' ); ?></span>
							</div>
						</footer>
					</div>
				</article>

				<div class="comments-area">
					<h3 class="comments-title">no comments</h2>
					<div class="comment-respond">
						<h3 class="comment-reply-title">Leave a comment</h3>
						<form action="" method="post" id="commentform" class="comment-form default-form">
							<div class="form-author">
								<label for="author">Name</label> 
								<input id="author" name="author" type="text" value="" aria-required="true">
							</div>
							<div class="form-email">
								<label for="email">Email <span>(hidden)</span></label> 
								<input id="email" name="email" type="email" value="" aria-required="true">
							</div>
							<div class="form-comment">
								<label for="comment">Your comment</label> 
								<textarea id="comment" name="comment" rows="8" aria-required="true"></textarea>
							</div>						
							<input name="submit" type="submit" id="submit" class="submit" value="Post Comment">
						</form>
					</div>
				</div>

			</div>

			<?php get_sidebar(); ?>

			<footer class="navigation container">
				<div class="left">&larr;<a href="<?php echo home_url(); ?>/blog">back to posts</a></div>
			</footer>
	
		</div>
	</section>
	
				<?php endwhile; ?>

<?php
get_footer();