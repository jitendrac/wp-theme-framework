<?php

class ThemeControllerExtensionNavWalker extends Walker_Nav_Menu {

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '<ul class="dropdown-menu">';
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '</ul>';
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= '<li' . $id . $value . $class_names .'>';

    $atts = array();
    $atts['title']       = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target']      = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']         = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']        = ! empty( $item->url )        ? $item->url        : '';

    if(in_array('has_dropdown', $classes)) {
      $atts['class']       = "dropdown-toggle";
      $atts['data-toggle'] = "dropdown";
    }

    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
      if ( ! empty( $value ) ) {
        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $item_output = $args->before
                    . '<a'. $attributes .'>'
                      . $args->link_before
                      . apply_filters( 'the_title', $item->title, $item->ID )
                      . $args->link_after
                    . '</a>'
                 . $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }

  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    if ( !$element )
      return;

    $id_field = $this->db_fields['id'];

    //display this element
    if ( is_array( $args[0] ) )
      $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

    if( ! empty( $children_elements[$element->$id_field] ) && $depth == 0)
      array_push($element->classes, 'has_dropdown');

    $cb_args = array_merge( array(&$output, $element, $depth), $args);

    call_user_func_array(array(&$this, 'start_el'), $cb_args);

    $id = $element->$id_field;

    // descend only when the depth is right and there are childrens for this element
    if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

      foreach( $children_elements[ $id ] as $child ){

        if ( !isset($newlevel) ) {
          $newlevel = true;
          //start the child delimiter
          $cb_args = array_merge( array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
        }
        $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
      }
      unset( $children_elements[ $id ] );
    }

    if ( isset($newlevel) && $newlevel ){
      //end the child delimiter
      $cb_args = array_merge( array(&$output, $depth), $args);
      call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
    }

    //end this element
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'end_el'), $cb_args);
  }

}