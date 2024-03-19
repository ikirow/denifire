// /**
//  * File navigation.js.
//  *
//  * Handles toggling the navigation menu for small screens and enables TAB key
//  * navigation support for dropdown menus.
//  */
// (function () {
// 	var container, button, menu, links, i, len;

// 	container = document.getElementById( 'site-navigation' );

// 	if ( !container ) {
// 		return;
// 	}

// 	button = container.getElementsByClassName( 'menu-toggle' )[ 0 ];
// 	if ( 'undefined' === typeof button ) {
// 		return;
// 	}

// 	menu = container.getElementsByTagName( 'ul' )[ 0 ];

// 	// Hide menu toggle button if menu is empty and return early.
// 	if ( 'undefined' === typeof menu ) {
// 		button.style.display = 'none';
// 		return;
// 	}

// 	menu.setAttribute( 'aria-expanded', 'false' );
// 	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
// 		menu.className += ' nav-menu';
// 	}

// 	button.onclick = function () {
// 		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
// 			container.className = container.className.replace( ' toggled', '' );
// 			this.className      = this.className.replace( ' open', '' );
// 			button.setAttribute( 'aria-expanded', 'false' );
// 			menu.setAttribute( 'aria-expanded', 'false' );
// 		} else {
// 			container.className += ' toggled';
// 			this.className += ' open';
// 			button.setAttribute( 'aria-expanded', 'true' );
// 			menu.setAttribute( 'aria-expanded', 'true' );
// 		}
// 	};

// 	// Get all the link elements within the menu.
// 	links = menu.getElementsByTagName( 'a' );

// 	// Each time a menu link is focused or blurred, toggle focus.
// 	for ( i = 0, len = links.length; i < len; i++ ) {
// 		links[ i ].addEventListener( 'focus', toggleFocus, true );
// 		links[ i ].addEventListener( 'blur', toggleFocus, true );
// 	}

// 	/**
// 	 * Sets or removes .focus class on an element.
// 	 */
// 	function toggleFocus() {
// 		var self = this;

// 		// Move up through the ancestors of the current link until we hit .nav-menu.
// 		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

// 			// On li elements toggle the class .focus.
// 			if ( 'li' === self.tagName.toLowerCase() ) {
// 				if ( -1 !== self.className.indexOf( 'focus' ) ) {
// 					self.className = self.className.replace( ' focus', '' );
// 				} else {
// 					self.className += ' focus';
// 				}
// 			}

// 			self = self.parentElement;
// 		}
// 	}

// 	/**
// 	 * Toggles `focus` class to allow submenu access on tablets.
// 	 */
// 	( function ( container ) {
// 		var touchStartFn, i,
// 			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

// 		if ( 'ontouchstart' in window ) {
// 			touchStartFn = function ( e ) {
// 				var menuItem = this.parentNode, i;

// 				if ( !menuItem.classList.contains( 'focus' ) ) {
// 					e.preventDefault();
// 					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
// 						if ( menuItem === menuItem.parentNode.children[ i ] ) {
// 							continue;
// 						}
// 						menuItem.parentNode.children[ i ].classList.remove( 'focus' );
// 					}
// 					menuItem.classList.add( 'focus' );
// 				} else {
// 					menuItem.classList.remove( 'focus' );
// 				}
// 			};

// 			for ( i = 0; i < parentLink.length; ++i ) {
// 				parentLink[ i ].addEventListener( 'touchstart', touchStartFn, false );
// 			}
// 		}
// 	}( container ) );
// })();

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  let container, button, menu, links, i, len;

  container = document.getElementById("site-navigation");

  if (!container) {
    return;
  }

  button = container.getElementsByClassName("menu-toggle")[0];
  if ("undefined" === typeof button) {
    return;
  }

  menu = container.getElementsByTagName("ul")[0];

  // Hide menu toggle button if menu is empty and return early.
  if ("undefined" === typeof menu) {
    button.style.display = "none";
    return;
  }

  menu.setAttribute("aria-expanded", "false");
  if (-1 === menu.className.indexOf("nav-menu")) {
    menu.className += " nav-menu";
  }

  function toggleMenu() {
    if (-1 !== container.className.indexOf("toggled")) {
      container.className = container.className.replace(" toggled", "");
      button.className = button.className.replace(" open", "");
      button.setAttribute("aria-expanded", "false");
      menu.setAttribute("aria-expanded", "false");
    } else {
      container.className += " toggled";
      button.className += " open";
      button.setAttribute("aria-expanded", "true");
      menu.setAttribute("aria-expanded", "true");
    }
  }
  button.addEventListener("click", function (event) {
    toggleMenu();
  });

  /**
   * Toggles `focus` class to allow submenu access on tablets.
   */

  let Link = container.querySelectorAll(
    ".menu-item-has-children > a, .page_item_has_children > a"
  );

  var clickHandler =
    "ontouchstart" in document.documentElement ? "touchstart" : "click";

  function closeAllSubMenus() {
    //Close others
    Array.prototype.forEach.call(Link, function (el, i) {
      if (el.parentNode.classList.contains("focus")) {
        //console.log(el);
        el.parentNode.classList.remove("focus");
      }
    });
  }

  function submenuTogglleHandler() {}

  function toggleSubmenuItems(e) {
    Array.prototype.forEach.call(Link, function (el, i) {
      if (window.innerWidth < 992) {
        let currentEl = el;
        currentEl.addEventListener(
          clickHandler,
          function (event, el) {
            // console.log('event added', currentEl);
            if (!currentEl.parentNode.classList.contains("focus")) {
              if (
                currentEl.parentNode.classList.contains(
                  "menu-item-has-children"
                ) &&
                currentEl.parentNode.classList.contains("current-menu-parent")
              ) {
                event.preventDefault();
                currentEl.parentNode.classList.add("focus");
              } else {
                event.preventDefault();
                //Close others
                closeAllSubMenus();
                currentEl.parentNode.classList.add("focus");
              }
            } else {
              event.preventDefault();
              console.log(currentEl);
              currentEl.parentNode.classList.remove("focus");
            }
          },
          false
        );
      }
    });
  }

  window.addEventListener("load", function () {
    if (window.innerWidth > 992) {
      window.addEventListener("resize", toggleSubmenuItems);
    } else {
      toggleSubmenuItems();
    }
  });
})();
