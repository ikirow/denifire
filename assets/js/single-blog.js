/**
 * File sinigle-blog.js.
 *
 * Handles sticky subscribe sidebar;
 *
 */
(function () {

	let intervalCount = 0;
	let intervalTimes = 50;
	let checkExistSubscribeSidebar = setInterval(function() {
		if (jQuery('.subscribe_box_sidebar').length) {
			clearInterval(checkExistSubscribeSidebar);

			let pin_sidebar_tl = gsap.timeline({
				scrollTrigger: {
					trigger: '.single-blog',
					start: "top +=90px",
					end: () => `bottom +=${document.querySelector(".subscribe_box_sidebar").clientHeight + 90 }`,
					scrub: 1,
					markers: true,
					pin: document.querySelector(".subscribe_box_sidebar"),
					pinSpacing: false
				}
			})

		}
		if (intervalCount++ === intervalTimes) {
			clearInterval(checkExistSubscribeSidebar);
		}
	}, 100); // check every 100ms

})();
