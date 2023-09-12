jQuery(function($){
 
	/*
	 * Load More
	 */
	$('#loadmore').click(function(){
		// eslint-disable-next-line no-undef
 
		$.ajax({
			// eslint-disable-next-line no-undef
			url : cosmos_loadmore_params.ajaxurl, // AJAX handler
			data : {
				'action': 'loadmorebutton', // the parameter for admin-ajax.php
				// eslint-disable-next-line no-undef
				'query': cosmos_loadmore_params.posts, // loop parameters passed by wp_localize_script()
				// eslint-disable-next-line no-undef
				'page' : cosmos_loadmore_params.current_page, // current page
			},
			type : 'POST',
			// eslint-disable-next-line no-undef
			beforeSend : function () {
                $('#loadmore').text('Loading...'); // some type of preloader
                $('#loadmore').addClass('loading'); 
			},
			success : function( posts ){
				if( posts ) {
 
                    $('#loadmore').text( 'Load More' );
                    $('#loadmore').removeClass('loading'); 
					$('#posts_wrap').append( posts ); // insert new posts
					// eslint-disable-next-line no-undef
                    cosmos_loadmore_params.current_page++;
					
					// eslint-disable-next-line no-undef
					if ( cosmos_loadmore_params.current_page == cosmos_loadmore_params.max_page ) 
						$('#loadmore').hide(); // if last page, HIDE the button
 
				} else {
					$('#loadmore').hide(); // if no data, HIDE the button as well
				}
			},
		});
		return false;
	});
	/*
	 * Filter
	 */
	$('#cosmos_filters').submit(function(){
 
		$.ajax({
			// eslint-disable-next-line no-undef
			url : cosmos_loadmore_params.ajaxurl,
			data : $('#cosmos_filters').serialize(), // form data
			dataType : 'json', // this data type allows us to receive objects from the server
			type : 'POST',
			beforeSend : function(){
				$('#cosmos_filters').find('button').text('Searching...');
			},
			success : function( data ){

				// when filter applied:
				// set the current page to 1
				// eslint-disable-next-line no-undef
				cosmos_loadmore_params.current_page = 1;
 
				// set the new query parameters
				// eslint-disable-next-line no-undef
				cosmos_loadmore_params.posts = data.posts;
 
				// set the new max page parameter
				// eslint-disable-next-line no-undef
				cosmos_loadmore_params.max_page = data.max_page;
 
				// change the button label back
				$('#cosmos_filters').find('button').text('Search');
 
				// insert the posts to the container
				$('#posts_wrap').html(data.content);
 
				// hide load more button, if there are not enough posts for the second page
				if ( data.max_page < 2 ) {
					$('#loadmore').hide();
				} else {
					$('#loadmore').show();
				}
			},
		});
 
		// do not submit the form
		return false;
 
	});
 
});