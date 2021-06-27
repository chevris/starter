import MicroModal from 'micromodal';

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

	initModals();
	initDropdownVerticalMenu();
}

/**
 * Handles modals.
 */
function initModals() {

	MicroModal.init( {
		openClass: 'is-modal-open',
		disableScroll: false, // handled by the modalCallback()
		awaitOpenAnimation: false, // if true, wait end of open animation to focus on an element in the modal.
		awaitCloseAnimation: true, // if true, wait end of close animation before removing modal from DOM
		onShow: modalCallback,
		onClose: modalCallback,
	} );
}

function modalCallback( modalEl ) {

	const htmlElement = document.documentElement;
	const scrollBarWidth = window.innerWidth - htmlElement.clientWidth;
	const triggerButton = document.querySelector( `button[data-micromodal-trigger="${ modalEl.id }"]` );
	const closeButton = modalEl.querySelector( 'button[data-micromodal-close]' );

	// Use aria-hidden to determine the status of the modal, as this attribute is
	// managed by micromodal.
	const isHidden = 'true' === modalEl.getAttribute( 'aria-hidden' );

	triggerButton.setAttribute( 'aria-expanded', ! isHidden );
	closeButton.setAttribute( 'aria-expanded', ! isHidden );

	// Add a class to indicate a modal is open.
	htmlElement.classList.toggle( 'has-modal-open' );
	! isHidden ? htmlElement.style.setProperty( 'margin-right', scrollBarWidth + 'px' ) : htmlElement.style.removeProperty('margin-right');
}

/**
 * Handles dropdown vertical menus.
 */
function initDropdownVerticalMenu() {

	// Get all dropdown vertical menus.
	const allVerticalMenus = document.querySelectorAll( '.vertical-menu' );

	allVerticalMenus.forEach( ( menu ) => {

		// Get all dropdown buttons in each menu.
		const allDropdowns = menu.querySelectorAll( '.dropdown-toggle' );

		if ( ! allDropdowns.length ) {
			return;
		}

		allDropdowns.forEach( ( dropdown ) => {
			dropdown.addEventListener( 'click', ( e ) => {
				e.preventDefault();
				e.stopPropagation();
				dropdown.setAttribute( 'aria-expanded', 'false' === dropdown.getAttribute( 'aria-expanded' ) ? 'true' : 'false' );
				const section = dropdown.closest( 'section' );
				section.toggleAttribute( 'expanded' );
			});
		});
	});
}

