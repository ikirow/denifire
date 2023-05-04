(function ( $ ) {
	'use strict';

	$( function () {
		// JS
		const showMoreBtn = $("<div class='show-more-btn'>+</div>")
		let categoryDropDownTrigger = $('#woocommerce_product_categories-2 .cat-item')


		$( document ).ready(function() {
			$('.cat-parent').append(showMoreBtn);
			// $('.current-cat').find('.children').toggleClass('active');
			$('.current-cat > a').toggleClass('active');
		  });
		  
		  showMoreBtn.click(function( event ) {
			
			if($(event.target).parent().children('.children').length > 0 && ($(event.target).is(".cat-parent") || $(event.target).parent().hasClass("cat-parent") )){
			
				if(!$(event.target).hasClass('active')){
					event.preventDefault();
					event.stopPropagation();
					$(event.target).parent().children('.children').toggleClass('active');
					$(event.target).parent().children('a').toggleClass('active');
				}
				
			}				
		  });
	} );

	


})( jQuery ); 

