/**====================================================================
 *
 *  Main Script File
 *
 * 	The minified version includes the following libraries:
 * 	../components/plyr/src/js/plyr.js
 * 	./materialize-src/js/bin/materialize.min.js
 * 	../components/slick/slick.min.js
 * 	../components/skrollr/skrollr.min.js
 * 	../components/waypoints/jquery.waypoints.js
 *  
 ====================================================================**/


(function($) {
	"use strict";

	$.qtWebsiteObj = {};
	$.qtWebsiteObj.body = $("body");
	$.qtWebsiteObj.htmlAndbody = $('html,body');

	/**====================================================================
	 *
	 *
	 * 	Function to go back in history used by form check
	 *
	 * 
	 ====================================================================*/
	window.goBack = function(e) {
		var defaultLocation = "http://www.mysite.com";
		var oldHash = window.location.hash;
		history.back(); // Try to go back
		var newHash = window.location.hash;
		if (
			newHash === oldHash &&
			(typeof(document.referrer) !== "string" || document.referrer === "")
		) {
			window.setTimeout(function() {
				// redirect to default location
				window.location.href = defaultLocation;
			}, 1000); // set timeout in ms
		}
		if (e) {
			if (e.preventDefault){
				e.preventDefault();
			}
			if (e.preventPropagation){
				e.preventPropagation();
			}
		}
		return false; // stop event propagation and browser default event
	};


	/**====================================================================
	 *
	 *
	 * Automatic link embed
	 *
	 * 
	 ====================================================================*/
	$.fn.embedMixcloudPlayer = function(content) {
		var finalurl = ((encodeURIComponent(content)));
		finalurl = finalurl.replace("https","http");
		var embedcode ='<iframe data-state="0" class="mixcloudplayer" width="100%" height="80" src="//www.mixcloud.com/widget/iframe/?feed='+finalurl+'&embed_uuid=addfd1ba-1531-4f6e-9977-6ca2bd308dcc&stylecolor=&embed_type=widget_standard" frameborder="0"></iframe><div class="canc"></div>';    
		return embedcode;
	}

	$.fn.embedVideo = function (content, width, height) {
		height = width / 16 * 9;
		var youtubeUrl = content;
		var youtubeId = youtubeUrl.match(/=[\w-]{11}/);
		var strId = youtubeId[0].replace(/=/, '');
		var result = '<iframe width="'+width+'" height="'+height+'" src="'+window.location.protocol+'//www.youtube.com/embed/' + strId + '?html5=1" frameborder="0" class="youtube-player" allowfullscreen></iframe>';
		return result;
	}
	
	/**====================================================================
	 *
	 * 
	 *	15. Smooth scrolling
	 *	
	 * 
	 ====================================================================*/
	$.fn.qtSmoothScroll = function(){
		var topscroll;
		$.qtWebsiteObj.body.off("click",'a.qt-smoothscroll');
		$.qtWebsiteObj.body.on("click",'a.qt-smoothscroll', function(e){     
			e.preventDefault();
			topscroll = $(this.hash).offset().top;
			$('html,body').animate({scrollTop:topscroll}, 600);
		});
	}

	/**====================================================================
	 *
	 *
	 *	 Responsive video resize
	 *
	 * 
	 ====================================================================*/
	$.fn.NewYoutubeResize = function  (){
		jQuery("iframe").each(function(i,c){ // .youtube-player
			var t = jQuery(this);
			if(t.attr("src")){
				var href = t.attr("src");
				if(href.match("youtube.com") || href.match("vimeo.com") || href.match("vevo.com")){
					var width = t.parent().width(),
						height = t.height();
					t.css({"width":width});
					t.height(width/16*9);
				}; 
			};
		});
	};

	/**====================================================================
	 *
	 *
	 * 	Check images loaded in a container
	 *
	 * 
	 ====================================================================*/
	$.fn.imagesLoaded = function () {
			// get all the images (excluding those with no src attribute)
		var $imgs = this.find('img[src!=""]');
		// if there's no images, just return an already resolved promise
		if (!$imgs.length) {return $.Deferred().resolve().promise();}
		// for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
		var dfds = [];  
		$imgs.each(function(){
			var dfd = $.Deferred();
			dfds.push(dfd);
			var img = new Image();
			img.onload = function(){dfd.resolve();}
			img.onerror = function(){dfd.resolve();}
			img.src = this.src;
		});
		// return a master promise object which will resolve when all the deferred objects have resolved
		// IE - when all the images are loaded
		return $.when.apply($,dfds);
	}

	/**====================================================================
	 *
	 *
	 * Transform link in embedded players
	 *
	 * 
	 ====================================================================*/

	$.fn.transformlinks = function (targetContainer) {
		if(undefined === targetContainer) {
			targetContainer = "body";
		}
		jQuery(targetContainer).find("a[href*='youtube.com'],a[href*='youtu.be'],a[href*='mixcloud.com'],a[href*='soundcloud.com'], [data-autoembed]").not('.qw-disableembedding').each(function(element) {
			var that = jQuery(this);
			var mystring = that.attr('href');
			if(that.attr('data-autoembed')) {
				mystring = that.attr('data-autoembed');
			}
			var width = that.parent().width();
			
			if(width === 0){
				width = that.parent().parent().parent().width();
			}
			if(width === 0){
				width = that.parent().parent().parent().width();
			}
			if(width === 0){
				 
				width = that.parent().parent().parent().parent().width();
			}
			var height = that.height();
			var element = that;

			//=== YOUTUBE https
			var expression = /(http|https):\/\/(\w{0,3}\.)?youtube\.\w{2,3}\/watch\?v=[\w-]{11}/gi;
			var videoUrl = mystring.match(expression);
			if (videoUrl !== null) {
				for (var count = 0; count < videoUrl.length; count++) {
					mystring = mystring.replace(videoUrl[count], $.fn.embedVideo(videoUrl[count], width, (width/16*9)));
					replacethisHtml(mystring);
				}
			}               
			//=== SOUNDCLOUD
			var temphtml = '';
			var iframeUrl = '';
			var $temphtml;
			var expression = /(http|https)(\:\/\/soundcloud.com\/+([a-zA-Z0-9\/\-_]*))/g;
			var scUrl = mystring.match(expression);
			if (scUrl !== null) {
				for (count = 0; count < scUrl.length; count++) {
					var finalurl = scUrl[count].replace(':', '%3A');
					finalurl = finalurl.replace("https","http");
					jQuery.getJSON(
						'https://soundcloud.com/oembed?maxheight=140&format=js&url=' + finalurl + '&iframe=true&callback=?'
						, function(response) {
							temphtml = response.html;
							if(that.closest("li").length > 0){
								if(that.closest("li").hasClass("qt-collapsible-item")) {
									$temphtml = $(temphtml);
									iframeUrl = $temphtml.attr("src");
									replacethisHtml('<div class="qt-dynamic-iframe" data-src="'+iframeUrl+'"></div>');
								}
							} else {
								replacethisHtml(temphtml);
							}
					});
				}
			}
			//=== MIXCLOUD
			var expression = /(http|https)\:\/\/www\.mixcloud\.com\/[\w-]{0,150}\/[\w-]{0,150}\/[\w-]{0,1}/ig;
			videoUrl = mystring.match(expression);
			if (videoUrl !== null) {
				for (count = 0; count < videoUrl.length; count++) {
					mystring = mystring.replace(videoUrl[count], $.fn.embedMixcloudPlayer(videoUrl[count]));
					replacethisHtml(mystring);
				}
			}
			//=== STRING REPLACE (FINAL FUNCTION)
			function replacethisHtml(mystring) {
				element.replaceWith(mystring);
				return true;
			}

			$.fn.NewYoutubeResize();
		});
		
		/**
		 * Fix for soundcloud loaded in collapsed div for the chart
		 */
		$.qtWebsiteObj.body.on("click",'.qt-collapsible li', function(e){
			var that = $(this);
			if(that.hasClass("active")){
				var item = that.find(".qt-dynamic-iframe");
				var itemurl = item.attr("data-src");
				item.replaceWith('<iframe src="'+itemurl+'" frameborder="0"></iframe>');
				$.fn.NewYoutubeResize();
			}
		});
	}


	/**====================================================================
	 *
	 * 
	 *	12. Mobile navigation
	 *	
	 * 
	 ====================================================================*/
	$.fn.qtMobileNav = function() {
		$.qtWebsiteObj.body.find( ".side-nav li.menu-item-has-children > a").each(function(i,c){
			var that = $(c);
			that.append("<i class='material-icons qt-openthis qt-btn-secondary'>keyboard_arrow_down</i>");
			that.on("click","> .qt-openthis", function(e){
				e.preventDefault();
				that.parent().toggleClass("open");
				return;
			});
			return;
		});
		return true;
	};

	/**====================================================================
	*
	* 
	*  	Slick gallery
	*  
	* 
	====================================================================*/
	$.fn.slickGallery = function() {
		$.qtWebsiteObj.slickSliders = $('.qt-slickslider, .qt-slick');
		if($.qtWebsiteObj.slickSliders.length === 0) {
			return;
		}
		$.qtWebsiteObj.slickSliders.not('.slick-initialized').each(function() {
			var that = $(this),
				slidesToShow = that.attr("data-slidestoshow"),
				slidestoshowMobile = that.attr("data-slidestoshowmobile"),
				slidestoshowIpad = that.attr("data-slidestoshowipad"),
				appendArrows = that.attr("data-appendArrows");

			if (slidesToShow === undefined || slidesToShow === "") {
				slidesToShow = 1;
			}
			if (slidestoshowMobile === undefined || slidestoshowMobile === "") {
				slidestoshowMobile = 1;
			}

			if (slidestoshowIpad === undefined || slidestoshowIpad === "") {
				slidestoshowIpad = 3;
			}
			if (appendArrows === undefined || appendArrows === "") {
				appendArrows = that; // append the arrows to the same container
			} else {
				appendArrows = that.closest(appendArrows); // or append arrows to other divs
			}
			that.slick({
				slidesToScroll: 1,
				pauseOnHover: that.attr("data-pauseonhover") === "true",
				infinite: that.attr("data-infinite") === "true",
				autoplay: that.attr("data-autoplay") === "true",
				autoplaySpeed: 4000,
				centerPadding:  that.attr("data-centerpadding") || 0,
				slide: ".qt-item",
				dots: that.attr("data-dots") === "true",
				variableWidth: that.attr("data-variablewidth") === "true",
				arrows: that.attr("data-arrows") === "true",
				centerMode: that.attr("data-centermode") === "true",
				slidesToShow: slidesToShow,
				appendArrows: appendArrows,
				responsive: [
					{
						breakpoint: 790,
						settings: {
							arrows: that.attr("data-arrowsmobile") === "true",
							centerMode: that.attr("data-centermodemobile") === "true",
							centerPadding: 0,
							variableWidth: true,//that.attr("data-variablewidthmobile") === "true",
							variableHeight: false,
							dots: that.attr("data-dotsmobile") === "true",
							slidesToShow: slidestoshowMobile,
							draggable: false,
							swipe: true,
							touchMove: true,
							infinite: that.attr("data-infinitemobile") === "true",
						}
					}, {
						breakpoint: 1200,
						settings: {
							arrows: that.attr("data-arrowsipad"),
							dots: that.attr("data-dotsipad") === "true",
							slidesToShow: slidestoshowIpad,
						}
					}
				]
			}).promise().done(function(){
				that.removeClass("qt-invisible");
			});
		});

		$.qtWebsiteObj.body.on("click","[data-slicknext]", function(e){
			e.preventDefault();
			var slidertarget = $(this).attr("data-slicknext");
			$(slidertarget).find('.qt-slickslider').slick("slickNext");
		});
		$.qtWebsiteObj.body.on("click","[data-slickprev]", function(e){
			e.preventDefault();
			var slidertarget = $(this).attr("data-slickprev");
			$(slidertarget).find('.qt-slickslider').slick("slickPrev");
		});
	};



	/**====================================================================
	 *
	 * 
	 *	Generic class switcher (toggle class or toggleclass)
	 *	
	 * 
	 ====================================================================*/
	$.fn.qtQtSwitch = function() {
		$.qtWebsiteObj.body.off("click", "[data-qtswitch]");
		$.qtWebsiteObj.body.on("click", "[data-qtswitch]", function(e) {
			var that = $(this);
			e.preventDefault();
			$(that.attr("data-target")).toggleClass(that.attr("data-qtswitch"));
		});

		$.qtWebsiteObj.body.on("click", "[data-removeitem]", function(e) {
			var that = $(this);
			$(that.attr("data-removeitem")).hide();
		});

		$("[data-expandable]").each(function(i, c) {
			var that = $(c),
				selector = that.attr("data-expandable"),
				target = $(selector);

			if (selector !== "") {
				if (target.hasClass("open")) {
					target.velocity({
						properties: {
							height: target.find(".qt-expandable-inner").height() + "px"
						},
						options: {
							duration: 50
						}
					});
				}
			}
		});
		$.qtWebsiteObj.body.off("click", "[data-expandable]");
		$.qtWebsiteObj.body.on("click", "[data-expandable]", function(e) {
			e.preventDefault();
			var btn = $(this);
			var that = $(btn.attr("data-expandable"));
			if (!that.hasClass("open")) {
				that.addClass("open");
				that.velocity({
					properties: {
						height: that.find(".qt-expandable-inner").height() + "px"
					},
					options: {
						duration: 300
					}
				});
			} else {
				that.removeClass("open");
				that.velocity({
					properties: {
						height: 0
					},
					options: {
						duration: 300
					}
				});
			}
		});
	};


	/**====================================================================
	 *
	 *
	 * 	Parallax Backgrounds
	 * 	http://designers.hubspot.com/docs/snippets/design/implement-a-parallax-effect
	 *
	 * 
	 ====================================================================*/
	$.fn.qtParallaxRuntime = function(settings, $this, scrollTop, offset, height, yBgPosition, windowHeight) {

		scrollTop = $(window).scrollTop();
		offset = $this.offset().top;
		height = $this.outerHeight();
		if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
		return;
		}
		yBgPosition = Math.round((offset - scrollTop) * settings.speed);
		$this.css('background-position', 'center ' + yBgPosition + 'px');
	}



	$.fn.qtParallaxV5 = function(options) {
		// return;
		var windowHeight = $(window).height();
		// Establish default settings
		var settings = $.extend({
			speed        : 0.15
		}, options);

		if($.qtWebsiteObj.body.hasClass('qt-parallax-on')){
			// Iterate over each object in collection
			return this.each( function() {
				var $this = $(this),
					userAgent = navigator.userAgent, scrollTop, offset, height, yBgPosition;
				
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(userAgent)|| $(window).width() < 1280 ) {
					$this.css('background-attachment', 'local');
					return;
				} else {
					$this.css('background-attachment', 'fixed');
				}
				// initialize
				$.fn.qtParallaxRuntime(settings, $this, scrollTop, offset, height, yBgPosition, windowHeight);
				// Set up Scroll Handler
				$(document).scroll(function(){
					$.fn.qtParallaxRuntime(settings, $this, scrollTop, offset, height, yBgPosition, windowHeight);
				});
			});
		}
	}

	/**====================================================================
	 *
	 * 
	 *  17. Dynamic backgrounds
	 *  
	 * 
	 ====================================================================*/
	$.fn.dynamicBackgroundsV2 = function(targetContainer) {

		if (undefined === targetContainer) {
			targetContainer = "body";
		}

		var waypointsenables = 0;
		if($.qtWebsiteObj.body.hasClass("qt-lazyload")){
			waypointsenables = 1;
		}
		if(waypointsenables){
			$(targetContainer + " [data-bgimage]").each(function() {
				var that = $(this),
					bg = that.attr("data-bgimage"),
					speed = that.attr("data-speed");

				
				if (bg !== '' && that.not(".imgloaded")) {
					if(speed == '' || speed === undefined){
						speed = 0.15;
					} else {
						speed = speed / 10;
					}
					that.waypoint(function() {
						/**
						 * 1. we add img src in the html to know when the pic is loaded
						 * 2. when loaded we add it as background and then fade in / paralax
						 */
						
						 /* 1. add picture as background */
						that.append('<img src="'+bg+'" class="qt-hidden qt-lazyimg" alt="">');
						that.imagesLoaded().then(function(){
				   			that.css({"background-image": "url("+bg+")", "background-attachment" : that.attr("data-bgattachment") || "local"}).addClass("imgloaded");
							if(that.attr("data-parallax") === "1") {
								that.qtParallaxV5({
									speed : speed
								});
							}
						});
					}, { offset: '100%' });
				}
			});
		} else {
			$(targetContainer + " [data-bgimage]").each(function() {
				var that = $(this),
					bg = that.attr("data-bgimage"),
					speed = that.attr("data-speed");
				if (bg !== '') {
					if(speed == '' || speed === undefined){
						speed = 0.15;
					} else {
						speed = speed / 10;
					}
					
					that.css({"background-image": "url("+bg+")", "background-attachment" : that.attr("data-bgattachment") || "local"}).addClass("imgloaded");
					if(that.attr("data-parallax") === "1") {
						that.qtParallaxV5({
							speed : speed
						});
					}
					return;
				}
			});
		}
	};



	/**====================================================================
	 *
	 * 
	 *  Event countdown (requires library component) 
	 *  
	 * 
	 ====================================================================*/
	$.fn.qtCountdown = function() {
		$.each($('.qt-countdown'), function(i, c) {
			var that = $(c),
				date = that.attr("data-end");
			if (date !== undefined && date !== "") {
				var eventdate = new Date(date),
					nowdate = (new Date()),
					eventtime = eventdate.getTime(),
					nowtime = nowdate.getTime(),
					difference = eventtime - nowtime;
				$(c).ClassyCountdown({
					theme: "white-wide",
					end: $.now() + (difference / 1000)
				});
			}
		});
	};



	/**====================================================================
	 *
	 *
	 *	Masonry templates (based on default WordPress Masonry)
	 *
	 * 
	 ====================================================================*/
	$.fn.qtMasonry = function(targetContainer){
		if(undefined === targetContainer) {
			targetContainer = "body";
		}
		$(targetContainer).find('.qt-masonry').each( function(i,c){
			var that = $(c),
				idc = $(c).attr("id"),
				container = document.querySelector('#'+idc);
			if(container){
				that.imagesLoaded().then(function(){
					var msnry = new Masonry( container, {  itemSelector: '.qt-ms-item',   columnWidth: '.qt-ms-item' });
				});
			}
		});
		$(targetContainer).find('.gallery').each( function(i,c){
			var that = $(c),
				idc = $(c).attr("id"),
				container = document.querySelector('#'+idc);
			if(container){
				that.imagesLoaded().then(function(){
					var msnry = new Masonry( container, {  itemSelector: '.gallery-item',   columnWidth: '.gallery-item' });
				});
			}
		});
		return true;
	};

	
	/**====================================================================
	 *
	 *
	 *	Skrollr plugin initialization only for desktop
	 *
	 * 
	 ====================================================================*/
	$.fn.qtSkrollrInit = function(){
		// disable skrollr if using handheld device
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			return;
		}
		if(typeof(window.vcParallaxSkroll) === 'object'){
		 	// window.vcParallaxSkroll.destroy();
		}
		$.skrollrInstance = skrollr.init({
			smoothScrolling: true,
			forceHeight: false,
			render: function(data) {
		        if(data.curTop >= 10 && data.curTop <= 350) {
		            window.dispatchEvent(new Event('resize'));
		        }
		    }
		});
	}

	$.fn.qtMaterialSlideshow = function(){
		$('.qt-material-slider').each(function(i,c){
			var that = $(c),
				timing = that.attr("data-timeout");
			if("" === timing || undefined === timing || null === timing){
				timing = 3000;
			}
			that.slider({
				full_width: true, 
				height: "100%", 
				indicators: true ,
				interval: Number(timing) || 3000
			});
			that.on("click",".prev",function(){
				that.slider("prev");
			});
			that.on("click",".next",function(){
				that.slider("next");
			});
			that.on("mouseenter",".qt-slideshow-link", function(){
				that.slider("pause");
			}).mouseleave(function(){
				that.slider("start");
			});
			
			if(that.hasClass("qt-hero-slider")){
				that.find(".qt-hero-slider-index").append('<hr class="qt-heroindex-indicator">');
				var indicatorsArray = that.find(".indicators li.indicator-item"),
					itemsNumber = indicatorsArray.length,
					itemsWidth = 100 / itemsNumber;
				indicatorsArray.css({width: itemsWidth+"%" });
				that.find(".qt-heroindex-indicator").css({width : itemsWidth+"%" });
				that.on("click","[data-qtslidegoto]",function(e){
					e.preventDefault();
					var togo = $(this).attr("data-qtslidegoto");
					that.find(".indicators li").eq(togo). click ();
					that.find(".qt-active").removeClass("qt-active");
					that.find(".qt-heroindex-indicator").css({left : (itemsWidth * togo)+"%" });
					$(this).parent().addClass("qt-active");
				});
			    var theIndexNow = 0,
				updateSlideIndex = setInterval(
					function(){
						theIndexNow = that.find(".indicators li.indicator-item.active").index();
						that.find(".qt-active").removeClass("qt-active");
						that.find(".qt-hero-slider-index-item").eq(theIndexNow).addClass("qt-active");
						that.find(".qt-heroindex-indicator").css({left : (itemsWidth * theIndexNow)+"%" });
					}, 
					500
				);
			}
		});
	}


	/**====================================================================
	 *
	 *	After ajax page initialization
	 * 	Used by QT Ajax Pageloader. 
	 * 	MUST RETURN TRUE IF ALL OK.
	 * 
	 ====================================================================*/
	$.fn.qtFooterFx = function(){
		var qtFooterfxcontainer = $("#qtFooterfxcontainer"),
			qtFooterfx = $("#qtFooterfx"),
			maincontent = $("#maincontent");
		qtFooterfxcontainer.removeAttr('style');
			qtFooterfx.removeAttr('style');
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $(window).width() < 1280 ) {
			return;
		}
		qtFooterfxcontainer.css({"height": qtFooterfx.outerHeight()+"px" });
		qtFooterfx.css({"width":  qtFooterfx.outerWidth()+"px"});
		qtFooterfx.css({"position": "fixed", 
						"height": qtFooterfx.outerHeight()+"px",
						"bottom": "0"});
	}


	/**====================================================================
	 *
	 *	Card activator
	 * 
	 ====================================================================*/
	$.fn.qtCardActivator = function(){
		$.qtWebsiteObj.body.on("click", ".qt-activate-card", function(e){
			e.preventDefault();
			$(this).closest(".qt-interactivecard").toggleClass("open");
			$.fn.NewYoutubeResize();
		});
		$.qtWebsiteObj.body.on("click", "[data-activatetab]", function(e){
			e.preventDefault();
			var that = $(this),
				container = that.closest(".qt-cardtabs"),
				target = container.find("[data-"+that.attr("data-activatetab")+"]");
			container.find(".qt-the-content").addClass("qt-hidden");
			target.removeClass("qt-hidden");
		});
		
	}

	/**====================================================================
	 *
	 *	qtnavsearch
	 * 
	 ====================================================================*/
	 $.fn.qtnavSearch = function(){
	 	var navsearch = $("#qtnavsearch"),
	 		qtsearch = $("#qtsearch");
	 	$.qtWebsiteObj.body.on("click", "#qtnavsearchbutton", function(e){
	 		e.preventDefault();
	 		if( navsearch.hasClass("open") && qtsearch.val() !== ''){
	 			$("#qtnavform").submit();
	 		} else {
	 			navsearch.toggleClass("open");
	 		}
	 	});
	 	$.qtWebsiteObj.body.on("click", "#qtnavsearchclose", function(e){
	 		e.preventDefault();
	 		navsearch.removeClass("open");
	 	});
	 }

	 /**====================================================================
	 *
	 *	Video activator
	 * 
	 ====================================================================*/

	 $.fn.qtVideoActivator = function(){
	 	$.qtWebsiteObj.body.on("click", "[data-videoactivator]", function(e){
	 		e.preventDefault();
	 		var that = $(this),
	 			target = $(that.attr("data-videoactivator"));
	 		target.toggleClass("active");
	 		if("object" === typeof($.qtWebsiteObj.videos)){
	 			$.qtWebsiteObj.videos[0].play();
	 		} else if ("object" === typeof($.qtWebsiteObj.twitchPlayer) ){
	 			$.qtWebsiteObj.twitchPlayer.play();
	 		}

	 	});

	 	if($.qtWebsiteObj.body.hasClass("qt-video-autoplay")){
	 		$("[data-videoactivator]").click();
	 	}
	 }

	 /**====================================================================
	 *
	 *	Video controller
	 * 
	 ====================================================================*/
	 $.fn.qtVideoControl = function(){ 	
	 	$(window).load(function(){
	 		if(typeof(plyr) !== 'object'){
		 		return;
		 	}
			$.qtWebsiteObj.videos = plyr.setup();
			return;
	 	});
	 }

	 /**====================================================================
	 *
	 *	Twitch Video
	 * 
	 ====================================================================*/

	 $.fn.qtTwitchVideo = function(){ 	
	 	if(typeof(Twitch) !== "object"){
	 		return;
	 	}
	 	var twtichVideoCont = $("#qtTwitchPlayer");
	 	$.qtWebsiteObj.twitchPlayer = false;

		if(twtichVideoCont.length <= 0) {
			return;
		} 
		twtichVideoCont.each(function(i,c){
			var that = $(this),
				videoId = that.attr("data-videoid");
			var options = {
				video: 'v'+videoId,
				autoplay: false
			};
			$.qtWebsiteObj.twitchPlayer = new Twitch.Player("qtTwitchPlayer", options);
		});
	}

	/**
	 * Time conversion for plyr skip cue
	 */
	 $.fn.qtTimeConvert = function(input) {
	    var parts = input.split(':'), hours, minutes, seconds;
	    if(parts.length == 2){
	    	hours = 0,
	        minutes = +parts[0],
	        seconds = +parts[1];
	    } else {
	    	hours = +parts[0]
	    	minutes = +parts[1],
	        seconds = +parts[2];
	    }
	    var total = ((hours * 3600) + (minutes * 60) + seconds);
	    return total; // int   
	}

	/**
	 * [qtChapters time skipping for videos with plyr.js]
	 * 
	 */
	$.fn.qtChapters = function(){
		var cuetime, seek;
		$.qtWebsiteObj.body.on("click", ".qt-skip", function(e){
			e.preventDefault();
			var that = $(this),
			cuetime = that.parent().attr("data-time");
			seek = $.fn.qtTimeConvert(cuetime);
			// cue in different way depending on the type of video
			if("object" === typeof($.qtWebsiteObj.videos)){
	 			$.qtWebsiteObj.videos[0].seek(seek);

	 		} else if ("object" === typeof($.qtWebsiteObj.twitchPlayer) ){
	 			$.qtWebsiteObj.twitchPlayer.seek(seek.toFixed(3)); // twitch requires ToFixed(3)
	 		}
		});
	}


	 /**====================================================================
	 *
	 *	[qtLockSidebar when clicking the lock, the sidebar stays locked]
	 * 
	 ====================================================================*/
	$.fn.qtLockSidebar = function(){
		var that,
			qtMasterContainter = $("#qtMasterContainter"),
			lockBtn = $("#ttgSidebarBlock"),
			lockState = lockBtn.attr("data-state"),
			lockicon = lockBtn.find("i"),
			dataAttrOpen = qtMasterContainter.attr("data-0"),
			dataAttrClosed = dataAttrOpen.split("qt-notscrolled").join("qt-scrolled"),
			qtFlexibleTopSpacer = $("#qtFlexibleTopSpacer");
		$.qtWebsiteObj.body.on("click", "#ttgSidebarBlock", function(e){
			e.preventDefault();
			that = $(this);

			if(lockState === 'open'){
				lockicon.html("lock");
				qtMasterContainter.attr("data-0", dataAttrClosed);
				that.attr("data-state", "close");
				qtFlexibleTopSpacer.addClass("closed");
				lockState = 'closed';
			} else {
				lockicon.html("lock_open");
				qtMasterContainter.attr("data-0", dataAttrOpen);
				that.attr("data-state", "open");
				qtFlexibleTopSpacer.removeClass("closed");
				lockState = 'open';
			}

			if( "undefined" !== typeof($.skrollrInstance)) {
				$.skrollrInstance.refresh();
			} else {
				$.fn.qtSkrollrInit();
			}
		});
	}
	


	/**====================================================================
	 *
	 *	After ajax page initialization
	 * 	Used by QT Ajax Pageloader. 
	 * 	MUST RETURN TRUE IF ALL OK.
	 * 
	 ====================================================================*/
	$.fn.initializeAfterAjax = function(){
		$.fn.qtLockSidebar();
		$.fn.slickGallery();
		$.fn.qtQtSwitch();
		$.fn.dynamicBackgroundsV2();
		$.fn.qtCardActivator();
		if( "undefined" !== typeof($.skrollrInstance)) {
			$.skrollrInstance.refresh();
		} else {
			$.fn.qtSkrollrInit();
		}
		$.fn.qtMasonry();
		$.fn.qtCountdown();
		// $.fn.qtFitvids();
		$.fn.transformlinks("#maincontent");
		$('.qt-collapsible').collapsible();
		jQuery('ul.tabs').tabs({"swipeable":false}).delay(500).promise().done(function(){
			jQuery('ul.tabs li:first-child a') . click ();
		});
		$.fn.qtVideoControl();
		$.fn.qtTwitchVideo();
		$.fn.qtVideoActivator();
		$.fn.qtChapters();
		$('.qt-scrollspy').scrollSpy();
		$('.tooltipped').tooltip({delay: 50});
		$( "#qwShowDropdown" ).change(function() {
			$("a#"+$(this).attr("value")) . click ();
		});
		$.fn.qtMaterialSlideshow();
		$.fn.qtSmoothScroll();
		$.fn.NewYoutubeResize();
		return true;
	}

	
	/**====================================================================
	 *
	 * 
	 *  Functions to run once on first page load
	 *  
	 * 
	 ====================================================================*/
	$.fn.qtPageloadInit = function() {
		$(".button-collapse").sideNav();
		$('.qt-button-extrasidebar').sideNav({
			  edge: 'right',
			  closeOnClick: false,
			  draggable: false
			}
		);
		$.qtWebsiteObj.body.on("click", ".qt-button-extrasidebar-close", function(e) {
			e.preventDefault();
			$('.qt-button-extrasidebar').sideNav('hide');
		});
		$.qtWebsiteObj.body.on("click", ".qt-navmenu-close", function(e) {
			e.preventDefault();
			$('.button-collapse').sideNav('hide');
		});
		$.fn.qtnavSearch();
		$.qtWebsiteObj.body.off("click", ".qt-scrolltop");
		$.qtWebsiteObj.body.on("click", ".qt-scrolltop", function(e) {
			e.preventDefault();
			$("html, body").animate({
				scrollTop: 0
			}, "slow");
		});
		$.fn.qtMobileNav();
		$.fn.qtFooterFx ();

		$.fn.initializeAfterAjax();
	};

	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 	This needs to call only $.fn.qtInitTheme
	 * 
	 ====================================================================*/
	jQuery(document).ready(function() {
		$.fn.qtPageloadInit();		
	});
	$( window ).resize(function() {
		$.fn.NewYoutubeResize();
	});

})(jQuery);
