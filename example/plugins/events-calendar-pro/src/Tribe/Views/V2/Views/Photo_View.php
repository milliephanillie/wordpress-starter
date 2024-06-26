<?php
/**
 * The Photo View.
 *
 * @package Tribe\Events\Pro\Views\V2\Views
 * @since 4.7.5
 */

namespace Tribe\Events\Pro\Views\V2\Views;

use Tribe\Events\Views\V2\Utils;
use Tribe\Events\Views\V2\View;
use Tribe\Events\Views\V2\Views\Traits\List_Behavior;
use Tribe__Events__Main as TEC;
use Tribe__Events__Rewrite as Rewrite;
use Tribe__Utils__Array as Arr;
use Tribe\Events\Views\V2\Views\Traits\With_Noindex;

/**
 * Class Photo_View
 */
class Photo_View extends View {
	use List_Behavior;
	use With_Noindex;

	/**
	 * Slug for this view.
	 *
	 * @deprecated 6.0.7
	 *
	 * @var string
	 */
	protected $slug = 'photo';

	/**
	 * Statically accessible slug for this view.
	 *
	 * @since 6.0.7
	 *
	 * @var string
	 */
	protected static $view_slug = 'photo';

	/**
	 * Visibility for this view.
	 *
	 * @since 4.7.5
	 * @since 4.7.9 Made the property static.
	 *
	 * @var bool
	 */
	protected static $publicly_visible = true;

	/**
	 * Default untranslated value for the label of this view.
	 *
	 * @since 6.0.3
	 *
	 * @var string
	 */
	protected static $label = 'Photo';

	/**
	 * @inheritDoc
	 */
	public static function get_view_label(): string {
		static::$label = _x( 'Photo', 'The text label for the Photo View.', 'tribe-events-calendar-pro' );

		return static::filter_view_label( static::$label );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @since 4.9.3
	 *
	 * @param bool  $canonical Whether to return the canonical version of the URL or the normal one.
	 * @param array $passthru_vars An array of query arguments that will be passed thru intact, and appended to the URL.
	 *
	 * @return string The URL associated to this View logical, next view or an empty string if no previous View exists.
	 */
	public function prev_url( $canonical = false, array $passthru_vars = [] ) {
		$cache_key = __METHOD__ . '_' . md5( wp_json_encode( func_get_args() ) );

		if ( isset( $this->cached_urls[ $cache_key ] ) ) {
			return $this->cached_urls[ $cache_key ];
		}

		$current_page = (int) $this->context->get( 'page', 1 );
		$display      = $this->context->get( 'event_display_mode', 'photo' );

		if ( 'past' === $display ) {
			$url = parent::next_url( $canonical, [ Utils\View::get_past_event_display_key() => 'past' ] );
		} elseif ( $current_page > 1 ) {
			$url = parent::prev_url( $canonical );
		} else {
			$url = $this->get_past_url( $canonical );
		}

		$url = $this->filter_prev_url( $canonical, $url );

		$this->cached_urls[ $cache_key ] = $url;

		return $url;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @since 4.9.3
	 *
	 * @param bool  $canonical Whether to return the canonical version of the URL or the normal one.
	 * @param array $passthru_vars An array of query arguments that will be passed thru intact, and appended to the URL.
	 *
	 * @return string The URL associated to this View logical, next view or an empty string if no next View exists.
	 */
	public function next_url( $canonical = false, array $passthru_vars = [] ) {
		$cache_key = __METHOD__ . '_' . md5( wp_json_encode( func_get_args() ) );

		if ( isset( $this->cached_urls[ $cache_key ] ) ) {
			return $this->cached_urls[ $cache_key ];
		}

		$current_page = (int) $this->context->get( 'page', 1 );
		$display      = $this->context->get( 'event_display_mode', 'photo' );

		if ( static::$view_slug === $display || 'default' === $display || $this instanceof $display ) {
			$url = parent::next_url( $canonical );
		} elseif ( $current_page > 1 ) {
			$url = parent::prev_url( $canonical, [ Utils\View::get_past_event_display_key() => 'past' ] );
		} else {
			$url = $this->get_upcoming_url( $canonical );
		}

		$url = $this->filter_next_url( $canonical, $url );

		$this->cached_urls[ $cache_key ] = $url;

		return $url;
	}

	/**
	 * Return the URL to a page of past events.
	 *
	 * @since 4.7.5
	 *
	 * @param bool $canonical Whether to return the canonical version of the URL or the normal one.
	 * @param int  $page The page to return the URL for.
	 *
	 * @return string The URL to the past URL page, if available, or an empty string.
	 */
	protected function get_past_url( $canonical = false, $page = 1 ) {
		$default_date   = 'now';
		$date           = $this->context->get( 'event_date', $default_date );
		$event_date_var = $default_date === $date ? '' : $date;

		$past = tribe_events()->by_args(
			$this->setup_repository_args(
				$this->context->alter(
					[
						'event_display_mode' => 'past',
						'paged'              => $page,
					]
				)
			)
		);

		if ( $past->count() > 0 ) {
			$event_display_key = Utils\View::get_past_event_display_key();
			$query_args        = [
				'post_type'        => TEC::POSTTYPE,
				$event_display_key => 'past',
				'eventDate'        => $event_date_var,
				$this->page_key    => $page,
				'tribe-bar-search' => $this->context->get( 'keyword' ),
			];

			$query_args = $this->filter_query_args( $query_args, $canonical );

			$past_url_object = clone $this->url->add_query_args( array_filter( $query_args ) );

			$past_url = (string) $past_url_object;

			if ( ! $canonical ) {
				return $past_url;
			}

			// We've got rewrite rules handling `eventDate` and `eventDisplay`, but not List. Let's remove it.
			$canonical_url = Rewrite::instance()->get_clean_url(
				add_query_arg(
					[ 'eventDisplay' => static::$view_slug ],
					remove_query_arg( [ 'eventDate' ], $past_url )
				)
			);

			// We use the `eventDisplay` query var as a display mode indicator: we have to make sure it's there.
			$url = add_query_arg( [ $event_display_key => 'past' ], $canonical_url );

			// Let's re-add the `eventDate` if we had one and we're not already passing it with one of its aliases.
			if ( ! (
				empty( $event_date_var )
				|| $past_url_object->get_query_arg_alias_of( 'event_date', $this->context )
			) ) {
				$url = add_query_arg( [ 'eventDate' => $event_date_var ], $url );
			}

			return $url;
		}

		return '';
	}

	/**
	 * Return the URL to a page of upcoming events.
	 *
	 * @since 4.7.5
	 *
	 * @param bool $canonical Whether to return the canonical version of the URL or the normal one.
	 * @param int  $page The page to return the URL for.
	 *
	 * @return string The URL to the upcoming URL page, if available, or an empty string.
	 */
	protected function get_upcoming_url( $canonical = false, $page = 1 ) {
		$default_date   = 'now';
		$date           = $this->context->get( 'event_date', $default_date );
		$event_date_var = $default_date === $date ? '' : $date;

		$upcoming = tribe_events()->by_args(
			$this->setup_repository_args(
				$this->context->alter(
					[
						'eventDisplay' => static::$view_slug,
						'paged'        => $page,
					]
				)
			)
		);

		if ( $upcoming->count() > 0 ) {
			$query_args = [
				'post_type'        => TEC::POSTTYPE,
				'eventDisplay'     => static::$view_slug,
				$this->page_key    => $page,
				'eventDate'        => $event_date_var,
				'tribe-bar-search' => $this->context->get( 'keyword' ),
			];

			$query_args = $this->filter_query_args( $query_args, $canonical );

			$upcoming_url_object = clone $this->url->add_query_args( array_filter( $query_args ) );

			$upcoming_url = (string) $upcoming_url_object;

			if ( ! $canonical ) {
				return $upcoming_url;
			}

			// We've got rewrite rules handling `eventDate`, but not List. Let's remove it to build the URL.
			$url = tribe( 'events.rewrite' )->get_clean_url(
				remove_query_arg( [ 'eventDate', 'tribe_event_display' ], $upcoming_url )
			);

			// Let's re-add the `eventDate` if we had one and we're not already passing it with one of its aliases.
			if ( ! (
				empty( $event_date_var )
				|| $upcoming_url_object->get_query_arg_alias_of( 'event_date', $this->context )
			) ) {
				$url = add_query_arg( [ 'eventDate' => $event_date_var ], $url );
			}

			return $url;
		}

		return '';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @since 4.9.3
	 *
	 * @param Context|null $context A context to use to setup the args, or `null` to use the View Context.
	 *
	 * @return array The arguments, ready to be set on the View repository instance.
	 */
	protected function setup_repository_args( \Tribe__Context $context = null ) {
		if ( is_null( $context ) ) {
			$context = $this->context;
		}

		$args = parent::setup_repository_args( $context );

		$context_arr = $context->to_array();

		$date = Arr::get( $context_arr, 'event_date', 'now' );
		$event_display = Arr::get( $context_arr, 'event_display_mode', Arr::get( $context_arr, 'event_display' ), 'current' );

		// Normalize the `orderby` argument.
		$orderby         = Arr::get_first_set( $args, [ 'orderby', 'order_by' ], [] );
		$orderby         = tribe_normalize_orderby( $orderby );
		$date_key        = isset( $orderby['event_date_utc'] ) ? 'event_date_utc' : 'event_date';
		$args['orderby'] = array_merge( $orderby, [ $date_key, 'event_duration' ] );

		if ( 'past' !== $event_display ) {
			$args['order']       = 'ASC';
			$args['ends_after'] = $date;
		} else {
			$args['order']       = 'DESC';
			$args['ends_before'] = $date;
		}

		return $args;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function setup_template_vars() {
		$template_vars = parent::setup_template_vars();

		$template_vars['placeholder_url'] = trailingslashit( \Tribe__Events__Pro__Main::instance()->pluginUrl )
			. 'src/resources/images/tribe-event-placeholder-image.svg';

		if ( ! empty( $template_vars['events'] ) && 'past' === $this->context->get( 'event_display_mode' ) ) {
			// Past events are fetched by in DESC start date, but shown in ASC order.
			$template_vars['events'] = array_reverse( $template_vars['events'] );
		}

		$template_vars = $this->setup_datepicker_template_vars( $template_vars );

		return $template_vars;
	}

	/**
	 * Overrides the base implementation to remove notions of a "past" events request on page reset.
	 *
	 * @since 4.7.9
	 */
	protected function on_page_reset() {
		parent::on_page_reset();
		$this->remove_past_query_args();
	}
}
