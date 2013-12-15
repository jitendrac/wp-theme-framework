<?php
/**
 * The template for displaying posts in the Link post format.
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('panel ' . rainbowstrap_post_panel_style()); ?>>

  <header class="entry-header panel-heading">
    <h1 class="entry-title">
      <a href="<?php echo esc_url( rainbowstrap_get_link_url() ); ?>">
        <span class="glyphicon glyphicon-link left"></span>
        <span class="title-container left"><?php the_title(); ?></span>
        <span class="clearfix"></span>
      </a>
    </h1>
  </header>

  <footer class="panel-footer entry-meta">
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
</article><!-- #post -->
