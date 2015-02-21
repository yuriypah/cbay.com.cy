<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User
{

    const PASSWORD_LENGTH = 6;

    protected $_reload_on_wakeup = FALSE;

    protected $_roles = array();

    protected $_belongs_to = array(
        'profile' => array('model' => 'user_profile')
    );

    protected $_has_one = array(
        'reflink' => array('model' => 'user_reflink')
    );

    protected $_has_many = array(
        'user_tokens' => array('model' => 'user_token'),
        'roles' => array('model' => 'role', 'through' => 'roles_users'),
    );

    public function labels()
    {
        $labels = parent::labels();
        return $labels + array(
            'password_confirm' => 'Confirm password',
        );
    }

    public function filters()
    {
        $filters = parent::filters();

        return $filters + array(
            'amount' => array(
                array('floatval')
            ),
            'profile_id' => array(
                array('intval')
            )
        );
    }

    public function adverts_count()
    {
        $count = ORM::factory('advert')
            ->where('user_id', '=', $this->id)
            ->group_by('status')
            ->count_all();

        return $count;
    }

    public function create_user($values, $expected)
    {
        // Validation for passwords
        $extra_validation = Model_User::get_password_validation($values)
            ->rule('password', 'not_empty');
        $user = $this
            ->values($values, $expected)
            ->create($extra_validation);
    }

    public function has_role($role, $all_required = TRUE)
    {
        $status = TRUE;

        if (is_array($role)) {
            $status = (bool)$all_required;

            foreach ($role as $_role) {
                // If the user doesn't have the role
                if (!in_array($_role, $this->_roles)) {
                    // Set the status false and get outta here
                    $status = FALSE;

                    if ($all_required) {
                        break;
                    }
                } elseif (!$all_required) {
                    $status = TRUE;
                    break;
                }
            }
        } else {
            $status = in_array($role, $this->_roles);
        }

        return $status;
    }

    public function roles()
    {
        return $this->_roles;
    }

    public function get_id_by_username($username)
    {
        return DB::select('id')
            ->from($this->_table_name)
            ->where('username', '=', $username)
            ->limit(1)
            ->execute($this->_db)
            ->get('id');
    }

    public function get_role_ids($role_name)
    {
        return DB::select($this->_table_name . '.id')
            ->from($this->_table_name)
            ->join('roles_users', 'left')
            ->on($this->_table_name . '.id', '=', 'roles_users.user_id')
            ->join('roles', 'left')
            ->on('roles.id', '=', 'roles_users.role_id')
            ->where('roles.name', '=', $role_name)
            ->execute($this->_db)
            ->as_array(NULL, 'id');
    }
    public function complete_login()
    {
        $roles = $this->roles->find_all();

        foreach ($roles as $role) {
            $this->_roles[] = $role->name;
        }

        parent::complete_login();
    }

    public function serialize()
    {
        $parameters = array(
            '_primary_key_value', '_object', '_changed', '_loaded', '_saved', '_sorting',
            '_roles'
        );

        // Store only information about the object
        foreach ($parameters as $var) {
            $data[$var] = $this->{$var};
        }

        return serialize($data);
    }

    public function change_email($new_email)
    {
        if (!$this->loaded()) {
            throw new Kohana_Exception(' User mast be loaded');
        }

        $this->email = $new_email;
        return $this->update();
    }

    public function changeprofiletype($profile_type, $user_id)
    {
        DB::update('user_profiles')
            ->set(array(
                'type' => $profile_type
            ))->where('id', '=', $user_id)->execute();
    }

    public function block_user_and_advs($user_id) // заблокировать пользователя
    {
        DB::update('users')
            ->set(array(
                'status' => 0
            ))->where('id', '=', $user_id)->execute();
    }

    public function unblock_user_and_advs($user_id) // разблокировать пользователя
    {
        DB::update('users')
            ->set(array(
                'status' => 1
            ))->where('id', '=', $user_id)->execute();
    }

    public static function get_password_validation($values)
    {
        return Validation::factory($values)
            ->rule('password', 'min_length', array(':value', self::PASSWORD_LENGTH))
            ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
    }
}