$(document).ready(function(){"use strict";const e=$(".back-top");$(".submenu-block").length>0&&($(window).scroll(function(){$(this).scrollTop()>400?(e.fadeIn(),$(".cookie-block:visible").length>0?e.css("bottom","120px"):e.css("bottom","50px")):e.fadeOut()}),e.click(function(){return $("body, html").animate({scrollTop:0},800),!1}))}),$(document).ready(function(){"use strict";$(".article-listing").off("mouseenter").on("mouseenter",".article-list-item-image",function(){$(".article-list-item-headline",$(this).parent()).addClass("article-hover")}).off("mouseleave").on("mouseleave",".article-list-item-image",function(){$(".article-list-item-headline",$(this).parent()).removeClass("article-hover")}),$(".four-column-content-symbol").hover(function(){$("h4",$(this).parent()).addClass("four-column-hover")},function(){$("h4",$(this).parent()).removeClass("four-column-hover")})}),$(document).ready(function(){"use strict";var e=$(".block-wide"),t=$("div.page-template, div.container").eq(0);function a(){var a=t.width();e.each(function(){var e=$(this).innerWidth(),t=(a-e)/2;"rtl"===$("html").attr("dir")?($(this).css("margin-left","auto"),$(this).css("margin-right",t+"px")):$(this).css("margin-left",t+"px")})}e.length>0&&t.length>0?(a(),$(window).on("resize",a)):($(".block-wide").attr("style","margin: 0px !important;padding-left: 0px !important;padding-right: 0px !important"),$("iframe").attr("style","left: 0"))}),$(document).ready(function(){"use strict";$(".can-do-steps .col").hover(function(){$(this).find(".step-number").toggleClass("active")})}),$(document).ready(function(){"use strict";const e={SLIDE_TRANSITION_SPEED:500,activeTransition:null,nextSlide:function(e){var t=$(e),a=t.next(".carousel-item");return a.length?a:t.prevAll(".carousel-item").last()},previousSlide:function(e){var t=$(e),a=t.prev(".carousel-item");return a.length?a:t.nextAll(".carousel-item").last()},switchIndicator:function(e){this.$CarouselIndicators.children().each(function(t,a){$(a).toggleClass("active",t===e)})},setup:function(){const e=this;e.$CarouselHeaderWrapper=$("#carousel-wrapper-header"),e.$CarouselIndicators=e.$CarouselHeaderWrapper.find(".carousel-indicators"),e.$Slides=e.$CarouselHeaderWrapper.find(".carousel-item"),e.$CarouselHeaderWrapper.find("img").on("load",function(){$(this).get(0).currentSrc!==$(this).parent().css("background-image").replace(/.*\s?url\(['"]?/,"").replace(/['"]?\).*/,"")&&$(this).parent().css("background-image","url("+$(this).get(0).currentSrc+")")}),e.$Slides.each(function(t,a){var o=$(a);$("<li>").attr("data-target","#carousel-wrapper-header").attr("data-slide-to",t).toggleClass("active",0===t).appendTo(e.$CarouselIndicators);var n=o.find("img"),s=n.get(0).currentSrc||n.attr("src");o.css("background-image","url("+s+")").css("background-position",n.data("background-position")),o.attr("data-slide",t)});var t=".carousel-control-next";if("rtl"==$("html").attr("dir")&&(t+=", .carousel-control-prev"),e.$CarouselHeaderWrapper.on("click",t,function(t){t.preventDefault(),e.advanceCarousel()}),e.$CarouselHeaderWrapper.on("click",".carousel-indicators li",function(t){t.preventDefault(),e.activate($(t.target).data("slide-to"))}),$(".carousel-header").length>0&&e.$Slides.length>1){var a=$(".carousel-header")[0],o=new Hammer(a,{recognizers:[]}),n=new Hammer.Manager(o.element),s=new Hammer.Swipe;n.add(s),n.on("swipeleft",function(){e.advanceCarousel()}),n.on("swiperight",function(){e.backwardsCarousel()}),n.on("swipeup",function(e){var t=$(window).scrollTop();e.preventDefault(),$("html, body").animate({scrollTop:t+200})}),n.on("swipedown",function(e){var t=$(window).scrollTop();e.preventDefault(),$("html, body").animate({scrollTop:t-200})})}e.$Slides.each(function(t,a){var o=$(a),n=e.nextSlide(o).find("img");if(n.length>0){var s=$("<div>").addClass("carousel-preview-wrap").prependTo(o),i=n.get(0).currentSrc||n.attr("src");$("<div>").addClass("carousel-preview").css("background-image","url("+i+")").css("background-position",n.data("background-position")).appendTo(s)}})},backwardsCarousel:function(){var e=this.$Slides.filter(".active"),t=this.previousSlide(e);this.activate(t.data("slide"))},activate:function(e){const t=this;var a=t.$Slides.eq(e);a.hasClass("active")&&!a.hasClass("slide-over")||("full-width-classic"!=t.$CarouselHeaderWrapper.data("block-style")&&a.hasClass("next")?t.advanceCarousel():(t.activeTransition&&clearTimeout(t.activeTransition),t.switchIndicator(e),t.$Slides.removeClass("active next slide-over fade-out"),a.addClass("active"),t.nextSlide(a).addClass("next")))},advanceCarousel:function(){const e=this;var t=e.$Slides.filter(".active");e.$Slides.removeClass("next");var a=e.nextSlide(t).addClass("next");if(e.activeTransition)return clearTimeout(e.activeTransition),e.activeTransition=null,e.$Slides.removeClass("fade-out slide-over active"),a.addClass("active"),e.nextSlide(a).addClass("next"),void e.advanceCarousel();t.addClass("slide-over"),e.switchIndicator(e.$Slides.index(a)),e.activeTransition=setTimeout(function(){t.addClass("fade-out"),e.activeTransition=setTimeout(function(){t.removeClass("active"),e.$Slides.removeClass("slide-over fade-out"),a.removeClass("next").addClass("active"),e.nextSlide(a).addClass("next"),e.activeTransition=null},e.SLIDE_TRANSITION_SPEED/2)},e.SLIDE_TRANSITION_SPEED)}},t={nextSlide:function(e){var t=$(e),a=t.next(".carousel-item");return a.length?a:t.prevAll(".carousel-item").last()},previousSlide:function(e){var t=$(e),a=t.prev(".carousel-item");return a.length?a:t.nextAll(".carousel-item").last()},switchIndicator:function(e){this.$CarouselIndicators.children().each(function(t,a){$(a).toggleClass("active",t===e)})},getCurrentSlideIndex:function(){return this.$CarouselHeaderWrapper.find(".carousel-item.active").index()},setup:function(){const e=this;e.$CarouselHeaderWrapper=$("#carousel-wrapper-header"),e.$Slides=e.$CarouselHeaderWrapper.find(".carousel-item"),e.$CarouselHeaderWrapper.find("img").on("load",function(){$(this).get(0).currentSrc!==$(this).parent().css("background-image").replace(/.*\s?url\(['"]?/,"").replace(/['"]?\).*/,"")&&$(this).parent().css("background-image","url("+$(this).get(0).currentSrc+")")}),e.$CarouselIndicators=e.$CarouselHeaderWrapper.find(".carousel-indicators"),e.$Slides.each(function(t,a){var o=$(a);$("<li>").attr("data-target","#carousel-wrapper-header").attr("data-slide-to",t).toggleClass("active",0===t).appendTo(e.$CarouselIndicators);var n=o.find("img"),s=n.get(0).currentSrc||n.attr("src");o.find(".background-holder").css("background-image","url("+s+")").css("background-position",n.data("background-position")),o.attr("data-slide",t)});var t=[".carousel-control-next",".carousel-control-prev"];if("rtl"==$("html").attr("dir")&&t.reverse(),e.$CarouselHeaderWrapper.on("click",t[0],function(t){t.preventDefault(),e.cancelAutoplayInterval(),e.advanceCarousel()}),e.$CarouselHeaderWrapper.on("click",t[1],function(t){t.preventDefault(),e.cancelAutoplayInterval(),e.backwardsCarousel()}),e.$CarouselHeaderWrapper.on("click",".carousel-indicators li",function(t){t.preventDefault(),e.cancelAutoplayInterval(),e.activate($(t.target).data("slide-to"))}),$(".carousel-header_full-width-classic").length>0&&e.$Slides.length>1){var a=$(".carousel-header_full-width-classic")[0],o=new Hammer(a,{recognizers:[]}),n=new Hammer.Manager(o.element),s=new Hammer.Swipe;n.add(s),n.on("swipeleft",function(){e.cancelAutoplayInterval(),e.advanceCarousel()}),n.on("swiperight",function(){e.cancelAutoplayInterval(),e.backwardsCarousel()}),n.on("swipeup",function(e){var t=$(window).scrollTop();e.preventDefault(),$("html, body").animate({scrollTop:t+200})}),n.on("swipedown",function(e){var t=$(window).scrollTop();e.preventDefault(),$("html, body").animate({scrollTop:t-200})})}e.positionIndicators(),e.setCarouselHeight(e.$Slides.first()),e.$CarouselHeaderWrapper.find(".initial").on("transitionend",function(){$(this).removeClass("initial")}),$(window).on("resize",function(){var t=$(".carousel-item.active");e.setCarouselHeight(t),e.positionIndicators()}),e.autoplayPaused=!1,e.autoplayEnabled=1==e.$CarouselHeaderWrapper.data("carousel-autoplay"),e.$Slides.length>1&&e.autoplayEnabled&&(e.startAutoplayInterval(),e.$CarouselHeaderWrapper.on("mouseenter",function(){e.autoplayPaused=!0}),e.$CarouselHeaderWrapper.on("mouseleave",function(){e.autoplayPaused=!1})),$(window).on("scroll",function(){e.cancelAutoplayInterval(),$(window).off("scroll")})},startAutoplayInterval:function(){var e=this;e.autoplayInterval=window.setInterval(function(){e.autoplayPaused||e.advanceCarousel()},6e3)},cancelAutoplayInterval:function(){window.clearInterval(this.autoplayInterval)},activate:function(e){const t=this;var a=t.$Slides.eq(e),o=t.getCurrentSlideIndex();e!=o&&(e>o?t.advanceCarousel(a):t.backwardsCarousel(a))},positionIndicators:function(){var e=this.$CarouselHeaderWrapper.find(".carousel-indicators"),t=this.$CarouselHeaderWrapper.find(".carousel-item.active .action-button"),a="rtl"==$("html").attr("dir"),o=window.matchMedia("(min-width: 992px)").matches&&a||window.matchMedia("(min-width: 768px) and (max-width: 992px)").matches&&!a;if(window.matchMedia("(min-width: 768px)").matches){var n=t.offset().left;if(o){var s=n+(a?t.width():t.parent().width()),i=$(window).width()-s;e.css("right",i+"px").css("left","").css("margin-left","0").css("margin-right","3px")}else n=a?t.parent().offset().left:t.offset().left,e.css("left",n+"px").css("right","").css("margin-right","0").css("margin-left","3px")}else e.css("right",""),e.css("left","")},getSlideHeight:function(e){return e.find(".carousel-item-mask .background-holder").outerHeight()+e.find(".carousel-caption").outerHeight()+"px"},setCarouselHeight:function(e){const t=this;window.matchMedia("(max-width: 992px)").matches?t.$CarouselHeaderWrapper.find(".carousel-inner, .carousel-item-mask").css("height",this.getSlideHeight(e)):t.$CarouselHeaderWrapper.find(".carousel-inner, .carousel-item-mask").css("height","")},backwardsCarousel:function(e){const t=this;var a=t.$Slides.filter(".active"),o=null;o=e||t.previousSlide(a),a.addClass("slide-right"),o.addClass("prev"),t.setCarouselHeight(o),a.on("transitionend",function(){a.removeClass("slide-right active"),o.addClass("active").removeClass("prev"),a.off("transitionend")}),t.switchIndicator(t.$Slides.index(o))},advanceCarousel:function(e){const t=this;var a=t.$Slides.filter(".active"),o=null;o=e||t.nextSlide(a),a.addClass("slide-left"),o.addClass("next"),a.on("transitionend",function(){a.removeClass("slide-left active"),o.addClass("active").removeClass("next"),a.off("transitionend")}),a.find(".btn").fadeIn(),t.setCarouselHeight(o),t.switchIndicator(t.$Slides.index(o))}};switch($("#carousel-wrapper-header").data("block-style")){case"full-width-classic":t.setup();break;default:e.setup()}}),$(document).ready(function(){"use strict";$(".counter-style-en-forms-bar").appendTo(".enform-extra-header-placeholder").show()}),$(document).ready(function(){"use strict";function e(){if($("#happy-point > iframe").length>0)return window.removeEventListener("load",e),window.removeEventListener("resize",e),void window.removeEventListener("scroll",e);$("#happy-point")[0].getBoundingClientRect().top<window.innerHeight&&$("#happy-point").append($("<iframe></iframe>").attr({src:decodeURIComponent(t),cellSpacing:"0",allowtransparency:"true",frameborder:"0",scrolling:"no",width:"100%"}))}const t=$("#happy-point").data("src");t&&(window.addEventListener("load",e),window.addEventListener("resize",e),window.addEventListener("scroll",e))}),$(document).ready(function(){$(".four-column-content").each(function(){var e=$(".post-column:visible",$(this)).length;0==e%4?$(this).attr("data-posts_per_row",4):0==e%3&&$(this).attr("data-posts_per_row",3)}),$(".btn-load-more-posts-click").off("mousedown touchstart").on("mousedown touchstart",function(e){e.preventDefault();var t=$(".post-column:hidden",$(this).closest(".container")),a=$(this).closest(".four-column-content").data("posts_per_row");t.length>0&&t.slice(0,a).show("slow"),t.length<=a&&$(this).closest(".load-more-posts-button-div").hide("fast")}),$(".covers-block").each(function(){var e=$(".cover-card-column:visible",$(this)).length;0==e%3?$(this).attr("data-covers_per_row",3):0==e%2&&$(this).attr("data-covers_per_row",2)}),$(".btn-load-more-covers-click").off("mousedown touchstart").on("mousedown touchstart",function(e){e.preventDefault();var t=$(".cover-card-column:hidden",$(this).closest(".container")),a=$(this).closest(".covers-block").data("covers_per_row");t.length>0&&t.slice(0,a).show("slow"),t.length<=a&&$(this).closest(".load-more-covers-button-div").hide("fast")}),$(".btn-load-more-articles-click").off("mousedown touchstart").on("mousedown touchstart",function(e){e.preventDefault();var t=$(".article-list-item.d-none",$(this).closest(".container"));t.length>0&&($(".article-list-item.d-none img").slice(0,3).each(function(){var e=this;e.setAttribute("src",e.getAttribute("data-src")),e.onload=function(){e.removeAttribute("data-src")}}),t.slice(0,3).removeClass("d-none").fadeOut(0).slideDown("slow"));0===(t=$(".article-list-item.d-none",$(this).closest(".container"))).length&&$(this).closest(".load-more-articles-button-div").hide("fast")}),$(".load-more").off("mousedown touchstart").on("mousedown touchstart",function(e){e.preventDefault();const t=$(this),a=$(this.dataset.content,t.closest("section")),o=parseInt(this.dataset.page)+1,n=parseInt(this.dataset.total_pages),s=p4_vars.ajaxurl+`?page=${o}`;this.dataset.page=o,$.ajax({url:s,type:"GET",data:{action:"load_more",args:this.dataset,_wpnonce:$("#_wpnonce").val()},dataType:"html"}).done(function(e){a.append(e),o===n&&t.fadeOut()}).fail(function(e,t,a){console.log(a)})}),$(".btn-load-more-campaigns-click").off("mousedown touchstart").on("mousedown touchstart",function(e){e.preventDefault();var t=$(".campaign-card-column:hidden",$(this).closest(".container"));t.length>0&&t.slice(0,3).show("slow"),t.length<=3&&$(this).closest(".load-more-campaigns-button-div").hide("fast")})}),$(document).ready(function(){"use strict";var e=$(".post-content").find("> #action-card"),t=e.offset(),a=100;function o(){if($(window).width()>992){let o=$(".post-details > :last-child").offset().top-e.outerHeight()-a;$(window).scrollTop()>t.top&&$(window).scrollTop()<o&&e.stop().animate({marginTop:$(window).scrollTop()-t.top+a}),$(window).scrollTop()<t.top&&e.stop().animate({marginTop:0})}else e.css("margin-top",0)}e.length>0&&(window.addEventListener("scroll",o),window.addEventListener("resize",o))}),$(document).ready(function(){"use strict";$(".four-column-content").each(function(){var e=$(".publications-slider .post-column",$(this)).length;e>3&&$(window).width()<768&&$(".publications-slider").slick({infinite:!1,mobileFirst:!0,slidesToShow:2.2,slidesToScroll:1,arrows:!1,dots:!1,responsive:[{breakpoint:992,settings:{slidesToShow:4}},{breakpoint:768,settings:{slidesToShow:3}},{breakpoint:576,settings:{slidesToShow:2}}]}),e<4&&$(window).width()>768&&$(".post-column",$(this)).removeClass("col-lg-3").removeClass("col-md-4").addClass("col-md")})});
//# sourceMappingURL=main.js.map
