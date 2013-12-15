<?php
/**
 * The template for displaying posts in the Chat post format.
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('panel ' . rainbowstrap_post_panel_style()); ?>>

  <header class="entry-header panel-heading">
    <?php if ( is_single() ) : ?>
      <h1 class="entry-title">
        <span class="glyphicon glyphicon-comment left"></span>
        <span class="title-container left"><?php the_title(); ?></span>
        <span class="clearfix"></span>
      </h1>
    <?php else : ?>
      <h1 class="entry-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark">
          <span class="glyphicon glyphicon-comment left"></span>
          <span class="title-container left"><?php the_title(); ?></span>
          <span class="clearfix"></span>
        </a>
      </h1>
    <?php endif;?>
  </header>
  <header class="panel-heading entry-header">
    <?php rainbowstrap_entry_meta(); ?>
    <?php rainbowstrap_edit_link(); ?>
  </header>

  <div class="entry-content panel-body">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rainbowstrap' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
  </div><!-- .entry-content -->

  <?php if(rainbowstrap_entry_has_tags()) : ?>
    <footer class="panel-footer entry-meta">
      <div class="row">
        <div class="col-md-12">
          <?php rainbowstrap_entry_tags(); ?>
        </div>
      </div>
    </footer>
  <?php endif;?>
</article><!-- #post -->
