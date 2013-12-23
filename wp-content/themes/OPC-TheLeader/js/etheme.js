jQuery(document).ready(function($){

    
    // **********************************************************************// 
    // ! Main Navigation with columns
    // **********************************************************************//

    var mainNav = $('.fixed-header .menu, .main-nav .menu');

    mainNav.find('>li').hoverIntent({
        over: function() {

            var dropdown = $(this).find('> .nav-sublist-dropdown');
            var padding = 0;

            if($(this).find('.image-item').length>0) {
                padding = 20;
            }

            dropdown.fadeIn(100).css({
                display: 'list-item',
                listStyle: 'none'
            }).find('li').css({listStyle: 'none'});


            // calculate columns count
            var columnsCount = dropdown.find('.menu-parent-item,.image-item').length;
            var dropdownWidth = dropdown.outerWidth();
            if(columnsCount > 1) {
                dropdownWidth = dropdownWidth*columnsCount;
                dropdown.css({
                    'width':dropdownWidth - padding
                });

                // equalize all columns height
                et_equalize_height(dropdown.find('.menu-parent-item,.image-item'),false);


            }

            // calculate right offset of the  dropdown
            var headerWidth = $('.menu-wrapper').outerWidth();
            var headerLeft = $('.menu-wrapper').offset().left;
            var dropdownOffset = dropdown.offset().left - headerLeft;
            var dropdownRight = headerWidth - (dropdownOffset + dropdownWidth);

            if(dropdownRight < 0) {
                dropdown.css({
                    'left':'auto',
                    'right':0
                });
            }

        },
        out: function() {
            $(this).find('> .nav-sublist-dropdown').fadeOut(100).attr('style', '');;
        },
        timeout: 50
    });

    function et_equalize_height(elements, removeHeight) {
        var heights = [];

        if(removeHeight) {
            elements.attr('style', '');
        }

        elements.each(function(){
            heights.push($(this).height());
        });

        var maxHeight = Math.max.apply( Math, heights );

        elements.height(maxHeight);
    }

    $(window).resize(function(){
        et_equalize_height($('.product-category'), true);
    });

    // **********************************************************************// 
    // ! "Top" button
    // **********************************************************************//

    var scroll_timer;
    var displayed = false;
    var $message = jQuery('.back-to-top');
    var $window = jQuery(window);
    
    $window.scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () { 
        if($window.scrollTop() <= 0) 
        {
            displayed = false;
            $message.fadeOut(500);
        }
        else if(displayed == false) 
        {
            displayed = true;
            $message.stop(true, true).fadeIn(500).click(function () { $message.fadeOut(500); });
        }
        }, 400);
    });
    
    jQuery('.back-to-top').click(function(e) {
            jQuery('html, body').animate({scrollTop:0}, 1000);
            return false;
    });

    // **********************************************************************// 
    // ! Portfolio
    // **********************************************************************//

    $portfolio = $('.masonry');
    


    $portfolio.isotope({ 
        itemSelector: '.portfolio-item'
    });    

    $(window).smartresize(function(){
        $portfolio.isotope({ 
            itemSelector: '.portfolio-item'
        });
    });
    
    $('.portfolio-filters a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.portfolio-filters a').removeClass('active');
        if(!$(this).hasClass('active')) {
            $(this).addClass('active');
        }
        $portfolio.isotope({ filter: selector });
        return false;
    });

    setTimeout(function(){
        $('.portfolio').addClass('with-transition');
        $('.portfolio-item').addClass('with-transition');
    },500);
    
    $(window).resize();

    // **********************************************************************// 
    // ! Blog isotope
    // **********************************************************************// 
    
    $blog = $('.blog-masonry');

    console.log("Mansonry");

    $blog.isotope({ 
        itemSelector: '.post-grid'
    });    

    setTimeout(function(){
        $blog.isotope( 'reLayout', function(){
            console.log("reLayout");
        } )
    }, 500); 

    setTimeout(function(){
        $blog.isotope( 'reLayout', function(){
            console.log("reLayout");
        } )
    }, 1000); 

    setTimeout(function(){
        $blog.isotope( 'reLayout', function(){
            console.log("reLayout");
        } )
    }, 1500); 

    $(window).smartresize(function(){
        $blog.isotope({ 
            itemSelector: '.post-grid'
        });   
    });

    // **********************************************************************// 
    // ! Fixed header
    // **********************************************************************// 
    
    $(window).scroll(function(){
        if (!$('body').hasClass('fixNav-enabled')) {return false; }
        var fixedHeader = $('.fixed-header-area');
        var scrollTop = $(this).scrollTop();
        var headerHeight = $('.header').height() + $('.main-nav').height() + $('.top-bar').height();
        
        if(scrollTop > headerHeight){
            if(!fixedHeader.hasClass('fixed-already')) {
                fixedHeader.stop().addClass('fixed-already');
            }
        }else{
            if(fixedHeader.hasClass('fixed-already')) {
                fixedHeader.stop().removeClass('fixed-already');
            }
        }
    });
    // **********************************************************************// 
    // ! Icons Preview
    // **********************************************************************// 

    var modalDiv = $('#iconModal');
    
    $('.demo-icons .demo-icon').click(function(){

        var name = $(this).find('i').attr('class');
        
        modalDiv.find('i').each(function(){
            $(this).attr('class',name);
        });
        
        modalDiv.find('#myModalLabel').text(name);
        
        modalDiv.modal();
    });

    // **********************************************************************// 
    // ! Testimonials Gallery
    // **********************************************************************// 
    
    $('.testimonials-slider').cbpQTRotator();

    // **********************************************************************// 
    // ! WooCommerce
    // **********************************************************************// 

    // **********************************************************************// 
    // ! Products view switcher
    // **********************************************************************// 

    function listSwitcher() {
        var activeClass = 'switcher-active';
        var gridClass = 'products-grid';
        var listClass = 'products-list';
        jQuery('.switchToList').click(function(){
            if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid'){
                switchToList();
            }
        });
        jQuery('.switchToGrid').click(function(){
            if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list'){
                switchToGrid();
            }
        });
        
        function switchToList(){
            jQuery('.switchToList').addClass(activeClass);
            jQuery('.switchToGrid').removeClass(activeClass);
            jQuery('.product-loop').fadeOut(300,function(){
                jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
                jQuery.cookie('products_page', 'list');
            });
        }
        
        function switchToGrid(){
            jQuery('.switchToGrid').addClass(activeClass);
            jQuery('.switchToList').removeClass(activeClass);
            jQuery('.product-loop').fadeOut(300,function(){
                jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
                jQuery.cookie('products_page', 'grid');
            }); 
        }
    }

    function check_view_mod(){
        var activeClass = 'switcher-active';
        if(jQuery.cookie('products_page') == 'grid') {
            jQuery('.product-loop').removeClass('products-list').addClass('products-grid');
            jQuery('.switchToGrid').addClass(activeClass);
        }else if(jQuery.cookie('products_page') == 'list') {
            jQuery('.product-loop').removeClass('products-grid').addClass('products-list');
            jQuery('.switchToList').addClass(activeClass);
        }else{
            if(view_mode_default == 'list_grid' || view_mode_default == 'list') {
                jQuery('.switchToList').addClass(activeClass);
            }else{
                jQuery('.switchToGrid').addClass(activeClass);
            }
        }
    }

    listSwitcher();
    check_view_mod();
    // **********************************************************************// 
    // ! Step by step checkout
    // **********************************************************************// 

    var stepsNav = $('.checkout-steps-nav');
    var steps = $('.checkout-steps');
    var nextStepBtn = $('.continue-checkout');

    stepsNav.find('li a').click(function(e) {
        e.preventDefault();
        var link = $(this);
        var stepId = link.data('step');
        showStep(stepId);
    });

    nextStepBtn.click(function(e) {
        e.preventDefault();
        var nextId = $(this).data('next');

        showStep(nextId);
    });

    steps.find('.active').show();

    // checkout method 

    var radioBtns = $('input[name="method"]');

    radioBtns.change(function() {
        var checkedMethod = jQuery(this).val();

        checkMethod(checkedMethod);
    });

    checkMethod($('input[name="method"]:checked').val());

    function showStep(id) {
        var stepsNav = $('.checkout-steps-nav');

        $('.checkout-step').fadeOut(200);

        stepsNav.find('li a').removeClass('active');
        $('#tostep' + id + ' a').addClass('active');

        setTimeout(function(){
            $('#step' + id).fadeIn(200);
        }, 200);
    }


    function checkMethod(val){
        if(val == 2) {
            $('#tostep2').css('display','inline-block');
            $('#createaccount').attr('checked', true);
            $('#step1 .continue-checkout').data('next',2);
        }else{
            $('#tostep2').hide();
            $('#createaccount').attr('checked', false);
            $('#step1 .continue-checkout').data('next',3);
        }
    }


    /* Ajax Filter */
    
    function ajaxProductLoad(url,blockId) {
        $.ajax({
            url: url,
            method: 'GET',
            timeout: 10000,
            dataType: 'text',
            success: function(data) {
                productLoaded(data,blockId);
                
            },
            error: function(data) {
                alert('Error loading ajax content!');
                window.location.reload();
            }
        });
    }
    
    function productLoaded(data,blockId) {
        //hide spinner
        $('.woocommerce-pagination').html($(data).find('.woocommerce-pagination').html());
        $('#'+blockId).html($(data).find('#'+blockId).html());
        $('.content.span9').html($(data).find('.content.span9').html());
        $('.content.span12').html($(data).find('.content.span12').html());
        $('*').css({'cursor':'auto'});
        $('.product-grid').removeClass('loading').find('#floatingCirclesG').remove();
        
        //productHover();
        check_view_mod();
        listSwitcher();
        
    }
    
    if(ajaxFilterEnabled == 1) {
        $('.widget_layered_nav a, .woocommerce-pagination a').live('click', function(event) {
            var url = $(this).attr('href');
            if (url == '') {
                url = $(this).attr('value');
            }
            
            blockId = $(this).parent().parent().parent().attr('id');
            
            $('*').css({'cursor':'progress'});
            $('.product-loop .product').addClass('loading').prepend('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
        
            ajaxProductLoad(url,blockId);
            event.stopPropagation();
            return false;
        });
    }
    

    // Variations images changes

    $('form.variations_form').on( 'found_variation', function( event, variation ) {
        var $variation_form = $(this);

        var $product        = $(this).closest( '.product' );
        var $product_img    = $product.find( 'div.images img:eq(0)' );
        var $product_link   = $product.find( 'div.images a.zoom:eq(0)' );

        var o_src           = $product_img.attr('data-o_src');
        var o_title         = $product_img.attr('data-o_title');
        var o_href          = $product_link.attr('data-o_href');

        var variation_image = variation.image_src;
        var variation_link = variation.image_link;
        var variation_title = variation.image_title;
                    
        if ($('.main-image-slider').hasClass('zoom-enabled')) {
            $('a#main-zoom-image').swinxyzoom('load', variation_image,  variation_link);
            $('a#main-zoom-image').attr('href', o_href);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
        } else{

            $('a#main-zoom-image').attr('href', variation_image);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
        }

    })              
    // Reset product image
    .on( 'reset_image', function( event ) {

        var $product        = $(this).closest( '.product' );
        var $product_img    = $product.find( 'div.images img:eq(0)' );
        var $product_link   = $product.find( 'div.images a.zoom:eq(0)' );

        var o_src           = $product_img.attr('data-o_src');
        var o_href          = $product_link.attr('data-o_href');

        if ($('.main-image-slider').hasClass('zoom-enabled')) {
            $('a#main-zoom-image').swinxyzoom('load', o_src,  o_src);
            $('a#main-zoom-image').attr('href', o_href);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', o_src);
        } else{
            $('a#main-zoom-image').attr('href', variation_image);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', o_src);
        }


    } );


    // Ajax add to cart

    var modalWindow = jQuery('.etheme-simple-product').eModal();

    $('.etheme-simple-product').live('click', function(e) {
        e.preventDefault();
        // AJAX add to cart request
        var $thisbutton = $(this);
        
        if ($thisbutton.is('.etheme-simple-product, .product_type_downloadable, .product_type_virtual')) {
            
            
            $('#top-cart').addClass('updating');
            
            formAction = $('form.cart').attr('action');
            
            var data = {
                quantity: $('input[name=quantity]').val()
            };

            modalWindow.eModal('showModal');
            
            // Trigger event
            $('body').trigger('adding_to_cart');
            
            // Ajax action
            $.ajax({
                url: formAction,
                data: data,
                method: 'POST',
                timeout: 10000,
                dataType: 'text',
                error: function(data) {
                    modalWindow.eModal('endLoading')
                         .eModal('addError', 'Error with ajax')
                         .eModal('addBtn',{
                                title: contBtn,
                                href: 'javascript:void(0);',
                                cssClass: 'button small hidewindow',
                                hideOnClick: true
                            });                    
                },
                success : function(data,statusText,xhr ) {           
                    jQuery('.shopping-cart-widget').html(jQuery(data).find('.shopping-cart-widget').html());     
                    productImageSrc = $('.thumbnails img').first().attr('src');                   
                    productName = $('.product_title').first().text();  

                    modalWindow.eModal('endLoading')
                         .eModal('setTitle',productName)
                         .eModal('addImage', productImageSrc)
                         .eModal('addText', successfullyAdded)
                         .eModal('addBtn',{
                                title: contBtn,
                                href: 'javascript:void(0);',
                                cssClass: 'button small hidewindow',
                                hideOnClick: true
                            })
                         .eModal('addBtn',{
                                title: checkBtn,
                                href: checkoutUrl,
                                cssClass: 'button filled small arrow-right'
                            });                  
                }
            });
            
            return false;
        
        } else {
            return true;
        }
        
    });
    
    // Ajax add to cart (on list page)
    $('.etheme_add_to_cart_button').live('click', function() {
        
        // AJAX add to cart request
        var $thisbutton = $(this);

        if ($thisbutton.is('.product_type_simple, .product_type_downloadable, .product_type_virtual')) {

            if (!$thisbutton.attr('data-product_id')) return true;

            $thisbutton.removeClass('added');
            $thisbutton.parent().parent().addClass('loading');
            $thisbutton.after('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');

            var data = {
                action:         'woocommerce_add_to_cart',
                product_id:     $thisbutton.attr('data-product_id'),
                quantity:       $thisbutton.attr('data-quantity')
            };

            // Trigger event
            $('body').trigger( 'adding_to_cart', [ $thisbutton, data ] );

            // Ajax action
            $.post( woocommerce_params.ajax_url, data, function( response ) {

                if ( ! response )
                    return;

                var this_page = window.location.toString();

                this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                // Redirect to cart option
                if ( woocommerce_params.cart_redirect_after_add == 'yes' ) {

                    window.location = woocommerce_params.cart_url;
                    return;

                } else {

                    $thisbutton.parent().find('#floatingCirclesG').remove();

                    fragments = response.fragments;
                    cart_hash = response.cart_hash;

                    // Block fragments class
                    if ( fragments ) {
                        $.each(fragments, function(key, value) {
                            $(key).addClass('updating');
                        });
                    }
                $('.shopping-cart-widget').fadeTo('400', '0.6').block({message: null, overlayCSS: {background: 'transparent url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', opacity: 0.6 } } );
                    // Changes button classes
                    $thisbutton.addClass('added').parent().prepend('<p class="added-text">' + successfullyAdded + '</p>');
                    
                    setTimeout(function() { 
                        $thisbutton.parent().parent().removeClass('loading');
                        $thisbutton.removeClass('added');
                        $('.added-text').fadeOut(300);
                    }, 3000)
                    
                    // Replace fragments
                    if ( fragments ) {
                        $.each(fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }

                    // Unblock
                    $('.shopping-cart-widget').stop(true).css('opacity', '1').unblock();
                    console.log($('.shopping-cart-widget'));
                    
                    // Cart widget load
                    if ($('.shopping-cart-widget').size()>0) {
                        $('.shopping-cart-widget:eq(0)').load( this_page + ' .shopping-cart-widget:eq(0) > *', function() {
    
                            // Replace fragments
                            if (fragments) {
                            console.log(fragments);
                                $.each(fragments, function(key, value) {
                                    $(key).replaceWith(value);
                                });
                            }
                            
                            // Unblock
                            $('.shopping-cart-widget').stop(true).css('opacity', '1').unblock();
                            
                            $('body').trigger('cart_widget_refreshed');
                        } );
                    }

                    // Trigger event so themes can refresh other areas
                    $('body').trigger( 'added_to_cart', [ fragments, cart_hash ] );
                }
            });

            return false;

        } else {
            return true;
        }
        
    });
    

    // **********************************************************************// 
    // ! Search form
    // **********************************************************************// 
    
    var searchForm = $('.search #searchform');
    var searchBtn = searchForm.find('.button');
    var searchInput = searchForm.find('input[type="text"]');

    searchBtn.click(function(e) {
        if(searchForm.hasClass('hide-input')){
            e.preventDefault();
            searchInput.fadeIn(200).focus();
            searchForm.removeClass('hide-input');
        }


        // Hide search input on click
        $(document).click(function(e) {
            var target = e.target;
            if (!$(target).is('.search') && !$(target).parents().is('.search')) {
                searchForm.addClass('hide-input');
                searchInput.fadeOut(200);
            }
        });

    });

    // **********************************************************************// 
    // ! Tabs
    // **********************************************************************// 

    var tabs = $('.tabs');
    $('.tabs > p > a').unwrap('p');
    
    var leftTabs = $('.left-bar, .right-bar');
    var newTitles;
    
    leftTabs.each(function(){
        var currTab = $(this);
        //currTab.find('> a.tab-title').each(function(){
            newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
        //});

        newTitles.first().addClass('opened');

        
        var tabNewTitles = $('<div class="left-titles"></div>').prependTo(currTab);
        tabNewTitles.html(newTitles);

        currTab.find('.tab-content').css({
            'minHeight' : tabNewTitles.height()
        });
    });
    
    
    tabs.each(function(){
        var currTab = $(this);

        currTab.find('.tab-title').first().addClass('opened').next().show();

        currTab.find('.tab-title, .tab-title-left').click(function(e){
            
            e.preventDefault();
            
            var tabId = $(this).attr('id');
        
            if($(this).hasClass('opened')){
                if(currTab.hasClass('accordion') || $(window).width() < 767){
                    $(this).removeClass('opened');
                    $('#content_'+tabId).hide();
                }
            }else{
                currTab.find('.tab-title, .tab-title-left').each(function(){
                    var tabId = $(this).attr('id');
                    $(this).removeClass('opened');
                    $('#content_'+tabId).hide();
                });
                $('#content_'+tabId).show();
                $(this).addClass('opened');
            }
        });
    });
    
    
    

    // **********************************************************************// 
    // ! Categories Accordion
    // **********************************************************************// 

    var plusIcon = '+';
    var minusIcon = '&ndash;';
    if(catsAccordion) {
        var etCats = $('.product-categories');
        var openerHTML = '<div class="open-this">'+plusIcon+'</div>';

        etCats.find('>li').has('.children').has('li').addClass('parent-level0').prepend(openerHTML);

        if($('.current-cat.parent-level0, .current-cat-parent').length > 0) {
            $('.current-cat.parent-level0, .current-cat-parent').find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
        } else {
            etCats.find('>li').first().find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
        }

        etCats.find('.open-this').click(function() {
            if($(this).parent().hasClass('opened')) {
                $(this).html(plusIcon).parent().removeClass('opened').find('ul.children').slideUp(200);
            }else {
                $(this).html(minusIcon).parent().addClass('opened').find('ul.children').slideDown(200);
            }
        });
    }

    // **********************************************************************// 
    // ! Toggle elements
    // **********************************************************************// 


    var etoggle = $('.toggle-block');
    var etoggleEl = etoggle.find('.toggle-element');


    etoggleEl.first().addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').show();

    etoggleEl.click(function(e) {
        e.preventDefault();
        if($(this).hasClass('opened')) {
            $(this).removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
        }else {
            if($(this).parent().hasClass('noMultiple')){
                $(this).parent().find('.toggle-element').removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
            }
            $(this).addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').slideDown(200);
        }
    });


    // **********************************************************************// 
    // ! Mobile navigation
    // **********************************************************************// 

    var navList = $('.mobile-nav div > ul');
    var etOpener = '<span class="open-child">(open)</span>';
    navList.addClass('et-mobile-menu');
    
    navList.find('li:has(ul)',this).each(function() {
        $(this).prepend(etOpener);
    })
    
    navList.find('.open-child').click(function(){
        if ($(this).parent().hasClass('over')) {
            $(this).parent().removeClass('over').find('>ul').slideUp(200);
        }else{
            $(this).parent().parent().find('>li.over').removeClass('over').find('>ul').slideUp(200);
            $(this).parent().addClass('over').find('>ul').slideDown(200);
        }
    });
    
    $('.menu-icon, .close-mobile-nav').click(function(event) {
        if(!$('body').hasClass('mobile-nav-shown')) {
            $('body').addClass('mobile-nav-shown', function() {
                // Hide search input on click
                setTimeout(function(){
                    $(document).one("click",function(e) {
                        var target = e.target;
                        if (!$(target).is('.mobile-nav') && !$(target).parents().is('.mobile-nav')) {

                                    $('body').removeClass('mobile-nav-shown');
                        }
                    });  
                }, 111);
            });



        } else{
            $('body').removeClass('mobile-nav-shown');
        }
    });

    // **********************************************************************// 
    // ! Side Block
    // **********************************************************************// 

    $('.side-area-icon, .close-side-area').click(function(event) {
        if(!$('body').hasClass('shown-side-area')) {
            $('body').addClass('shown-side-area', function() {
                // Hide search input on click
                setTimeout(function(){
                    $(document).one("click",function(e) {
                        var target = e.target;
                        if (!$(target).is('.side-area') && !$(target).parents().is('.side-area')) {
                            $('body').removeClass('shown-side-area');
                        }
                    });  
                }, 111);
            });
        } else{
            $('body').removeClass('shown-side-area');
        }
    });


	// **********************************************************************// 
	// ! Alerts
	// **********************************************************************// 

	function closeParentBtn(){
	    var closeParentBtn = jQuery('.close-parent');

	    closeParentBtn.click(function(e){
	        closeParent(this);
	    });

		function closeParent(el) {
		    jQuery(el).parent().slideUp(100);
		}
	}

	closeParentBtn();

	// **********************************************************************// 
	// ! Contact Form ajax
	// **********************************************************************// 

	var eForm = $('#contact-form');
    var spinner = jQuery('.spinner');

    $('.required-field').focus(function(){
        $(this).removeClass('validation-failed');
    });

	eForm.find('#submit').click(function(e){
		e.preventDefault();
        $('#contactsMsgs').html('');
        spinner.show();
        var errmsg;
        errmsg = '';

        eForm.find('.required-field').each(function(){
            if($(this).val() == '') {       
                    $(this).addClass('validation-failed');
                }
        });

        if(errmsg){
            $('#contactsMsgs').html('<p class="error">' + errmsg + '</p>');
            spinner.hide();
        }else{
            
            url = eForm.attr('action');
            
            data = eForm.serialize();
                   
            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                error: function(data) {
                    $('#contactsMsgs').html('<p class="error">Error while ajax request<span class="close-parent"></span></p>');
                    spinner.hide();
                },
                success : function(data){
                	if (data.status == 'success') {
                    	$('#contactsMsgs').html('<p class="success">' + data.msg + '<span class="close-parent"></span></p>');
                    	eForm.find("input[type=text], textarea").val("");
                	}else{
                    	$('#contactsMsgs').html('<p class="error">' + data.msg + '<span class="close-parent"></span></p>');
                	}
                    spinner.hide();
					closeParentBtn();
                }
            });
            
        }

	});

	// **********************************************************************// 
	// ! Custom Comment Form Validation
	// **********************************************************************// 
	var ethemeCommentForm = $('#commentform');

	ethemeCommentForm.find('#submit').click(function(e){
		$('#commentsMsgs').html('');

		ethemeCommentForm.find('.required-field').each(function(){
			if($(this).val() == '') { 
				$(this).addClass('validation-failed');
				e.preventDefault();
			}	
		});

	});
    // **********************************************************************// 
    // ! Load in view 
    // **********************************************************************// 
    
    var progressBars = $('.progress-bars');
        progressBars.waypoint(function() {
            i = 0;
            $(this).find('.progress-bar').each(function () {
                i++;
                
                var el = $(this);
                var width = $(this).data('width');
                setTimeout(function(){
                    el.find('div').animate({
                        'width' : width + '%'
                    },400);
                    el.find('span').css({
                        'opacity' : 1
                    });
                },i*300, "easeOutCirc");
            
            });
        }, { offset: '85%' });

    $('.progress-bar').each(function() {
        if(!$(this).parent().hasClass('progress-bars')) {
            var width = $(this).data('width');
            $(this).find('div').animate({
                'width' : width + '%'
            },400);
            $(this).find('span').css({
                'opacity' : 1
            });
        }
    });
    // helper hex to rgb
    function componentToHex(c) {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    function rgbToHex(r, g, b) {
        return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
    }

    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

}); // document ready