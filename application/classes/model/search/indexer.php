<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

class Model_Search_Indexer {

	protected $_text;
	protected $_strong_tags = array(
		'strong' => '<strong>',
		'b' => '<b>'
	);
	protected $_tag_rankings = array(
		'strong' => 1,
		'b' => 2
	);

	public function __construct()
	{
		
	}

	protected function _prepare_data( $title, $content = '' )
	{
		if ( is_array( $content ) )
		{
			$content = implode( ' ', $content );
		}
		
		if ( is_array( $title ) )
		{
			$title = implode( ' ', $title );
		}

		$title = UTF8::strtolower( $title );
		$content = UTF8::strtolower( $content );

		$title = $this->_get_ranked_text($title);
		$title = $this->_get_stemmed_text( $title );

		$content = $this->_get_ranked_text($content);		
		$content = $this->_get_stemmed_text( $content );

		return array( $title, $content );
	}

	public function add( $advert_id, $title, $content = '' )
	{
		$advert_id = (int) $advert_id;

		list($title, $content) = $this->_prepare_data( $title, $content );

		$result = DB::select( 'advert_id' )
				->from( 'advert_index' )
				->where( 'advert_id', '=', $advert_id )
				->as_object()
				->execute()
				->current();

		if ( !$result )
		{

			return DB::insert( 'advert_index' )
				->columns( array( 'advert_id', 'title', 'content', 'created_on' ) )
				->values( array(
					$advert_id, $title, $content, date( 'Y-m-d H:i:s' )
				) )
				->execute();
		}
		else
		{
			return $this->update($advert_id, $title, $content);
		}

		return FALSE;
	}

	public function update( $advert_id, $title, $content = "" )
	{
		$advert_id = (int) $advert_id;

		list($title, $content) = $this->_prepare_data( $title, $content );

		return DB::update( 'advert_index' )
			->set( array(
				'title' => $title,
				'content' => $content,
				'updated_on' => date( 'Y-m-d H:i:s' )
			) )
			->where('advert_id', '=', $advert_id)
			->execute();
	}

	public function remove( $advert_id = NULL )
	{
		if ( !Valid::numeric( $advert_id ) )
		{
			return FALSE;
		}

		$query = DB::delete( 'advert_index' );

		if ( is_array( $advert_id ) )
		{
			$query->where( 'advert_id', 'in', $advert_id );
		}
		else if ( $advert_id === NULL )
		{
			
		}
		else
		{
			$query->where( 'advert_id', '=', $advert_id );
		}

		return $query->execute();
	}

	protected function _get_stemmed_text( $text )
	{
		$result = '';

		$text = strip_tags( $text );

		$stop_words = Model_Search_Stopwords::get();

		// Parse original text and stem all words that are not tags
		$tkn = new Model_Search_Tokenizer();
		$tkn->set_text( $text );
		$tkn->stopwords = $stop_words;
		
		$stemmer = new Model_Search_Stemmer($tkn);

		while ( $cur = $tkn->next() )
		{
			$result .= $stemmer->stem($cur);
		}

		return $result;
	}

	protected function _get_ranked_text( $text )
	{
		return $text;
	}
	
	protected static $instances = NULL;

	/**
	 * @return Model_Search_Indexer
	 */
	public static function instance()
	{
		if ( !isset( self::$instances ) )
		{
			self::$instances = new self;
		}

		return self::$instances;
	}

}