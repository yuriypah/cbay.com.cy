<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

class Model_Search {

	public function __construct( )
	{
		$this->query = $this->stem_query();

		$this->search();
	}
	
	public static function stem_query($keyword)
	{
		if (Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Search', __FUNCTION__);
		}
		
		$result = '';

		$text = $keyword;
//		$text .= ' '. Text::switch_text($keyword);
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
		
		$type = $tkn->get_type( $keyword );

		if (isset($benchmark)) 
		{
			Profiler::stop($benchmark);
		}
		
		return $result;
	}
}