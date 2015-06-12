;(function($) {
	var ajax_url = jQuery('#ajax_url').val();
	var $portfolio_wrap = jQuery('.portfolio-wrap');
	var $portfolio_container = jQuery('.portfolio');
	var $blog_wrap = jQuery('.blog-posts-wrap');
	var $blog_container = jQuery('.blog-posts.blog-masonry');
	var $isotope_container = jQuery('.portfolio-centered, .portfolio-full-width, .blog-posts.blog-masonry');
	var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
	function last_child() {
		"use strict";
		if (/msie [1-8]{1}[^0-9]/.test(navigator.userAgent.toLowerCase())) {
			jQuery('.column-block *:last-child').addClass('be-last-child');
			jQuery('.be-section .be-row:last-child .column-block').css('margin-bottom','0px');
		}
	}
	/********************************
	Google Maps 
	********************************/

	function google_maps() {
		jQuery('.gmap').each(function() {
			var $address = jQuery(this).data('address');
			var $zoom = parseInt(jQuery(this).data('zoom'));
			jQuery(this).gmap3({	
				action: 'addMarker',
				address: $address,
				map: {
					center: true,
					zoom: $zoom,
					navigationControl: true
				},
				infoWindow: {
					content: '<p>HTML Content</p>'
				}
			});
		});
	}
	
	function resize_gallery_video() {
		if(jQuery(window).width() < 769) {
			jQuery('iframe.gallery').each(function(){
				jQuery(this).width(jQuery('#gallery-container-wrap').width());
			});
		} else {
			jQuery('iframe.gallery').each(function(){
				jQuery(this).width((jQuery(this).height()*1.77));
			});
		}
	}

	/********************************
	Vertical Portfolio 
	********************************/

	function arrange_vertical_portfolio() {
		if(jQuery(window).width() < 960) {
			jQuery('#navigation').hide();
		}
		if(jQuery('.portfolio-vertical').length > 0) {
			jQuery('#main,.ajaxable').css('min-height', 'inherit');
		}
		if(jQuery(window).width() < 1280 || jQuery('body').hasClass('top-header')) {
			if(jQuery('body').hasClass('single-style1') || jQuery('body').hasClass('single-style2') || jQuery('body').hasClass('single-style3')) {
				var $slider_height = jQuery(window).height()-jQuery('#header').outerHeight();
				if( jQuery('body').hasClass('vertical-boxed') ) {
					$slider_height = $slider_height - 80;
				} 
				jQuery('#main,.ajaxable').height($slider_height);
				jQuery('#main,.ajaxable').css('min-height', $slider_height);
				jQuery('.style1_placehloder').each(function(i) {
					jQuery(this).height(jQuery('#gallery-container-wrap').height());
					jQuery(this).find('img').height(jQuery('#gallery-container-wrap').height());
				});
			} else {
				jQuery('#main,.ajaxable').height('auto');
				jQuery('#main,.ajaxable').css('min-height', '100%');
			}
		} else {
			if(jQuery('body').hasClass('single-style1') || jQuery('body').hasClass('single-style2') || jQuery('body').hasClass('single-style3')) {
				jQuery('#main,.ajaxable').height('100%');
				jQuery('#main,.ajaxable').css('min-height', '100%');
			} else {
				jQuery('#main,.ajaxable').height('auto');
				jQuery('#main,.ajaxable').css('min-height', '100%');
			}
		}
	}

	/********************************
	Background Videos 
	********************************/	
	function adjustImagePositioning() {
	    jQuery('.be-section .be-bg-video').each(function(){
	    	var $img = jQuery(this),
	      img = new Image(),
				$section = $img.parent('.be-section .be-section-pad');	 
      var windowWidth = $section.width(),
            windowHeight = $section.outerHeight(),
            r_w = windowHeight / windowWidth,
            i_w = $img.width(),
            i_h = $img.height(),
            r_i = i_h / i_w,
            new_w, new_h;		
			if( r_w > r_i ) {
				new_h   = windowHeight;
				new_w   = windowHeight / r_i; 
      } else { 
        new_h   = windowWidth * r_i;
        new_w   = windowWidth;
	    }
			var $left = ( windowWidth - new_w ) / 2,
      $top = ( windowHeight - new_h ) / 2;
        $img.css({
          width   : new_w,
          height  : new_h,
          left    : $left, 
          top     : $top 
        });
	    });
	}

	/********************************
	After Ajax Loading of Pages 
	********************************/

	function do_ajax_complete() {
		ajax_url = jQuery('#ajax_url').val();
		$portfolio_wrap = jQuery('.portfolio-wrap'),$portfolio_container = jQuery('.portfolio');
		$blog_wrap = jQuery('.blog-posts-wrap'),$blog_container = jQuery('.blog-posts.blog-masonry');
		$isotope_container = jQuery('.portfolio-centered,.portfolio-full-width,.blog-posts.blog-masonry');
		iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
		last_child();
		jQuery('body').find('iframe').not('.rev_slider iframe').each( function() {
			jQuery(this).parent().fitVids();
		}); 
		jQuery('.column-block .special-heading:only-child').parent('.one-col').css('margin-bottom','40px');
		jQuery('.column-block :header:only-child').parent('.one-col').css('margin-bottom','30px');
		jQuery('.one-col script:last-child').prev('.rev_slider_wrapper').parent('.one-col').css('margin-bottom','0px');
		jQuery('input[placeholder], textarea[placeholder]').placeholder();
		if( !jQuery('html').hasClass('touch') ) {
			jQuery('.be-section.be-bg-parallax').parallax("50%", 0.2);
		}
		
		/********************************
		Menu 
		********************************/

		var $menu = jQuery('#menu');
		$menu.menu();

		/********************************
		Video Backgrounds 
		********************************/

		jQuery('.be-section .be-bg-video').load();
		jQuery('.be-section .be-bg-video').on("loadedmetadata",function() {
			jQuery(this).css({
				width: this.videoWidth,
				height: this.videoHeight
			});
			adjustImagePositioning();
			jQuery(this).css('display','block');
		});

		/********************************
				Tabs
		********************************/

		var $tabs = jQuery('.tabs');
		if($tabs.length > 0) {
			$tabs.tabs({ fx: { opacity:'toggle', duration: 200 } });	
		}

		/********************************
				Accordian
		********************************/

		var $accordion = jQuery('.accordion');
		if($accordion.length > 0) {
			$accordion.accordion({
				collapsible: true,
				heightStyle: "content"
			});
			jQuery(this).find('h3:not(:first-child)').addClass('top-space');
		}

		/********************************
				Clients 
		********************************/
		jQuery('body').imagesLoaded(function () {
            if (jQuery(".be-carousel").length > 0) {
                jQuery(".be-carousel").each(function () {
                    var $this = jQuery(this), col = $this.parent().width()/5, $id = $this.attr('id'), data_col = $this.attr('data-col');
                    if ($this.hasClass('portfolios-carousel')) {
                        if (data_col === 'three') {
                            col = $this.parent().width()/3;
                        } else if (data_col === 'four') {
                            col = $this.parent().width()/4;
                        } else {
                            col = $this.parent().width()/5;
                        }
                    }
                    jQuery('#' + $id).carouFredSel({
                        responsive: true,
                        width: '100%',
                        items: {
                            width: col,
                            height: '200',
                            visible: {
                                min: 2,
                                max: 5
                            }
                        },
                        prev: '#prev-' + $id,
                        next: '#next-' + $id,
                        mousewheel: false,
                        swipe: {
                            onMouse: true,
                            onTouch: true
                        },
						scroll: {
							items: 1,
							pauseOnHover: false
						},
						auto: {
							play: false
						}
                    }).animate({'opacity': 1},500);
                });
            }
        });

		/********************************
				Animated Numbers 
		********************************/

		var $animated_number = jQuery('.animate-number');
		$animated_number.each( function() {
			jQuery(this).numberAnimate();
		});


		/********************************
				Portfolio 
		********************************/
		
		$isotope_container.imagesLoaded( function() {
			$isotope_container.isotope({
				itemSelector : '.hentry'
			});
		});
		$portfolio_wrap.imagesLoaded( function() {
			$portfolio_wrap.find('.portfolio-centered, .portfolio-full-width').animate( { 'opacity': 1 }, 300 );
			var delay = 100;
			$portfolio_wrap.find('.hentry').each(function() {
				jQuery(this).delay(delay).animate({ opacity: 1 }, 300);
				delay += 200;
			});
		});
		jQuery('.image-popup-vertical-fit').magnificPopup({
			closeOnContentClick: true,
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true
			},
			image: {
				verticalFit: true
			}
		});
		jQuery('.popup-gallery').magnificPopup({
			delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
			}
		});
		google_maps();

		/********************************
			FlexSlider
		********************************/

		jQuery('.be-flex-slider').each(function() {
			var $this = jQuery(this);
			$this.imagesLoaded( function(){
				var $animation_type = $this.attr('data-animation');
				var $slideshow = false;
				if($this.attr('data-auto-slide') == 'yes') {
					$slideshow = true;
				}
				var $slide_interval = parseInt($this.attr('data-slide-interval'),10);
				$this.flexslider2({
					animation: $animation_type,
					slideshow: $slideshow,
					slideshowSpeed: $slide_interval,
					controlNav: false,
					smoothHeight: true,
					directionNav: true,
					prevText:'',
					nextText:'',
					start: function(slider){
						slider.closest(".be-flex-slider").removeClass('flex-loading');
					}
				});
			});
		});
		jQuery('.be-testimonials').imagesLoaded( function() {
			jQuery(this).cbpQTRotator();
		});
		jQuery('.blog-flexslider').each(function() {
			jQuery(this).imagesLoaded( function(){
				jQuery(this).flexslider2({
					animation: "fade",
					controlNav: true,
					smoothHeight: true,
					slideshow: false,
					directionNav: true,
					prevText: '<i class="icon-chevron-right"></i>',
					nextText: '<i class="icon-chevron-left"></i>',
					start: function(slider){
						slider.closest(".home-slider").removeClass('flex-loading').find('.icon-cog').remove();
						slider.closest($isotope_container).isotope( 'reLayout' );
					},
					after: function(slider){
						slider.closest($isotope_container).isotope( 'reLayout' );
					}
				});
			});
		});
		if(iOS === false) {
			jQuery('audio').mediaelementplayer({
				videoWidth: '100%',
				videoHeight: '100%',
				audioWidth: '100%',
				alwaysShowControls:true
			});
		}

		/********************************
		Lightbox 
		********************************/

		jQuery('.thumbnails').magnificPopup({
			delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},	
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
				}
			},
			zoom: {
				enabled: true,
				duration: 300, // don't foget to change the duration also in CSS
				opener: function(element) {
					return element.find('img');
				}
			}
		});
		
		jQuery('.image-popup-vertical-fit').magnificPopup({
			closeOnContentClick: true,
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true
			},
			image: {
				verticalFit: true
			}
		});

		/********************************
		Animated Text Blocks 
		********************************/

		var win = jQuery(window);
		var allMods = jQuery(".be-animate");
		var be_skill = jQuery('.be-skill');
		allMods.each(function(i, el) {
			el = jQuery(el);
			if (el.visible(true)) {
				el.addClass("already-visible"); 
				el.addClass(el.attr('data-animation'));
				el.addClass('animated'); 
			} 
		});
		win.scroll(function(event) {
			allMods.each(function(i, el) {
				el = jQuery(el);
				if (el.visible(true)) {
					el.addClass(el.attr('data-animation')); 
					el.addClass('animated');
				} 
			});
			$animated_number.each(function(i, el) {
				el = jQuery(el);
				if(el.visible(true)) {
					el.numberAnimate('set',jQuery(this).attr('data-number'),[1200,1200,1200]);
				}
			});
			be_skill.each(function(i, el) {
				el = jQuery(el);
				if(el.visible(true)) {
					el.css('width',jQuery(this).attr('data-skill-value'));
				}				
			});

		});
		
		jQuery('.page-loader').fadeOut();
		jQuery('#main').animate({opacity : 1});
		jQuery('.portfolio-item.full-width,.portfolio-item.centered2 .portfolio-item-wrap-inner, .carousel-item.portfolio-item').each( function() {
			jQuery(this).hoverdir(); 
		});
		arrange_vertical_portfolio();
		jQuery('html').getNiceScroll().resize();
		
		/********************************
				Header 
		********************************/
		if(jQuery('body').hasClass('top-header') && jQuery('body').hasClass('sticky-header')) {
			if(jQuery('body').hasClass('admin-bar')) {
				jQuery('#header').waypoint('sticky', {
					offset: 28
				});
			} else {
				jQuery('#header').waypoint('sticky', {
					offset: 0
				});
			}
		}
		
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 0) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});
		
		/********************************
		Portfolio Sliders 
		********************************/

		jQuery('body').imagesLoaded( function() {
			if(('#gallery-container-wrap').length > 0) {
				resize_gallery_video();
				jQuery('#gallery-container-wrap').CenteredSlider();
			} else {
				jQuery('.page-loader').fadeOut();
			}
		});
		
		/********************************
		Elasticslide
		********************************/
		jQuery('#carousel').imagesLoaded( function() {
			jQuery('#carousel').elastislide();
		});
		if(jQuery('.gallery_scrollable_content').hasClass('mCustomScrollbar')) {
			jQuery('.gallery_scrollable_content').mCustomScrollbar('update');
		} else {
			jQuery('.gallery_scrollable_content').mCustomScrollbar();
		}
	}

	/*******************************************************
	Ajax Load Pages with HTML Pushstate and page transitions
	********************************************************/

	var transition = function($newEl) {
		var $oldEl = this;
		$oldEl.fadeOut(500, function () {
			if (jQuery('.rev_slider_wrapper').length > 0) {
                jQuery('.rev_slider_wrapper').each(function () {
                    var $wrapper = jQuery(this).attr('id'), $instance = jQuery(this).find('.rev_slider').attr('id'), revapi2 = tpj('#' + $instance).revolution();
                    revapi2.revkill();
                });
            }
			$oldEl.after($newEl);
			$newEl.hide();
			jQuery('html, body, document').animate({scrollTop: jQuery('body').offset().top }, 500);
			$newEl.fadeIn(500);
			$oldEl.remove();
			jQuery('body').imagesLoaded( function() {
				do_ajax_complete();
				jQuery(document).trigger("update_content");
				jQuery('body').find('script').html();
			});
			jQuery(document).trigger('change');
			jQuery('#language-switcher-custom').hide();
		});
	};

	window.no_ajax_pages.push('product', 'add-to-cart', 'pdf', 'doc', 'eps', 'png', 'zip', 'admin','wp-', 'feed', '#', '?remove_item');
	jQuery('html').djax('.ajaxable, .main-menu, .language-switcher-wrap', window.no_ajax_pages, transition);
	jQuery(window).bind('djaxLoad', function(e, data) {
		data = data.response.replace(/(<\/?)body( .+?)?>/gi,'$1NOTBODY$2>', data);
		var nobodyClass = jQuery(data).filter('notbody').attr("class");
		jQuery('body').attr("class", nobodyClass);
		jQuery(document).trigger('change');
		arrange_vertical_portfolio();
	});
	jQuery(window).bind('djaxClick', function(e, data) {
		jQuery('.page-loader').fadeIn();
	});

	/********************************
	Document Ready Function 
	********************************/	

	jQuery(document).ready(function($) {
		do_ajax_complete();

		/**************************************
			Alert Box
		**************************************/

		jQuery(document).on('click', '.be-notification .close', function(e) {
			e.preventDefault();
			jQuery(this).closest('.be-notification').fadeOut(500, function() {
				jQuery(this).remove();
			});
		});
		jQuery(document).on('click', 'a[href="#"]', function(e) {
			e.preventDefault();
		});

		/**************************************
			Portfolio Sorting
		**************************************/
		
		jQuery(document).on('hover', '.element-inner', function() {
			jQuery(this).find('.portfolio-title,.portfolio-title a').stop(true, true).addClass('hover', 300);
				jQuery(this).find('.thumb-overlay').stop().fadeIn(300);
			}, function() {
				jQuery(this).find('.portfolio-title,.portfolio-title a').removeClass('hover', 300);
				jQuery(this).find('.thumb-overlay').stop().fadeOut(300);
			}
		);
		jQuery(document).on('hover', '.overlay-thumb-icons a,.overlay-thumb-title a', function() {
				jQuery(this).stop(true, true).addClass('hover', 300);
			}, function() {
				jQuery(this).removeClass('hover', 300);
			}
		);
		jQuery(document).on('click', '.be-lightbox', function(e) {
			e.preventDefault();
			jQuery(this).next('.popup-gallery').magnificPopup('open');
		});

		/********************************
				Contact
		********************************/

		jQuery(document).on('click', '.contact_submit', function(e) {
			var $this = jQuery(this);
			var $contact_status = $this.closest('.contact_form').find(".contact_status");
			var $contact_loader = $this.closest('.contact_form').find(".contact_loader");
			$contact_loader.fadeIn();
			jQuery.ajax({
				type: "POST",
				url: ajax_url,
				dataType: 'json',
				data: "action=contact_authentication&"+jQuery(this).closest(".contact").serialize(),
				success	: function(msg) {
					$contact_loader.fadeOut();
					if(msg.status === "error") {
						$contact_status.removeClass("success").addClass("error");
					}
					else {
						$contact_status.addClass("success").removeClass("error");
					}
					$contact_status.html(msg.data).slideDown();
				},
				error: function() {
					$contact_status.html("Please Try Again Later").slideDown();
				}
			});
			return false;
		});

		/********************************
				BUTTON 
		********************************/

		jQuery(document).on('mouseenter','.be-button', function() {
			var hover_color=jQuery(this).attr("data-hover-color");
			jQuery(this).stop().animate({backgroundColor: hover_color}, 400);
		});
		jQuery(document).on('mouseleave','.be-button', function() {
			var default_color=jQuery(this).attr("data-default-color");
			jQuery(this).stop().animate({backgroundColor: default_color}, 400);
		});
		
		jQuery(document).on('mouseenter', '.icon-shortcode .font-icon', function() {
			var hover_bg_color=jQuery(this).attr("data-bg-hover-color");
			var hover_color=jQuery(this).attr("data-hover-color");
			if( jQuery(this).hasClass('plain') ) {
				jQuery(this).stop().animate({ color: hover_color }, 400);
			} else {
				jQuery(this).stop().animate({backgroundColor: hover_bg_color,color: hover_color}, 400);
			}
		});
		jQuery(document).on('mouseleave', '.icon-shortcode .font-icon', function() {
			var default_bg_color=jQuery(this).attr("data-bg-color");
			var default_color=jQuery(this).attr("data-color");
			if( jQuery(this).hasClass('plain') ) {
				jQuery(this).stop().animate({ color: default_color }, 400);
			} else {
				jQuery(this).stop().animate({backgroundColor: default_bg_color,color: default_color}, 400);
			}
		});
		
		jQuery(document).on('mouseenter', '.be-carousel-nav', function() {
			var hover_color=jQuery(this).attr("data-hover-bg-color");
			jQuery(this).css('background-color', hover_color);
		});
		jQuery(document).on('mouseleave', '.be-carousel-nav', function() {
			var default_color=jQuery(this).attr("data-default-bg-color");
			jQuery(this).css('background-color', default_color);
		});
		
		/********************************
		Custom Smooth Scroll 
		********************************/

		if(jQuery('body').hasClass('smooth-scroll')) {
			jQuery("html").niceScroll({
				railpadding: 0,
				background: '#000',
				zindex: 100,
				styler: "fb",
				cursorcolor: '#ddd',
				cursorwidth: 12,
				cursorborder: 'none',
				cursorborderradius: '5px',
				autohidemode: false,
				cursoropacitymin: 0.3,
				cursoropacitymax: 0.5,
				scrollspeed: 90,
				mousescrollstep: 70
			});
			jQuery('html').css('overflow-y', 'hidden')
		}

		/********************************
		Widget Hover Effects 
		********************************/
		
		jQuery(document).on('mouseenter', '.widget.animate', function() {
			jQuery(this).find('.widget-content').stop(true, true).slideDown();
		});
		jQuery(document).on('mouseleave', '.widget.animate', function() {
			jQuery(this).find('.widget-content').stop(true, true).slideUp();
		});
		
		/********************************
		Portfolio Sorting 
		********************************/

		jQuery(document).on('click', '.sort', function() {
			var $this=jQuery(this);
			$this.parent(".filters_lists").find(".sort").removeClass("current_choice");
			$this.addClass("current_choice");
			var myClass = $this.attr("data-id");
			$this.closest($portfolio_wrap).find($isotope_container).data( 'filter', '.'+myClass );
			$this.closest($portfolio_wrap).find($isotope_container).isotope({ filter: '.'+myClass }, function(){
				jQuery('html').getNiceScroll().resize();
			});
		});



		/********************************
		Portfolio Loadmore 
		********************************/		
		jQuery(document).on('click', '.load-more-btn.portfolio-loadmore-btn', function() {
			var $this = jQuery(this);
			var action = 'ajax_portfolio';
			var portfolio_style = $this.attr('data-style');
			var portfolio_layout = $this.attr('data-layout');
			var portfolio_lightbox = $this.attr('data-lightbox');
			var portfolio_show_title = $this.attr('data-title');
			var portfolio_show_cat = $this.attr('data-cat');
			var filter = $this.attr('data-filter');
			var category = $this.attr('data-category');
			var items_per_page = $this.attr('data-items');
			var paged = $this.attr('data-paged');
			jQuery('.page-loader').fadeIn();
			jQuery.ajax({
				type: "POST",
				url: ajax_url,
				data: "action="+action+"&portfolio_style="+portfolio_style+"&portfolio_layout="+portfolio_layout+"&portfolio_lightbox="+portfolio_lightbox+"&portfolio_show_title="+portfolio_show_title+"&portfolio_show_cat="+portfolio_show_cat+"&filter="+filter+"&category="+category+"&items_per_page="+items_per_page+"&paged="+paged
			}).done(function(data) {
				if(data) {
					var $newItems = jQuery(data);
					if($this.closest($portfolio_wrap).find($portfolio_container).hasClass('isotope')) {
						$newItems.imagesLoaded( function(){
							if($this.closest($portfolio_wrap).find($portfolio_container).hasClass('portfolio-centered') || $this.closest($portfolio_wrap).find($portfolio_container).hasClass('portfolio-full-width')) {
								$this.closest($portfolio_wrap).find($portfolio_container).append( $newItems ).isotope( 'appended', $newItems, function() {
									var $total = parseInt($this.closest($portfolio_wrap).find($portfolio_container).attr('data-total-posts'));
									var $current_total_item = parseInt($newItems.length);
									var $remaining_items = $total-$current_total_item;
									if($remaining_items > 0) {
										$this.closest($portfolio_wrap).find($portfolio_container).attr('data-total-posts', parseInt($total-$current_total_item));
										paged++;
										$this.attr('data-paged', paged);
									} else {
										$this.closest('.portfolio_pagination').fadeOut(function() {
											jQuery(this).remove();
										});
									}
									$this.closest($portfolio_wrap).find($portfolio_container).find('.portfolio-item.full-width,.portfolio-item.centered2 .portfolio-item-wrap-inner').each( function() {
										jQuery(this).hoverdir(); 
									});
									var myClass = $this.closest($portfolio_wrap).find($portfolio_container).data('filter');
									$this.closest($portfolio_wrap).find($portfolio_container).find('.image-popup-vertical-fit').magnificPopup({
										closeOnContentClick: true,
										mainClass: 'mfp-img-mobile',
										gallery: {
											enabled: true
										},
										image: {
											verticalFit: true
										}
									});
									$this.closest($portfolio_wrap).find($portfolio_container).isotope({ filter: myClass }, function(){
										jQuery('html').getNiceScroll().resize();
									});
									jQuery("html").getNiceScroll().resize();
								});
							}
						});
					}
					else {
						$this.parent('.portfolio_pagination').before( $newItems );
						arrange_vertical_portfolio();
						var $total = parseInt($this.closest($portfolio_wrap).find($portfolio_container).attr('data-total-posts'));
						var $current_total_item = parseInt($newItems.length);
						var $remaining_items = $total-$current_total_item;
						if($remaining_items > 0) {
							$this.closest($portfolio_wrap).find($portfolio_container).attr('data-total-posts', parseInt($total-$current_total_item));
							paged++;
							$this.attr('data-paged', paged);
						} else {
							$this.closest('.portfolio_pagination').fadeOut(function(){
								jQuery(this).remove();
							});
						}
						jQuery("html").getNiceScroll().resize();
					}
				}
				else {
					$this.addClass('disabled');
				}
				jQuery('.page-loader').fadeOut();
			});
		});

		/********************************
		Blog LoadMore Items 
		********************************/

		jQuery(document).on('click', '.load-more-btn.blog-posts-loadmore-btn', function() {
			var $this = jQuery(this);
			var action = 'get_blog';
			var paged = $this.attr('data-paged');
			jQuery('.page-loader').fadeIn();
			jQuery.ajax({
				type: "POST",
				url: ajax_url,
				data: "action="+action+"&paged="+paged
			}).done(function(data) {
				if(data) {
					var $newItems = jQuery(data);
					$newItems.imagesLoaded( function(){
						$this.closest($blog_wrap).find($blog_container).append( $newItems ).isotope( 'appended', $newItems, function(){
							$newItems.find('.blog-flexslider').each(function() {
								jQuery(this).flexslider2({
									animation: "fade",
									controlNav: true,
									smoothHeight: true,
									slideshow: false,
									directionNav: true,
									prevText: '<i class="icon-chevron-right"></i>',
									nextText: '<i class="icon-chevron-left"></i>',
									start: function(slider){
										slider.closest(".home-slider").removeClass('flex-loading').find('.icon-cog').remove();
										slider.closest($isotope_container).isotope( 'reLayout' );
									},
									after: function(slider){
										slider.closest($isotope_container).isotope( 'reLayout' );
									}
								});
							});
							if(iOS === false) {
								$newItems.find('.audio').each(function() {
									jQuery(this).mediaelementplayer();
								});
							}
							$newItems.fitVids();
							var $total = parseInt($this.closest($blog_wrap).find($blog_container).attr('data-total-posts'));
							var $current_total_item = parseInt($newItems.length);
							var $remaining_items = $total-$current_total_item;
							if($remaining_items > 0) {
								$this.closest($blog_wrap).find($blog_container).attr('data-total-posts', parseInt($total-$current_total_item));
								paged++;
								$this.attr('data-paged', paged);
							} else {
								$this.closest('.portfolio_pagination').fadeOut(function(){
									jQuery(this).remove();
								});
							}
							$isotope_container.isotope('reLayout');
							jQuery("html").getNiceScroll().resize();
						});
						
					});
				}
				else {
					$this.addClass('disabled');
				}
				jQuery('.page-loader').fadeOut();
			});
		});

		/********************************
		Mobile Menu 
		********************************/

		jQuery(document).on('click', '.mobile-menu-controller', function() {
			jQuery('#navigation').slideFadeToggle();
		});

		/********************************
		Single Portfolio Gallery Content
		********************************/

		jQuery(document).on('click', '.single_portfolio_info,.single_portfolio_info_close', function() {
			jQuery('.gallery_content').animate({
				opacity : 'toggle',
				height  : 'toggle',
				width   : 'toggle'
			},function() {
				jQuery('.gallery_scrollable_content').mCustomScrollbar("update");
			});
		});
		jQuery(document).on('click', '.mobile-sub-menu-controller', function() {
			var $this = jQuery(this);
			$this.toggleClass('active');
			$this.next('ul').slideFadeToggle();
		});
		jQuery(document).on('click', '#back-top', function(e) {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});		
		jQuery(document).on('click', '.dJAX_external', function(e) {	
			window.open(jQuery(this).attr('data-href'),'_blank');
		});
		
		jQuery(document).on('click', '.laguage-selector-icon', function(e) {	
			jQuery(this).next('#language-switcher-custom').toggle();
		});
		
		jQuery(document).on('click', 'a', function(e) {
			var $go_to = jQuery(this).attr('href');
			if($go_to.indexOf('#') >= 0) {
				var param = $go_to.substring($go_to.indexOf('#')+1);
				if( param ) {
					if(jQuery('#'+param).length > 0) {
						e.preventDefault();
						if(jQuery(window).width() < 960) {
							jQuery('#navigation').slideFadeToggle(500, function() {
								animate_scroll(param);
							});
						} else {
							animate_scroll(param);
						}
					}
				}
			}
		});
		function animate_scroll(param) {
			if (jQuery('#'+param).length > 0) {
				var scroll_distance = jQuery('#'+param).offset().top;
			} else {
				var scroll_distance = 1;
			}
			if(jQuery(window).width() > 767) {
				if(jQuery('body').hasClass('sticky-header') && jQuery('body').hasClass('top-header')) {
					scroll_distance = scroll_distance - jQuery('#header').outerHeight(); 
				} else {
					scroll_distance = scroll_distance; 
				}
			}
			jQuery('html, body, document').stop().animate({scrollTop: scroll_distance }, 1000, 'easeOutQuart', function(){
				jQuery('html, body, document').stop().animate({scrollTop: scroll_distance }, 0);
			});
		}
		jQuery( document ).ajaxError(function() {
			jQuery('.page-loader').fadeOut();
		});
		
		jQuery(document).on('mouseenter', '.carousel_bar_area', function() {
			jQuery(this).find('.carousel_bar_wrap').css('opacity', '0').stop().animate({ opacity: 1,bottom:'0px' }, 500);
		});
		jQuery(document).on('mouseleave', '.carousel_bar_area', function() {
			jQuery(this).find('.carousel_bar_wrap').stop().animate({ opacity: 0,bottom:'-500px' }, 500);
		});
	}); // End Document Load Event
	jQuery(window).smartresize(function() {
		var $isotope_container = jQuery('.portfolio-centered,.portfolio-full-width,.blog-posts.blog-masonry');
		if($isotope_container.length > 0) {
			$isotope_container.isotope( 'reLayout' );
		}
		arrange_vertical_portfolio();
		adjustImagePositioning();
		jQuery("html").getNiceScroll().resize();
		if(jQuery('.portfolio-container').length > 0) {
			jQuery('.portfolio-container').isotope( 'reLayout' );
		}
		resize_gallery_video();
	}); // End Window Resize Event
})(jQuery);