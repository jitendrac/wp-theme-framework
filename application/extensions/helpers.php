<?php

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Rainbow strap 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function rainbowstrap_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'rainbowstrap' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'rainbowstrap_wp_title', 10, 2 );

if ( ! function_exists( 'rainbowstrap_paging_nav' ) ) :
  /**
   * Displays navigation to next/previous set of posts when applicable.
   *
   * @since Rainbow strap 1.0
   *
   * @return void
   */
  function rainbowstrap_paging_nav() {
    global $wp_query;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 )
      return;
    ?>
    <ul class="pager">
      <?php if ( get_next_posts_link() ) : ?>
        <li class="previous text-primary"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'rainbowstrap' ) ); ?></li>
      <?php else : ?>
        <li class="previous disabled"><a><?php echo __( '<span class="meta-nav">&larr;</span> Older posts', 'rainbowstrap' ); ?></a></li>
      <?php endif; ?>

      <?php if ( get_previous_posts_link() ) : ?>
        <li class="next text-primary"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'rainbowstrap' ) ); ?></li>
      <?php else : ?>
        <li class="next disabled"><a><?php echo __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'rainbowstrap' ); ?></a></li>
      <?php endif; ?>
    </ul>
  <?php
  }
endif;

if ( ! function_exists( 'rainbowstrap_post_nav' ) ) :
  /**
   * Displays navigation to next/previous post when applicable.
   *
   * @since Rainbow strap 1.0
   *
   * @return void
   */
  function rainbowstrap_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
      return;
    ?>
    <ul class="pager">
      <li class="previous text-primary">
        <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'rainbowstrap' ) ); ?>
      </li>
      <li class="next text-primary">
        <?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'rainbowstrap' ) ); ?>
      </li>
    </ul>
  <?php
  }
endif;

if ( ! function_exists( 'rainbowstrap_post_panel_style' ) ) :

  function rainbowstrap_post_panel_style() {
    return ( is_sticky() && is_home() && ! is_paged()) ? 'panel-primary' : 'panel-default';
  }

endif;

if( ! function_exists('rainbowstrap_entry_has_tags')) :

  function rainbowstrap_entry_has_tags() {
    $tag_list = get_the_tags();
    return ( $tag_list );
  }

endif;

if( ! function_exists('rainbowstrap_entry_tags')) :

  function rainbowstrap_entry_tags() {
    $tag_list = get_the_tags();
    if ( $tag_list ) {
      echo '<div class="post-tags-list">';

      foreach($tag_list as $tag)
        echo '<span><a class="label label-info" href="' . home_url( '/' ) . '?tag=' . $tag->slug . '">' . $tag->name . '</a></span>';

      echo '</div>';
    }
  }

endif;

if ( ! function_exists( 'rainbowstrap_entry_meta' ) ) :
  /**
   * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
   *
   * Create your own rainbowstrap_entry_meta() to override in a child theme.
   *
   * @since Rainbow strap 1.0
   *
   * @return void
   */
  function rainbowstrap_entry_meta() {
    if ( 'post' == get_post_type() ) {
      rainbowstrap_entry_date();

      printf( '<span class="author vcard text-primary">
                  <a class="url fn n" href="%1$s" title="%2$s" rel="author">
                    <span class="glyphicon glyphicon-user"></span>
                    %3$s
                  </a>
               </span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'rainbowstrap' ), get_the_author() ) ),
        get_the_author()
      );
    }
  }
endif;

if( !function_exists('rainbowstrap_edit_link') ) :

  function rainbowstrap_edit_link(){
    edit_post_link( __( 'Edit', 'rainbowstrap' ), '<span class="edit-link text-primary"><span class="glyphicon glyphicon-pencil"></span>&nbsp;', '</span>' );
  }

endif;

if( !function_exists('rainbowstrap_comments_information') ) :

  function rainbowstrap_comments_information(){
     if ( comments_open() && ! is_single() ) {
      echo '<span class="comments-link text-primary">';
      echo '<span class="glyphicon glyphicon-comment"></span>&nbsp;';
       comments_popup_link(
         __( 'Leave a comment', 'rainbowstrap' ),
         __( 'One comment so far', 'rainbowstrap' ),
         __( 'View all % comments', 'rainbowstrap' )
       );
      echo '</span>';
     }
  }

endif;

if ( ! function_exists( 'rainbowstrap_entry_date' ) ) :
  /**
   * Prints HTML with date information for current post.
   *
   * Create your own rainbowstrap_entry_date() to override in a child theme.
   *
   * @since Rainbow strap 1.0
   *
   * @param boolean $echo Whether to echo the date. Default true.
   * @return string The HTML-formatted post date.
   */
  function rainbowstrap_entry_date( $echo = true ) {
    if ( has_post_format( array( 'chat', 'status' ) ) )
      $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'rainbowstrap' );
    else
      $format_prefix = '%2$s';

    $date = sprintf(
      '<span class="date text-primary">
        <span class="glyphicon glyphicon-calendar"></span>
        <a href="%1$s" title="%2$s" rel="bookmark">
          <time class="entry-date" datetime="%3$s">%4$s</time>
        </a>
      </span>',
      esc_url( get_permalink() ),
      esc_attr( sprintf( __( 'Permalink to %s', 'rainbowstrap' ), the_title_attribute( 'echo=0' ) ) ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
    );

    if ( $echo )
      echo $date;

    return $date;
  }
endif;

if ( ! function_exists( 'rainbowstrap_the_attached_image' ) ) :
  /**
   * Prints the attached image with a link to the next attached image.
   *
   * @since Rainbow strap 1.0
   *
   * @return void
   */
  function rainbowstrap_the_attached_image() {
    $post                = get_post();
    $attachment_size     = apply_filters( 'rainbowstrap_attachment_size', array( 724, 724 ) );
    $next_attachment_url = wp_get_attachment_url();

    /**
     * Grab the IDs of all the image attachments in a gallery so we can get the URL
     * of the next adjacent image in a gallery, or the first image (if we're
     * looking at the last image in a gallery), or, in a gallery of one, just the
     * link to that image file.
     */
    $attachment_ids = get_posts( array(
      'post_parent'    => $post->post_parent,
      'fields'         => 'ids',
      'numberposts'    => -1,
      'post_status'    => 'inherit',
      'post_type'      => 'attachment',
      'post_mime_type' => 'image',
      'order'          => 'ASC',
      'orderby'        => 'menu_order ID'
    ) );

    // If there is more than 1 attachment in a gallery...
    if ( count( $attachment_ids ) > 1 ) {
      foreach ( $attachment_ids as $attachment_id ) {
        if ( $attachment_id == $post->ID ) {
          $next_id = current( $attachment_ids );
          break;
        }
      }

      // get the URL of the next image attachment...
      if ( $next_id )
        $next_attachment_url = get_attachment_link( $next_id );

      // or get the URL of the first image attachment.
      else
        $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }

    printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
      esc_url( $next_attachment_url ),
      the_title_attribute( array( 'echo' => false ) ),
      wp_get_attachment_image( $post->ID, $attachment_size )
    );
  }
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Rainbow strap 1.0
 *
 * @return string The Link format URL.
 */
function rainbowstrap_get_link_url() {
  $content = get_the_content();
  $has_url = get_url_in_content( $content );

  return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Rainbow strap 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function rainbowstrap_body_class( $classes ) {
  if ( ! is_multi_author() )
    $classes[] = 'single-author';

  if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
    $classes[] = 'sidebar';

  if ( ! get_option( 'show_avatars' ) )
    $classes[] = 'no-avatars';

  return $classes;
}
add_filter( 'body_class', 'rainbowstrap_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Rainbow strap 1.0
 *
 * @return void
 */
function rainbowstrap_content_width() {
  global $content_width;

  if ( is_attachment() )
    $content_width = 724;
  elseif ( has_post_format( 'audio' ) )
    $content_width = 484;
}
add_action( 'template_redirect', 'rainbowstrap_content_width' );

if ( ! function_exists( 'rainbowstrap_comment' ) ) :
  function rainbowstrap_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
        // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'rainbowstrap' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'rainbowstrap' ), '<span class="edit-link">', '</span>' ); ?></p>
        </li>
        <?php
        break;
      default :
        // Proceed with normal comments.
        global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
          <div id="comment-<?php comment_ID(); ?>" class="media comment">
            <div class="pull-left">
              <?php echo get_avatar( $comment, 64 );?>
            </div>

            <div class="media-heading">
              <h4 class="media-heading text-primary">
                <?php echo get_comment_author_link();?>
              </h4>
            </div>

            <div class="media-body">
              <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="alert alert-warning"><?php _e( 'Your comment is awaiting moderation.', 'rainbowstrap' ); ?></p>
              <?php endif; ?>
              <div class="comment-content">
                <?php comment_text(); ?>
              </div>

              <div class="right">
                <?php
                printf( '<a href="%1$s" class="text-primary">
                <span class="glyphicon glyphicon-calendar"></span>
                <time datetime="%2$s">%3$s</time></a>',
                  esc_url( get_comment_link( $comment->comment_ID ) ),
                  get_comment_time( 'c' ),
                  /* translators: 1: date, 2: time */
                  sprintf( __( '%1$s at %2$s', 'rainbowstrap' ), get_comment_date(), get_comment_time() )
                );
                ?>
              </div>

              <?php comment_reply_link(
                array_merge(
                  $args,
                  array(
                    'reply_text'  => __( 'Reply', 'rainbowstrap' ),
                    'depth'       => $depth,
                    'max_depth'   => $args['max_depth'],
                    'before'      => '<span class="btn btn-primary btn-sm">',
                    'after'       => '</span>'
                  )
                )
              ); ?>
              <div class="clearfix"></div>
              <hr/>
            </div>
            <div class="clearfix"></div>
          </div>
        </li>
        <?php
        break;
    endswitch; // end comment_type check
  }
endif;

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Rainbow strap 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function rainbowstrap_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'rainbowstrap_customize_register' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Rainbow strap 1.0
 */
function rainbowstrap_customize_preview_js() {
  wp_enqueue_script( 'rainbowstrap-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}

add_action( 'customize_preview_init', 'rainbowstrap_customize_preview_js' );

function rainbow_search_form( $form ) {
  $form = '<form role="search" method="get" action="' . home_url( '/' ) . '" >
            <div class="form-group">
              <div class="row">
                <div class="col-md-8 no-padding-right">
                  <input class="form-control" placeholder="' . __('Search ... ' ) . '" type="text" value="' . get_search_query() . '" name="s" id="s" />
                </div>
                <div class="col-md-4 no-padding-left">
                  <button class="btn btn-primary" type="submit">'. esc_attr__( 'Search' ) .'</button>
                </div>
              </div>
            </div>
          </form>';

  return $form;
}

add_filter( 'get_search_form', 'rainbow_search_form' );