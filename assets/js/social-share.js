(function() {
	'use strict';
	var socialLinkClicked = function( e ) {
		e.preventDefault();
        var target = e.target;
        while (target && target.tagName !== 'A') {
          target = target.parentElement;
        }
        
        console.log("Clicked element: ", e.target);
		var url = e.target.href;
        console.log(url);
		var opts   = 'status=1' +
					',titlebar=no' +
		            ',width='  + 575 +
		            ',height=' + 520 +
		            ',top='    + ( window.innerHeight - 520 ) / 2  +
		            ',left='   + ( window.innerWidth - 575 ) / 2;
  		window.open( url, 'share', opts );
	};
	var SocialPop = function() {
		var socialLinks = document.querySelectorAll( '.social_share_wrap a' );
		for(var i = 0, len = socialLinks.length; i < len; i++) {
			socialLinks[i].addEventListener( 'click', socialLinkClicked, false );
		}
	};
	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', SocialPop );
	} else {
		SocialPop();
	}
})();