/* Global storefront interactions. No dependencies. */
( function () {
	'use strict';

	const closeAll = function () {
		document.querySelectorAll( '[aria-expanded="true"]' ).forEach( function ( control ) {
			control.setAttribute( 'aria-expanded', 'false' );
		} );
		document.querySelectorAll( '.is-open' ).forEach( function ( element ) {
			element.classList.remove( 'is-open' );
		} );
	};

	const menuToggle = document.querySelector( '.ag-header__menu-toggle' );
	const nav = document.querySelector( '.ag-header__nav' );
	if ( menuToggle && nav ) {
		menuToggle.addEventListener( 'click', function () {
			const open = this.getAttribute( 'aria-expanded' ) === 'true';
			closeAll();
			this.setAttribute( 'aria-expanded', String( ! open ) );
			nav.classList.toggle( 'is-open', ! open );
		} );
	}

	const catalogButton = document.querySelector( '.ag-header__catalog' );
	const megaMenu = document.querySelector( '.ag-mega-menu' );
	if ( catalogButton && megaMenu ) {
		catalogButton.addEventListener( 'click', function () {
			const open = this.getAttribute( 'aria-expanded' ) === 'true';
			closeAll();
			this.setAttribute( 'aria-expanded', String( ! open ) );
			megaMenu.hidden = open;
			megaMenu.classList.toggle( 'is-open', ! open );
		} );
	}

	document.querySelectorAll( '.ag-header__dropdown > button' ).forEach( function ( button ) {
		button.addEventListener( 'click', function () {
			const open = this.getAttribute( 'aria-expanded' ) === 'true';
			closeAll();
			this.setAttribute( 'aria-expanded', String( ! open ) );
			this.parentElement.classList.toggle( 'is-open', ! open );
		} );
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'Escape' ) {
			closeAll();
			if ( megaMenu ) megaMenu.hidden = true;
		}
	} );

	const search = document.querySelector( '[data-ag-search]' );
	if ( search && window.agtoolsHeader ) {
		const input = search.querySelector( 'input[type="search"]' );
		const results = search.querySelector( '.ag-search__results' );
		let timeout;
		let controller;

		input.addEventListener( 'input', function () {
			window.clearTimeout( timeout );
			const term = input.value.trim();
			if ( term.length < 2 ) {
				results.hidden = true;
				results.innerHTML = '';
				return;
			}

			timeout = window.setTimeout( function () {
				if ( controller ) controller.abort();
				controller = new AbortController();
				const data = new URLSearchParams( { action: 'agtools_search_products', nonce: window.agtoolsHeader.nonce, term: term } );
				fetch( window.agtoolsHeader.ajaxUrl, { method: 'POST', body: data, signal: controller.signal } )
					.then( function ( response ) { return response.json(); } )
					.then( function ( response ) {
						results.innerHTML = response.success ? response.data.html : '';
						results.hidden = ! results.innerHTML;
					} )
					.catch( function ( error ) { if ( error.name !== 'AbortError' ) results.hidden = true; } );
			}, 180 );
		} );
	}

	const brandTrack = document.querySelector( '[data-brand-track]' );
	document.querySelectorAll( '[data-brand-scroll]' ).forEach( function ( button ) {
		button.addEventListener( 'click', function () {
			if ( brandTrack ) brandTrack.scrollBy( { left: Number( this.dataset.brandScroll ) * 240, behavior: 'smooth' } );
		} );
	} );
}() );
