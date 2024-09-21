<?php

if (!defined('ABSPATH')) {
	exit;
}

get_header(); ?>
<main id="main" class="<?php get_post_class(); ?>">
	<?php the_content(); ?>
</main>

<?php get_footer();