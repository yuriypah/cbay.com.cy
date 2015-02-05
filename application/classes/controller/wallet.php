<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Wallet extends Controller_System_Page {

	public function action_index()
	{
		$wallet = ORM::factory('wallet')
            ->where('id', '=', $this->ctx->user->id)
            ->find();
        $this->template->content->wallet = $wallet;
	}
}