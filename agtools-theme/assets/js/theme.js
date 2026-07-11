/* Global navigation enhancement. No dependencies. */
( function () {
	const toggle = document.querySelector( '.menu-toggle' );
	const nav = document.querySelector( '.primary-nav' );

	if ( ! toggle || ! nav ) return;

	toggle.addEventListener( 'click', function () {
		const open = this.getAttribute( 'aria-expanded' ) === 'true';
		this.setAttribute( 'aria-expanded', String( ! open ) );
		nav.classList.toggle( 'is-open', ! open );
	} );
}() );
