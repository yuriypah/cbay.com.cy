<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Form_Messages extends Controller_System_Form {
	
	public $auth_required = array('login');

	public function action_actions()
	{
		$data = $this->request->post();

		if(isset($data['delete']))
		{
			return $this->_delete($data);
		}
	}
        
        public function action_delinbox(){
		$data = $this->request->post();

		if(isset($data['delete']))
		{
			return $this->_deleteInbox($data);
		}
        }
        
        public function action_deldrafts(){
		$data = $this->request->post();

		if(isset($data['delete']))
		{
			return $this->_deleteDrafts($data);
		}
        }


        protected function _delete($data)
	{
		ORM::factory('message')
			->delete_by_user($this->ctx->user->id, array_keys(Arr::get($data, 'item', array())));
		
		$this->go_back();
	}
        
        protected function _deleteInbox($data)
	{
		ORM::factory('message')
			->delete_inbox($this->ctx->user->id, array_keys(Arr::get($data, 'item', array())));
		
		$this->go_back();
	}
        
        protected function _deleteDrafts($data){
		ORM::factory('message')
			->delete_drafts($this->ctx->user->id, array_keys(Arr::get($data, 'item', array())));
		
		$this->go_back();
        }
}