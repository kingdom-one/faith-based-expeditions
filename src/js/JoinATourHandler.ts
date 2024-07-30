const tourCode: HTMLFormElement = document.getElementById(
	'tour-code'
) as HTMLFormElement;

tourCode.addEventListener( 'submit', async ( ev ) => {
	ev.preventDefault();
	try {
		const code = await getTour( tourCode );
		window.location.href = `/tour/${ code }`;
	} catch ( error ) {
		alert( error.message );
	}
} );

async function getTour( form: HTMLFormElement ) {
	const code = form.querySelector( 'input' ) as HTMLInputElement;
	const response = await fetch( `/wp-json/wp/v2/tour?slug=${ code.value }` );
	if ( ! response.ok ) {
		throw new Error( 'Something went wrong looking up the tour.' );
	}
	const data = await response.json();
	if ( data.length > 0 ) {
		return code.value;
	} else {
		throw new Error(
			'Tour not found. Double check the code and try again.'
		);
	}
}
