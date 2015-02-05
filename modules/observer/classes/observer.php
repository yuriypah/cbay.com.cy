<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

/**
 * Observer
 *
 * @package    Observer
 * @author     ButscH
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
final class Observer {

	static protected $_events = array();

	public static function observe( $events, $callback )
	{
		if(!is_array($events))
		{
			$events = array($events);
		}
		
		$args = array_slice( func_get_args(), 2 );
		
		$key = $callback;
		
		if ( is_array( $callback ) )
		{
			$key = $callback[0];
		}
		
		foreach ( $events as $event )
		{
			if ( !isset( self::$_events[$event] ) )
			{
				self::$_events[$event] = array();
			}
			
			self::$_events[$event][$key] = array($callback, $args);
		}
	}

	public static function stop_observing( $event_name, $callback )
	{
		$key = $callback;
		if ( is_array( $callback ) )
		{
			$key = $callback[0];
		}

		if ( isset( self::$_events[$event_name][$key] ) )
		{
			unset( self::$_events[$event_name][$key] );
		}
	}

	public static function clear_observers( $event_name )
	{
		self::$_events[$event_name] = array();
	}

	public static function get_observer( $event_name )
	{
		return (isset( self::$_events[$event_name] )) ? self::$_events[$event_name] : array();
	}

	/**
	 * If your event does not need to process the return values from any observers use this instead of getObserverList()
	 */
	public static function notify( $event_name )
	{
		$args = array_slice( func_get_args(), 1 ); // removing event name from the arguments

		foreach ( self::get_observer( $event_name ) as $key => $callback )
		{
			if(Kohana::$profiling === TRUE)
			{
				$benchmark = Profiler::start('Observer notify', $event_name);
			}
			
			if ( is_array( $callback[0] ) )
			{
				forward_static_call_array( $callback[0], $args );
			}
			else
			{
				call_user_func_array( $callback[0], array_merge($args, $callback[1]) );
			}
			
			if(isset($benchmark))
			{
				Profiler::stop($benchmark);
			}
		}
		
		
	}
}
