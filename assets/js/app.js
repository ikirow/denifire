(function ( $ ) {
	'use strict';

	$( function () {
		// JS
		let categoryDropDownTrigger = $('#woocommerce_product_categories-2 .cat-item')

		$( window ).load(function() {
			$('.current-cat').find('.children').toggleClass('active');
			$('.current-cat > a').toggleClass('active');
		  });
		  
		categoryDropDownTrigger.click(function( event ) {
			
			if($(event.target).parent().children('.children').length > 0 && ($(event.target).is(".cat-parent") || $(event.target).parent().hasClass("cat-parent") )){
			
				if(!$(event.target).hasClass('active')){
					event.preventDefault();
					event.stopPropagation();
					$(event.target).parent().find('.children').toggleClass('active');
					$(event.target).toggleClass('active');
				}
				
			}				
		  });
	} );

	


})( jQuery ); 

