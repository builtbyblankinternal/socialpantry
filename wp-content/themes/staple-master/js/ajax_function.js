jQuery(document).ready(function ($) {
            jQuery('.gallerythumbnail .imageContainer:first img').addClass('active_img');
            var imageClicked = $(".first img").addClass('active_img');
            var imgpath = $(".first img").attr('src');
            //var imgpath = $( ".thumb-first" ).attr('data-src',imgpath);
            $('#showimagediv').html('<img src=' + imgpath + '>');
            $('.next-link').on("click", function () {
                $('.active_img').closest('.imageContainer').next().find('img').trigger('click');
            });
            $('img').on("click", function () {
                imageClicked = $(this);
                imgpath = $(this).attr('src');
                // var imgpathsrc = imgpath.replace("-250x250", "");
                var imgpathsrc = $(this).parent().attr('data-src');
                console.log(imgpathsrc);
                $('#showimagediv').html('<img src=' + imgpathsrc + '>');
            });
            $("body").on("click", "img", function () {
                $("img").removeClass('active_img');
                imageClicked = $(this);
                imageClicked = $(this).addClass('active_img');
                imgpath = $(this).attr('src');
                //var imgpathsrc = imgpath.replace("-250x250", "");
                var imgpathsrc = $(this).parent().attr('data-src');
                console.log(imgpathsrc);
                $('#showimagediv').html('<img src=' + imgpathsrc + '>');
            });
            $('.prev-link').on("click", function () {
                imageClicked.closest('.imageContainer').prev().find('img').trigger('click');
            });

 
				

             /*$('#myCarousel').carousel({
                interval: 10000,
            })
        });*/
				  
		});   
		
jQuery(document).ready(function(){
	if( jQuery('#myGalCarousel').length > 0 ){
		jQuery('#myGalCarousel').slick({
		  	slidesToShow: 3,
		  	slidesToScroll: 1,
		 		dots: false,
  			infinite: false,

			}); 
	}
      
});
		
jQuery(document).ready(function(){
	

//Blog page
var ppp = 6; // Post per page
var pageNumber = 1;

jQuery("#more_posts_blog").on("click",function(){ // When btn is pressed.
	pageNumber++;
	 $.ajax({
        type: "POST",
        dataType: "json",
		url: ajax_posts.ajaxurl,
        data: {
			action: 'load_more_posts_blog_call',
			pageNumber: pageNumber,
			ppp: ppp
		},
        success: function(data){
            var jQuerydata = $(data);
			if( data.status == 1 ){
					$.each(data, function(i, item) {
					if( item != 1 ){
						var __html;
		
						
						__html += '<div class="col-sm-4 post-item"><div class="post-item-img"><a href="'+item.permalink+'"><img src="'+item.thumbnail+'"></a> <div class="post-link"><div class="post-link-inner"> <a class="border-btn" href="'+item.permalink+'">READ MORE</a></div></div></div> <div class="post-item-content"><h5><a href="'+item.permalink+'">'+item.title+'</a></h5><p>'+item.excerpt+'</p> </div> </div> ';
						
						jQuery(__html).appendTo(jQuery('.blog-list-2'));
					}
					jQuery('#error-message-rnd').html('');
				});
			} else {
				var __html;
				jQuery('#error-message-rnd').html('No more posts to display');
				
			}
			
            
        },
        error : function(jqXHR, textStatus, errorThrown) {
            //$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			jQuery('#error-message-rnd').html('ERROR: '+ errorThrown);
			
        },
		beforeSend: function(){
			jQuery('#error-message-rnd').html('Loading...');
			
		}

    });
    return false;
});

//press page
var press_ppp = 6; // Post per page
var press_pageNumber = 1;//category-01
jQuery("#more_posts_press").on("click",function(){ // When btn is pressed.
    press_pageNumber++;
	 $.ajax({
        type: "POST",
        dataType: "json",
		url: ajax_posts.ajaxurl,
        data: {
			action: 'load_more_posts_press_callback',
			pageNumber: press_pageNumber,
			ppp: press_ppp,
			//category: jQuery("#ajax_load_more_product").attr('data-category') 
		},
        success: function(data){
            var jQuerydata = $(data);
			if( data.status == 1 ){
					$.each(data, function(i, item) {
					if( item != 1 ){
						var __html;

						__html = '<div class="col-sm-4 post-item"><div class="post-item-img"><a href="'+item.permalink+'"><img src="'+item.thumbnail+'"></a> <div class="post-link"><div class="post-link-inner"><h5><a href="'+item.permalink+'">'+item.title+'</a></h5> <a class="border-btn" href="'+item.permalink+'">READ MORE</a></div></div></div>  </div> ';
						
						jQuery(__html).appendTo(jQuery('.press-item'));
					}
					jQuery('#error-message-rnd').html('');
				});
			} else {
				var __html;
				jQuery('#error-message-rnd').html('No more posts to display');
				
			}
			
            
        },
        error : function(jqXHR, textStatus, errorThrown) {
            //$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			jQuery('#error-message-rnd').html('ERROR: '+ errorThrown);
			
        },
		beforeSend: function(){
			jQuery('#error-message-rnd').html('Loading...');
		}
			
		});
    return false;
});


//protfolio page
var protfolio_ppp = 4; // Post per page
var protfolio_pageNumber = 1;//category-01
jQuery("#more_posts_protfolio").on("click",function(){ // When btn is pressed.
	protfolio_pageNumber++;
	 $.ajax({
        type: "POST",
        dataType: "json",
		url: ajax_posts.ajaxurl,
        data: {
			action: 'load_more_posts_protfolio_callback',
			pageNumber: protfolio_pageNumber,
			ppp: protfolio_ppp
		},
        success: function(data){
            var jQuerydata = $(data);
			if( data.status == 1 ){
					$.each(data, function(i, item) {
					if( item != 1 ){
						var __html;
            
						__html += '<div class="row portfolio-row"><div class="col-sm-6 portfolio-img">';
						if ( item.thumbnail !=  "" ) { 
							__html +='<a href="'+item.permalink+'"><img src="'+item.thumbnail+'"></a>';
						}else{
							__html +='<a href="'+item.permalink+'"><img src="http://placehold.it/550x550"></a>';
						}
						__html +='</div><div class="col-sm-6 portfolio-page-content"><h1 class="portfolio-count"></h1><h2><a href="'+item.permalink+'">'+item.time+'</a></h2></div><div class="about-link-btn"> <a class="link-button" href="'+item.permalink+'">VIEW NOW</a></div></div>';
	
						jQuery(__html).appendTo(jQuery('.portfolio-list'));
					}
					jQuery('#error-message-rnd').html('');
				});
			} else {
				var __html;
				jQuery('#error-message-rnd').html('No more portfolio to display');
				
			}
        },
        error : function(jqXHR, textStatus, errorThrown) {
            //$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			jQuery('#error-message-rnd').html('ERROR: '+ errorThrown);
			
        },
		beforeSend: function(){
			jQuery('#error-message-rnd').html('Loading...');
			
		}

    });
    return false;
});
var uploadID = ''; /*setup the var*/
	
	
	jQuery('.upload-button').click(function() {
        //alert('yes');
		uploadID = jQuery(this).prev('input');  
		formfield = jQuery('.upload').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
		
		return false;
    });
	
	    window.send_to_editor = function(html) {
			
			
			var regex = /src="(.+?)"/;
			var rslt =html.match(regex);
			var imgurl = rslt[1];
	       //var imgurl = jQuery('img',html).attr('src');
		   uploadID.val(imgurl);
	        //jQuery('#testimonial_bg_img_url').val(imgurl);
	        tb_remove();
	    
		}
});

jQuery(document).ready(function(){

	//gallery page
	var gallery_ppp = 6; // Post per page
	var gallery_pageNumber = 1;//category-01
	jQuery("#more_posts_gallery").click(function(){ // When btn is pressed.
	    //$("#more_posts").attr("disabled",true); // Disable the button, temp.
	    //load_posts();
	    console.log('here');
		gallery_pageNumber++;
		 $.ajax({
	        type: "POST",
	        dataType: "json",
			url: ajax_posts.ajaxurl,
	        data: {
				action: 'load_more_posts_gallery_callback',
				pageNumber: gallery_pageNumber,
				exclude: jQuery("#more_posts_gallery").attr('data-exclude'),
				ppp: gallery_ppp,
				//category: jQuery("#ajax_load_more_product").attr('data-category') 
			},
	        success: function(data){
	            var jQuerydata = $(data);
				if( data.status == 1 ){
					var j = 1
						
						$.each(data, function(i, item) {
							console.log(item, typeof item.permalink);

						if( item != 1 &&  typeof item.permalink !== "undefined" ){
							var __html = "";
							__html = '<div class="col-sm-4"> <div class="portfolio-item"> <a href="'+item.permalink+'"> <img width="360" height="440" src="'+item.thumbnail+'" class="attachment-360x440 size-360x440 wp-post-image" alt="stocksy_txpf2f42065kq4100_small_570154">				</a> <div class="port-content"> <div class="port-content-inner"> <h2><a href="'+item.permalink+'">'+item.cat_name+'</a></h2> <a class="border-btn" href="'+item.permalink+'">VIEW NOW</a> </div></div> </div> </div>';
							
							jQuery(__html).appendTo(jQuery('.portfolio-list .row'));
						}
						jQuery('#error-message-rnd').html('');
						jQuery('#more_posts_gallery').attr( 'data-exclude', jQuery('#more_posts_gallery').attr('data-exclude')+','+data.exclude );
					});
				} else {
					var __html;
					jQuery('#error-message-rnd').html('No more items to display');
					
				}
				
	            
	        },
	        error : function(jqXHR, textStatus, errorThrown) {
	            //$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				jQuery('#error-message-rnd').html('ERROR: '+ errorThrown);
				
	        },
			beforeSend: function(){
				jQuery('#error-message-rnd').html('Loading...');
				
			}

	    });
	    return false;
	});
});

