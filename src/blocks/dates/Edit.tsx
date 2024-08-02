import React from '@wordpress/element';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { store as coreDataStore } from '@wordpress/core-data';
import { Spinner } from '@wordpress/components';
import { Flex, FlexItem } from '@wordpress/components';

export default function Edit() {
	const { tourDates, hasResolved } = useSelect( ( select ) => {
		const currentPostId = select( 'core/editor' ).getCurrentPostId();
		const selectorArgs = [ 'postType', 'tour', currentPostId ];
		const acf = select( coreDataStore ).getEntityRecord(
			...selectorArgs
		).acf;
		return {
			tourDates: acf.tour_dates,
			hasResolved: select( coreDataStore ).hasFinishedResolution(
				'getEntityRecord',
				selectorArgs
			),
		};
	}, [] );
	const blockProps = useBlockProps( {
		className: 'wp-block-tour-dates custom-tour-dates',
	} );
	return (
		<Flex direction="column" justify="start" { ...blockProps }>
			{ ! hasResolved && <Spinner /> }
			{ hasResolved &&
				tourDates.map( ( { start_date, end_date, description }, i ) => {
					return (
						<FlexItem key={ i }>
							{ formatDate( start_date ) } —{ ' ' }
							{ formatDate( end_date ) }{ ' ' }
							{ description.length > 0 && (
								<span>({ description })</span>
							) }
						</FlexItem>
					);
				} ) }
		</Flex>
	);
}

/**
 * Formats the date string to a pretty date string.
 * @param date date string as 'YYYYMMDD'
 * @returns pretty date string as 'Month Day, Year'
 */
function formatDate( date: string ): string {
	const year = parseInt( date.substring( 0, 4 ), 10 );
	const month = parseInt( date.substring( 4, 6 ), 10 ) - 1; // Month is zero-based in JavaScript Date
	const day = parseInt( date.substring( 6, 8 ), 10 );
	const d = new Date( year, month, day );
	return d.toLocaleDateString( 'en-US', {
		year: 'numeric',
		month: 'long',
		day: 'numeric',
	} );
}
