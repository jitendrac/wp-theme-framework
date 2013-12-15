<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('panel ' . rainbowstrap_post_panel_style()); ?>>

  <div class="entry-content panel-body">
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rainbowstrap' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rainbowstrap' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
  </div>

  <footer class="entry-meta panel-footer">
    <div class="row">
      <div class="col-md-12">
        <?php rainbowstrap_entry_meta(); ?>
        <?php rainbowstrap_edit_link(); ?>
      </div>
    </div>
  </footer>

  <?php if(rainbowstrap_entry_has_tags()) : ?>
    <footer class="panel-footer entry-meta">
      <?php if(rainbowstrap_entry_has_tags()) : ?>
        <div class="row">
          <div class="col-md-12">
            <?php rainbowstrap_entry_tags(); ?>
          </div>
        </div>
      <?php endif;?>
    </footer>
  <?php endif;?>

  <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
    <footer class="panel-footer entry-meta">
      <div class="row">
        <div class="col-md-12">
          <?php get_template_part( 'author-bio' ); ?>
        </div>
      </div>
    </footer>
  <?php endif; ?>
</article>
