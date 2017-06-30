$(document).ready(function(){

	/************************
	/*	MAIN NAVIGATION
	/************************/

	$mainMenu = $('.main-menu');

	// init collapse first for browser without transition support (IE9) 
	$mainMenu.find('li').has('ul').children('ul').collapse({toggle: false});

	$mainMenu.find('li.active').has('ul').children('ul').addClass('in');
	$mainMenu.find('li').not('.active').has('ul').children('ul').removeClass('in');

	$('.main-menu .submenu-toggle').click( function(e){
		e.preventDefault();

		$currentItemToggle = $(this);
		$currentItem = $(this).parent();
		$mainMenu.find('li').not($currentItem).not($currentItem.parents('li')).removeClass('active').children('ul.in').collapse('hide');
		$currentItem.toggleClass('active').children('ul').collapse('toggle');
	});

	$('.btn-off-canvas').click( function() {
		if($('.wrapper').hasClass('off-canvas-active')) {
			$('.wrapper').removeClass('off-canvas-active');
		} else {
			$('.wrapper').addClass('off-canvas-active');
		}
	});

	$('.btn-nav-sidebar-minified').click( function(e) {
		e.preventDefault();
		
		if( $('.wrapper').hasClass('main-nav-minified') ) {
			$('.wrapper').removeClass('main-nav-minified');
			$('#main-nav').hide();
			$('#fixed-left-nav').removeAttr('disabled');

			setTimeout(
				function () {
					$('#main-nav').fadeIn(500);
				}, 100);
		} else {
			$('.wrapper').addClass('main-nav-minified');
			disableFixedLeft(); // fixed left sidebar is not applicable for this mode
			$('#fixed-left-nav').attr('checked', false).attr('disabled', true);
		}
	});

	$(window).resize(removeMinifiedOnSmallScreen);

	function removeMinifiedOnSmallScreen() {
		if( ($(document).innerWidth()) < 1200) {
			$('.wrapper').removeClass('main-nav-minified');
		}
	}

	function disableFixedLeft() {
		$('body').removeClass('fixed-left-active');

		if($('#col-left .slimScrollDiv').length > 0) {
			$(".main-nav-wrapper").parent().replaceWith($(".main-nav-wrapper"));
		}
	}


	/************************
	/*	SIDEBAR
	/************************/

	$('.toggle-right-sidebar').click( function(e) {
		$(this).toggleClass('active');
		$('.right-sidebar').toggleClass('active');
	});


	/************************
	/*	WIDGET
	/************************/

	// widget remove
	$('.widget .btn-remove').click( function(e) {

		e.preventDefault();
		$(this).parents('.widget').fadeOut(300, function() {
			$(this).remove();
		});
	});

	// widget toggle expand
	$('.widget .btn-toggle-expand').clickToggle(
		function(e) {
			e.preventDefault();
			$(this).parents('.widget').find('.slimScrollDiv').css('height', 'auto');
			$(this).parents('.widget').find('.widget-content').slideUp(300);
			$(this).find('i').removeClass('ion-ios-arrow-up').addClass('ion-ios-arrow-down');
		},
		function(e) {
			e.preventDefault();
			$(this).parents('.widget').find('.widget-content').slideDown(300);
			$(this).find('i').removeClass('ion-ios-arrow-down').addClass('ion-ios-arrow-up');
		}
	);


	/************************
	/*	TODO LIST
	/************************/

	if( $('.todo-list').length > 0 ) {
		$('.todo-list').sortable({
			revert: true,
			placeholder: "ui-state-highlight",
			handle: '.handle'
		});

		$('.todo-list input').change( function() {
			if( $(this).prop('checked') ) {
				$(this).parents('li').addClass('completed');
			}else {
				$(this).parents('li').removeClass('completed');
			}
		});
	}


	//*******************************************
	/*	WIDGET SLIM SCROLL
	/********************************************/

	if( $('body.dashboard').length > 0) {
		$('.widget-todo .widget-content').slimScroll({
			height: '400px',
			wheelStep: 5,
		});

		$('.widget-live-feed .widget-content').slimScroll({
			height: '409px',
			wheelStep: 5,
		});
	}

	$('.widget-chat-contacts .widget-content').slimScroll({
		height: '800px',
		wheelStep: 5,
		railVisible: true,
		railColor: '#fff'
	});
	
});

	// toggle function
	$.fn.clickToggle = function( f1, f2 ) {
		return this.each( function() {
			var clicked = false;
			$(this).bind('click', function() {
				if(clicked) {
					clicked = false;
					return f2.apply(this, arguments);
				}

				clicked = true;
				return f1.apply(this, arguments);
			});
		});

	}