<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

/**
 * Database query wrapper.  See [Prepared Statements](database/query/prepared) for usage and examples.
 *
 * @package    Kohana/Database
 * @category   Query
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Database_Query extends Kohana_Database_Query {

	protected $_cache_key = NULL;

	/**
	 * Enables the query to be cached for a specified amount of time.
	 *
	 * @param   integer  number of seconds to cache, 0 deletes it from the cache
	 * @param   boolean  whether or not to execute the query during a cache hit
	 * @return  $this
	 * @uses    Kohana::$cache_life
	 */
	public function cached( $lifetime = NULL, $force = FALSE, $key = NULL )
	{
		if ( $lifetime === NULL )
		{
			// Use the global setting
			$lifetime = Kohana::$cache_life;
		}

		$this->_force_execute = $force;
		$this->_lifetime = $lifetime;
		$this->_cache_key = $key;

		return $this;
	}

	public function execute( $db = NULL, $as_object = NULL, $object_params = NULL )
	{
		if ( !is_object( $db ) )
		{
			// Get the database instance
			$db = Database::instance( $db );
		}

		if ( $as_object === NULL )
		{
			$as_object = $this->_as_object;
		}

		if ( $object_params === NULL )
		{
			$object_params = $this->_object_params;
		}

		// Compile the SQL query
		$sql = $this->compile( $db );

		if ( $this->_lifetime !== NULL AND $this->_type === Database::SELECT )
		{
			if ( $this->_cache_key === NULL )
			{
				// Set the cache key based on the database instance name and SQL
				$this->_cache_key = 'Database::query("' . $db . '", "' . $sql . '")';
			}

			// Read the cache first to delete a possible hit with lifetime <= 0
			if ( ($result = Kohana::cache( $this->_cache_key, NULL, $this->_lifetime )) !== NULL
					AND !$this->_force_execute )
			{
				// Return a cached result
				//return new Database_Result_Cached( $result, $sql, $as_object, $object_params );
			}
		}

		// Execute the query
		$result = $db->query( $this->_type, $sql, $as_object, $object_params );

		if ( $this->_cache_key !== NULL AND $this->_lifetime > 0 )
		{
			// Cache the result array
			//Kohana::cache( $this->_cache_key, $result->as_array(), $this->_lifetime );
		}

		return $result;
	}
}
// End Database_Query
