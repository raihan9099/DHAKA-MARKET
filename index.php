<?php get_header(); ?>
<main>
  <h1><?php bloginfo('name'); ?></h1>
  <p><?php bloginfo('description'); ?></p>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <article>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div><?php the_excerpt(); ?></div>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p><?php _e('No posts found', 'dhaka-market'); ?></p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
