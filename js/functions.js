/**
 * Functionality specific to Rainbow strap.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

  // Easy Bootstrap 3 Classes From WP

  $(document).ready(function(){
    if($('#masthead > .background').hasClass('parallax'));
      $('#masthead > .background').parallax("50%", 0.4);
  });

  $('.current-menu-item').addClass('active');
  $('.widget.panel').each(function(){
    if($(this).find('> .panel-body > h3').length > 0) {
      $(this).prepend('<div class="panel-heading">' + $(this).find('> .panel-body > h3').html() + '</div>');
      $(this).find('> .panel-body > h3').remove();
    }
  });

  var commentsArea = $('.comments-area');
      commentsArea.find('.comment-reply-title').addClass('text-primary');
      commentsArea.find('.comment-notes').addClass('alert alert-success');
  var commentForm  = commentsArea.find('.comment-form');
      commentForm.find('input[type="submit"]').addClass('btn btn-primary');
  var commentFormGroups = commentForm.find('.comment-form-comment, .comment-form-author, .comment-form-email, .comment-form-url');
      commentFormGroups.find('> textarea, > input').addClass('form-control');
      commentFormGroups.find('> label').addClass('text-primary');
      commentForm.find('.form-allowed-tags').remove();
  var footerWidgets = $('#secondary > .widget-area > .widget');
      footerWidgets.each(function(){
        $(this).after('<div class="col-md-' + parseInt(12 / footerWidgets.length) + '"></div>');
        $(this).appendTo($(this).next());
      });
      $('#secondary').after('<div class="clearfix"></div>');

  var menuObject = jQuery('#navbar');

  if(menuObject.length != 0) {
    var menuTopPosition = parseInt(menuObject.position().top, 10);

    jQuery(window).scroll(function(){
      if((
          parseInt(jQuery(window).scrollTop(), 10)
              + (jQuery('#wpadminbar').length > 0 ? parseInt(jQuery('#wpadminbar').height(),10) : 0)
          ) > menuTopPosition) {
        menuObject.removeClass('navbar-static');
        menuObject.addClass('navbar-fixed-top navbar-slim animated fadeInDown');
        menuObject.css('top', ((jQuery('#wpadminbar').length > 0 ? jQuery('#wpadminbar').height() : 0)));
      } else {
        menuObject.addClass('navbar-static');
        menuObject.removeClass('navbar-fixed-top navbar-slim animated fadeInDown');
        menuObject.css('top', '0');
      }
    });
  }

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.rainbowstrap', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );
} )( jQuery );