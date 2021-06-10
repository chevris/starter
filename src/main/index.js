if ( 'loading' === document.readyState ) {

	// The DOM has not yet been loaded.
	document.addEventListener( 'DOMContentLoaded', initScripts );
} else {

	// The DOM has already been loaded.
	initScripts();
}

/**
 * Initiate scripts when DOM loaded .
 */
 function initScripts() {

	/**
	 * Add listener to the overlay masks, so they can be removed and close drawers.
	 *
	 * @note: Opened drawer must have a class : [slug]-drawer-opened and
	 * the overlay id must be mask-[slug]
	 */
	document.addEventListener( 'click', function( e ) {
		if ( e.target && 'overlay-mask' === e.target.className ) {
			const maskId = e.target.id;
			const drawer = maskId.split( '-' );

			document.body.classList.remove( drawer[ 1 ] + '-drawer-opened' );
			document.documentElement.classList.remove( 'scroll-disabled' );
			document.documentElement.style.removeProperty('margin-right');
			removeOverlay( maskId );
			// force the browser to process the display change first, then the transition
			setTimeout( function() {
				document.getElementById( 'drawer-header-js' ).setAttribute('hidden', '')
			}, 250 );
		}
	});

	initDrawerHeader();
}

/**
 * Handles header drawer.
 */
 function initDrawerHeader() {

	const togglers = document.getElementsByClassName( 'drawer-header-toggle' );
	const siteHeader = document.getElementById( 'masthead' );
	const drawerHeader = document.getElementById( 'drawer-header-js' );

	// No point if no toggler.
	if ( ! togglers.length ) {
		return;
	}

	const drawerCloseButton = drawerHeader.getElementsByClassName( 'drawer-header-toggle' )[ 0 ];
	const headerToggleButton = siteHeader.getElementsByClassName( 'drawer-header-toggle' )[ 0 ];

	/**
	 * Open / close header drawer.
	 *
	 * @note: Opened drawer must have a class : [slug]-drawer-opened and
	 * the overlay id must be mask-[slug]
	 */
	for ( let i = 0; i < togglers.length; i++ ) {
		togglers[ i ].addEventListener(
			'click',
			function(e) {
				e.preventDefault();
				if ( document.body.classList.contains( 'header-drawer-opened' ) ) {
					closeMenu( 'header-drawer-opened', headerToggleButton, 'mask-header' );
					// force the browser to process the display change first, then the transition
					setTimeout( function() {
						drawerHeader.setAttribute('hidden', '');
					}, 300 );
				} else {
					drawerHeader.removeAttribute('hidden');
					// force the browser to process the display change first, then the transition
					setTimeout( function() {
						openMenu( 'header-drawer-opened', drawerCloseButton, 'mask-header' );
					}, 0 );
				}
			},
			false
		);
	}

}

/**
 * @description Opens specifed off-canvas menu.
 * @param {string} openingClass  The class to add to the body to toggle menu visibility.
 * @param {object} focusOnOpen The button used to close the menu on which we focus.
 * @param {string} maskId     The ID to use for the overlay.
 */
 function openMenu( openingClass, focusOnOpen, maskId = '' ) {
	document.body.classList.add( openingClass );
	document.documentElement.style.setProperty( 'margin-right', window.innerWidth - document.documentElement.clientWidth + 'px' );
	document.documentElement.classList.add( 'scroll-disabled' );
	if ( focusOnOpen ) {
		focusOnOpen.focus();
	}
	if ( maskId ) {
		createOverlay( maskId );
	}
}

/**
 * @description Closes specifed slide-out menu.
 * @param {string} openingClass  The class to remove from the body to toggle menu visibility.
 * @param {object} focusOnClose The button used to open the menu on which we focus.
 * @param {string} maskId The ID to use for the overlay.
 */
function closeMenu( openingClass, focusOnClose, maskId = '' ) {
	document.body.classList.remove( openingClass );
	document.documentElement.style.removeProperty('margin-right');
	document.documentElement.classList.remove( 'scroll-disabled' );
	if ( focusOnClose ) {
		focusOnClose.focus();
	}
	if ( maskId ) {
		removeOverlay( maskId );
	}
}

/**
 * @description Creates semi-transparent overlay behind menus.
 * @param {string} maskId The ID to add to the div.
 */
function createOverlay( maskId ) {
	const mask = document.createElement( 'div' );
	mask.setAttribute( 'class', 'overlay-mask' );
	mask.setAttribute( 'id', maskId );
	document.body.appendChild( mask );
}

/**
 * @description Removes semi-transparent overlay behind menus.
 * @param {string} maskId The ID to use for the overlay.
 */
function removeOverlay( maskId ) {
	const mask = document.getElementById( maskId );
	mask.parentNode.removeChild( mask );
}