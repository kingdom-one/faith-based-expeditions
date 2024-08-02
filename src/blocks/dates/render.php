<?php
/**
 * The Tour Dates block
 *
 * @package KingdomOne
 */

use KingdomOne\ACF\Tour_Meta_Handler;
$tour_dates = get_field( 'tour_dates' );
if ( ! $tour_dates ) {
	return;
}
$tour_meta = new Tour_Meta_Handler( $tour_dates );
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php $tour_meta->the_dates(); ?>
</div>
