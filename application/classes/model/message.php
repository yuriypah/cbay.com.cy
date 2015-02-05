<?php defined('SYSPATH') or die('No direct script access.');

class Model_Message extends ORM
{

    const STATUS_READ = 1; // Сообщение прочитано
    const STATUS_NEW = 0; // Новое сообщение

    public static $status = array(
        self::STATUS_READ => 'message.status.read',
        self::STATUS_NEW => 'message.status.new',
    );

    protected $_created_column = array(
        'column' => 'created',
        'format' => 'Y-m-d H:i:s'
    );

    protected $_sorting = array(
        'created' => 'desc'
    );

    protected $_has_many = array(
        'users' => array(
            'model' => 'user',
            'foreign_key' => 'user_id'
        ),
    );

    protected $_reload_on_wakeup = FALSE;

    protected $_belongs_to = array(
        'from' => array('model' => 'user', 'foreign_key' => 'from_user_id'),
    );

    public static function abuse($id = NULL)
    {
        $array = array(
            __('message.abuse.spam'),
            __('message.abuse.false'),
            __('message.abuse.cheating'),
            __('message.abuse.not_found'),
            __('message.abuse.description_contacts'),
            __('message.abuse.company'),
            __('message.abuse.other')
        );

        if ($id !== NULL) {
            return Arr::get($array, $id);
        }

        return $array;
    }

    public function read()
    {
        return $this->status == self::STATUS_READ;
    }

    public function created()
    {
        return Date::format($this->created, 'd F Y H:i:s');
    }

    public function viewed()
    {
        return Date::format($this->viewed);
    }

    public function get_one($id, $user)
    {
        return $this
            ->select('messages_users.status')
            ->join('messages_users', 'left')
            ->on($this->object_name() . '.id', '=', 'messages_users.message_id')
            ->and_where_open()
            ->where('messages_users.user_id', '=', (int)$user)
            ->or_where($this->object_name() . '.from_user_id', '=', $user)
            ->and_where_close()
            ->where('messages_users.to_show', '=', 1)
            ->where($this->object_name() . '.id', '=', (int)$id)
            ->find();
    }

    public function get_all($user)
    {
        return DB::select('messages.*', 'messages_users.status')
            ->from($this->table_name())
            ->join('messages_users', 'left')
            ->on($this->table_name() . '.id', '=', 'messages_users.message_id')
            ->select(array('user_profiles.name', 'author'))
            ->join('users', 'left')
            ->on('users.id', '=', $this->table_name() . '.from_user_id')
            ->join('user_profiles', 'left')
            ->on('users.profile_id', '=', 'user_profiles.id')
            ->where('messages_users.user_id', '=', (int)$user)
            ->where('messages_users.to_show', '=', 1)
            //->where($this->table_name().'.parent_id', '=', (int) $message_id)
            ->order_by('messages_users.status', 'asc')
            ->order_by('created', 'desc')
            //->cached(3600, FALSE, 'Database::messages::new::'.$user)
            ->as_object('Model_Message')
            ->execute($this->_db);
    }

    public function get_inbox($user)
    {
        return DB::select($this->table_name() . '.*', 'messages_users.status')
            ->from($this->table_name())
            ->join('messages_users', 'left')
            ->on($this->table_name() . '.id', '=', 'messages_users.message_id')
            ->select(array('user_profiles.name', 'author'))
            ->join('users', 'left')
            ->on('users.id', '=', 'messages_users.user_id')
            ->join('user_profiles', 'left')
            ->on('users.profile_id', '=', 'user_profiles.id')
            ->where($this->table_name() . '.from_user_id', '=', (int)$user)
            /* ->where($this->table_name().'.creator_show', '=', 1)*/
            //->where($this->table_name().'.parent_id', '=', (int) $message_id)
            ->order_by('messages_users.status', 'asc')
            ->order_by('created', 'desc')
            //->cached(3600, FALSE, 'Database::messages::new::'.$user)
            ->as_object('Model_Message')
            ->execute($this->_db);
    }

    public function get_drafts($user, $id = '')
    {
        return DB::select('message_drafts.*')
            ->from('message_drafts')
            ->select(array('user_profiles.name', 'author'))
            ->join('users', 'left')
            ->on('users.id', '=', 'message_drafts.to')
            ->join('user_profiles', 'left')
            ->on('users.profile_id', '=', 'user_profiles.id')
            ->where('message_drafts.from_user_id', '=', $user)
            ->where('message_drafts.id', 'LIKE', '%' . $id . '%')
            ->as_object('Model_Message')
            ->execute($this->_db);
    }


    public function send_drafts($description, $title, $advert_id, $name, $email, $from, $to)
    {
        if (!is_array($to)) {
            $to = array($to);
        }

        if (!empty($to)) {
            if ($from !== NULL) $to[] = $from;
            $to = array_unique($to);

            $data = array(
                'created' => date('Y-m-d H:i:s'),
                'description' => $description,
                'title' => $title,
                'advert_id' => $advert_id,
                'from_user_id' => $from,
                'to' => $to,
                'email' => $email,
                'name' => $name
            );

            list($message_id, $rows) = DB::insert('message_drafts')
                ->columns(array_keys($data))
                ->values($data)
                ->execute($this->_db);

            if ($message_id) {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function send($title = '', $text, $from = NULL, $to, $to_from = TRUE)
    {
        if (!is_array($to)) {
            $to = array($to);
        }

        if (!$from) {
            $from = NULL;
        } elseif ($from instanceof Model_User) {
            $from = $from->id;
        }

        if (!empty($to)) {
            if ($from !== NULL AND $to_from === TRUE) $to[] = $from;
            $to = array_unique($to);

            $data = array(
                'created' => date('Y-m-d H:i:s'),
                'text' => $text,
                'title' => $title,
                'from_user_id' => $from
            );

            list($message_id, $rows) = DB::insert($this->table_name())
                ->columns(array_keys($data))
                ->values($data)
                ->execute($this->_db);

            if ($message_id) {
                $insert = DB::insert('messages_users')
                    ->columns(array('status', 'user_id', 'message_id'));

                foreach ($to as $id) {
                    $insert->values(array(
                        'status' => self::STATUS_NEW,
                        'user_id' => (int)$id,
                        'message_id' => $message_id
                    ));

                    self::clear_cache($id);
                    Observer::notify('send_message', (int)$id, $text);
                }

                $insert->execute($this->_db);

                return TRUE;
            }
        }

        return FALSE;
    }

    public function mark_read($user)
    {
        $user = (int)$user;

        if (!$this->loaded()) {
            throw new HTTP_Exception_404('Message not loaded');
        }

        if ($this->read()) {
            return $this;
        }

        DB::update('messages_users')
            ->where('user_id', '=', $user)
            ->where('message_id', '=', $this->id)
            ->set(array(
                'status' => self::STATUS_READ
            ))
            ->execute($this->_db);

        self::clear_cache($user);
        return $this;
    }

    public function inbox_read($id, $user)
    {
        $user = (int)$user;
        self::clear_cache($user);
        $res = DB::select($this->table_name() . '.*', 'messages_users.status')
            ->from($this->table_name())
            ->join('messages_users', 'left')
            ->on($this->table_name() . '.id', '=', 'messages_users.message_id')
            ->select(array('user_profiles.name', 'recipient'))
            ->join('users', 'left')
            ->on('users.id', '=', 'messages_users.user_id')
            ->join('user_profiles', 'left')
            ->on('users.profile_id', '=', 'user_profiles.id')
            ->where($this->table_name() . '.from_user_id', '=', (int)$user)

            ->where($this->table_name() . '.id', '=', (int)$id)
            //->where($this->table_name().'.parent_id', '=', (int) $message_id)

            ->order_by('created', 'desc')
            //->cached(3600, FALSE, 'Database::messages::new::'.$user)
            ->as_object('Model_Message')
            ->execute($this->_db);
        if ($res->count() == 0)
            return false;
        return $res[0];
    }

    public function count_new($user)
    {
        return DB::select(array(DB::expr('COUNT(*)'), 'total'))
            ->from('messages_users')
            ->where('status', '=', self::STATUS_NEW)
            ->where('user_id', '=', $user)
            ->cached(3600, FALSE, 'Database::count_messages::' . $user)
            ->execute($this->_db)
            ->get('total', 0);
    }

    public function delete_by_user($user, $message_id)
    {
        if (empty($message_id)) {
            return $this;
        }

        $delete = DB::update('messages_users')
            ->set(array('to_show' => 0))
            ->where('user_id', '=', (int)$user);

        if (is_array($message_id)) {
            $delete->where('message_id', 'in', $message_id);
        } else {
            $delete->where('message_id', '=', (int)$message_id);
        }

        $delete->execute($this->_db);

        self::clear_cache($user);

        return $this;
    }

    public function delete_inbox($user, $message_id)
    {
        if (empty($message_id)) {
            return $this;
        }

        $delete = DB::update($this->table_name())
            ->set(array('creator_show' => 0))
            ->where('from_user_id', '=', (int)$user);

        if (is_array($message_id)) {
            $delete->where('id', 'in', $message_id);
        } else {
            $delete->where('id', '=', (int)$message_id);
        }

        $delete->execute($this->_db);

        self::clear_cache($user);

        return $this;
    }

    public function delete_drafts($user, $message_id)
    {
        if (empty($message_id)) {
            return $this;
        }

        $delete = DB::delete('message_drafts')
            ->where('from_user_id', '=', (int)$user);

        if (is_array($message_id)) {
            $delete->where('id', 'in', $message_id);
        } else {
            $delete->where('id', '=', (int)$message_id);
        }

        $delete->execute($this->_db);

        self::clear_cache($user);

        return $this;
    }

    protected static function clear_cache($user_id)
    {
        Kohana::cache('Database::count_messages::' . $user_id, NULL, -1);
        Kohana::cache('Database::messages::new::' . $user_id, NULL, -1);
    }
}