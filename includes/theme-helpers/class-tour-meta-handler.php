<?php
/**
 * Tour Dates Meta Handler
 * Gets the fields from ACF, performs logic, and provides a simple API for the render function.
 *
 * @package KingdomOne
 * @subpackage ACF
 */

namespace KingdomOne\ACF;

use DateTime;
use DateTimeZone;

/**
 * Class Tour_Meta_Handler
 */
class Tour_Meta_Handler {
	/**
	 * The timezone for the dates. Set in WordPress.
	 *
	 * @var DateTimeZone $timezone
	 */
	private DateTimeZone $timezone;

	/**
	 * The date-time string format for the dates. Set in ACF.
	 *
	 * @var string $date_format
	 */
	private string $date_time_format = 'F j, Y';

	/**
	 * The data from the ACF repeater field.
	 *
	 * @var array $data
	 */
	private array $data;

	/**
	 * Constructor
	 *
	 * @param array $acf_repeater_field The ACF repeater field.
	 */
	public function __construct( array $acf_repeater_field ) {
		$this->timezone = new DateTimeZone( get_option( 'timezone_string' ) );
		$this->data     = $acf_repeater_field;
	}

	/**
	 * Get the dates as a string.
	 *
	 * @param bool $with_description Whether to include the description.
	 * @return string
	 */
	public function get_the_dates( $with_description = true ): string {
		$markup = '';
		foreach ( $this->data as $dates ) {
			$start_date = new DateTime( $dates['start_date'], $this->timezone );
			$end_date   = new DateTime( $dates['end_date'], $this->timezone );
			$markup    .= '<p>' . $this->get_the_date_string( $start_date, $end_date );
			if ( $with_description && ! empty( $dates['description'] ) ) {
				$markup .= ' (' . esc_html( $dates['description'] ) . ')';
			}
			$markup .= '</p>';
		}
		return $markup;
	}

	/**
	 * Echo the dates.
	 *
	 * @param bool $with_description Whether to include the description.
	 */
	public function the_dates( $with_description = true ): void {
		echo wp_kses_post( $this->get_the_dates( $with_description ) );
	}

	/**
	 * Generates a pretty date string from the start and end dates.
	 *
	 * @param DateTime $start The start date.
	 * @param DateTime $end   The end date.
	 * @return string the date string.
	 */
	private function get_the_date_string( DateTime $start, DateTime $end ): string {
		$markup     = '';
		$same_year  = $start->format( 'Y' ) === $end->format( 'Y' );
		$same_month = $start->format( 'F' ) === $end->format( 'F' );
		if ( $same_month && $same_year ) {
			$markup .= $start->format( 'F j' ) . ' &ndash; ' . $end->format( 'j, Y' );
		} elseif ( $same_year ) {
			if ( $same_month ) {
				$markup .= $start->format( 'F j' ) . ' &ndash; ' . $end->format( 'j, Y' );
			} else {
				$markup .= $start->format( 'F j' ) . ' &ndash; ' . $end->format( $this->date_time_format );
			}
		} else {
			$markup .= $start->format( $this->date_time_format ) . ' &ndash; ' . $end->format( $this->date_time_format );
		}
		return $markup;
	}
}
