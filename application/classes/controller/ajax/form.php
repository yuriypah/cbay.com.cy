<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Ajax_Form extends Controller_System_Ajax {

	public function action_message()
	{
		echo View::factory( 'advert/form/message');
	}
	
	public function action_sendfriend()
	{
		echo View::factory( 'advert/form/send2friend');
	}
	
	public function action_abuse()
	{
		echo View::factory( 'advert/form/abuse');
	}
    public function action_categoryoptions()
    {
		$id = Input::post('category_id');
        echo "прислан id: ".$id;

/*        $categoryoptions = DB::select('option_id')
			->from('advert_categories_options')
			->where('category_id', '=', $id)
			->execute()
            ->as_array(NULL, 'option_id');
        foreach($categoryoptions as $co){
            $op[$co] = DB::select('id')
                ->from('advert_category_option_values')
                ->where('option_id', '=', $co)
    			->execute()
                ->as_array(NULL, 'id');
        }

            qw($categoryoptions,$op,'al');*/
    }
}