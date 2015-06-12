<?php get_header(); ?>

	<div id="primary" class="grid">
			<header class="entry-header">
				<div class="row">
					<div class="c12 end">
						<h1 class="tera"><?php _e( '404', 'zoo' ); ?></h1>
						<h1 class="entry-title"><span class="accent"><?php _e("Oops! That page can't be found.", 'zoo'); ?></span></h1>
					</div>
				</div>
				<div class="row">
					<div class="c12 end">
						<nav id="nav-above">
							<?php dimox_breadcrumbs(); ?>
						</nav>
					</div>
				</div>	
			</header>


			<article id="post-0" class="post error404 not-found">
				<div class="row">
					<div class="c12 end">
						<?php get_search_form(); ?>
					</div>
				</div>
				<div class="row">
					<div class="c12 end">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'zoo' ); ?></p>
					</div>
				</div>	
			</article>

	</div>

<?php get_footer(); ?>