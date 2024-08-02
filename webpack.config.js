const getWebpackEntryPoints =
	require( '@wordpress/scripts/utils/config' ).getWebpackEntryPoints;
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

const defaultEntries = getWebpackEntryPoints( 'script' )();
const customEntries = {
	global: `./src/index.ts`,
	'utilities/bs-utilities': `./src/styles/utilities/bootstrap-utilities.scss`,
};
const entries = {
	...defaultEntries,
	...customEntries,
};

module.exports = {
	...defaultConfig,
	...{
		entry: entries,
	},
};
