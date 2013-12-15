<?php

function rainbowstrap_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Main Widget Area', 'rainbowstrap' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Appears on the right', 'rainbowstrap' ),
    'before_widget' => '<aside id="%1$s" class="panel panel-default widget %2$s"><div class="panel-body">',
    'after_widget'  => '</div></aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Secondary Widget Area', 'rainbowstrap' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Appears in the footer section of the site.', 'rainbowstrap' ),
    'before_widget' => '<aside id="%1$s" class="panel panel-default widget %2$s"><div class="panel-body">',
    'after_widget'  => '</div></aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}

add_action( 'widgets_init', 'rainbowstrap_widgets_init' );