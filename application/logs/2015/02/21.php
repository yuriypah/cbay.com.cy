<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-02-21 12:30:06 --- ERROR: ErrorException [ 1 ]: Class 'Model_User/profile' not found ~ MODPATH\orm\classes\kohana\orm.php [ 37 ]
2015-02-21 12:30:06 --- STRACE: ErrorException [ 1 ]: Class 'Model_User/profile' not found ~ MODPATH\orm\classes\kohana\orm.php [ 37 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 12:30:49 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::changeprofiletype() ~ APPPATH\classes\controller\profile.php [ 145 ]
2015-02-21 12:30:49 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::changeprofiletype() ~ APPPATH\classes\controller\profile.php [ 145 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 12:31:25 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Model_User::changeprofiletype(), called in C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\profile.php on line 145 and defined ~ APPPATH\classes\model\user.php [ 168 ]
2015-02-21 12:31:25 --- STRACE: ErrorException [ 2 ]: Missing argument 1 for Model_User::changeprofiletype(), called in C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\profile.php on line 145 and defined ~ APPPATH\classes\model\user.php [ 168 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\user.php(168): Kohana_Core::error_handler(2, 'Missing argumen...', 'C:\\Servers\\Open...', 168, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\profile.php(145): Model_User->changeprofiletype()
#2 [internal function]: Controller_Profile->action_changeprofiletype()
#3 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Profile))
#4 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#7 {main}
2015-02-21 12:50:41 --- ERROR: Kohana_Exception [ 0 ]: The type property does not exist in the Model_User class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
2015-02-21 12:50:41 --- STRACE: Kohana_Exception [ 0 ]: The type property does not exist in the Model_User class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\views\profile\settings\personal.php(25): Kohana_ORM->__get('type')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#3 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\Servers\OpenServer\domains\test_cbay\application\views\profile\settings.php(6): Kohana_View->__toString()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(228): Kohana_View->render()
#8 C:\Servers\OpenServer\domains\test_cbay\application\views\global\frontend.php(43): Kohana_View->__toString()
#9 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#10 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#11 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\template.php(62): Kohana_View->render()
#12 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(113): Controller_System_Template->after()
#13 [internal function]: Controller_System_Page->after()
#14 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Profile))
#15 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#16 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#17 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#18 {main}
2015-02-21 14:13:47 --- ERROR: Database_Exception [ 1052 ]: Column 'status' in where clause is ambiguous [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `status` = '1' AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 14:13:47 --- STRACE: Database_Exception [ 1052 ]: Column 'status' in where clause is ambiguous [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `status` = '1' AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(500): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(26): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 14:14:36 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'adverts.status' in 'where clause' [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `adverts`.`status` = 0 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 14:14:36 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'adverts.status' in 'where clause' [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `adverts`.`status` = 0 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(500): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(26): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 14:15:38 --- ERROR: Database_Exception [ 1052 ]: Column 'status' in where clause is ambiguous [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `status` = 1 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 14:15:38 --- STRACE: Database_Exception [ 1052 ]: Column 'status' in where clause is ambiguous [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `status` = 1 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(499): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(26): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 14:15:55 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'adverts.status' in 'where clause' [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `adverts`.`status` = 1 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 14:15:55 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'adverts.status' in 'where clause' [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `adverts`.`status` = 1 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(499): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(26): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 14:16:34 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'adverts.status' in 'where clause' [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `adverts`.`status` = 1 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 14:16:34 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'adverts.status' in 'where clause' [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND `adverts`.`status` = 1 AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(499): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(26): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 14:27:29 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::block_user_and_advs() ~ APPPATH\classes\controller\backend\users.php [ 38 ]
2015-02-21 14:27:29 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::block_user_and_advs() ~ APPPATH\classes\controller\backend\users.php [ 38 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 14:27:48 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::block_user_and_advs() ~ APPPATH\classes\controller\backend\users.php [ 38 ]
2015-02-21 14:27:48 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::block_user_and_advs() ~ APPPATH\classes\controller\backend\users.php [ 38 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 14:40:54 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::block_user_and_advs() ~ APPPATH\classes\controller\backend\users.php [ 38 ]
2015-02-21 14:40:54 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::block_user_and_advs() ~ APPPATH\classes\controller\backend\users.php [ 38 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 15:00:12 --- ERROR: Kohana_Exception [ 0 ]: The users property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
2015-02-21 15:00:12 --- STRACE: Kohana_Exception [ 0 ]: The users property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\views\backend\adverts\enabled.php(18): Kohana_ORM->__get('users')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#3 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\Servers\OpenServer\domains\test_cbay\application\views\global\frontend.php(43): Kohana_View->__toString()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#7 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\template.php(62): Kohana_View->render()
#8 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(113): Controller_System_Template->after()
#9 [internal function]: Controller_System_Page->after()
#10 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#11 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#14 {main}
2015-02-21 15:00:49 --- ERROR: Kohana_Exception [ 0 ]: The userstatus property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
2015-02-21 15:00:49 --- STRACE: Kohana_Exception [ 0 ]: The userstatus property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\views\backend\adverts\enabled.php(18): Kohana_ORM->__get('userstatus')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#3 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\Servers\OpenServer\domains\test_cbay\application\views\global\frontend.php(43): Kohana_View->__toString()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#7 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\template.php(62): Kohana_View->render()
#8 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(113): Controller_System_Template->after()
#9 [internal function]: Controller_System_Page->after()
#10 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#11 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#14 {main}
2015-02-21 15:03:27 --- ERROR: Kohana_Exception [ 0 ]: The userstatus property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
2015-02-21 15:03:27 --- STRACE: Kohana_Exception [ 0 ]: The userstatus property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\views\backend\adverts\enabled.php(18): Kohana_ORM->__get('userstatus')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#3 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\Servers\OpenServer\domains\test_cbay\application\views\global\frontend.php(43): Kohana_View->__toString()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#7 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\template.php(62): Kohana_View->render()
#8 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(113): Controller_System_Template->after()
#9 [internal function]: Controller_System_Page->after()
#10 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#11 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#14 {main}
2015-02-21 15:04:43 --- ERROR: Kohana_Exception [ 0 ]: The us property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
2015-02-21 15:04:43 --- STRACE: Kohana_Exception [ 0 ]: The us property does not exist in the Model_Advert class ~ MODPATH\orm\classes\kohana\orm.php [ 612 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\views\backend\adverts\enabled.php(18): Kohana_ORM->__get('us')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#3 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\Servers\OpenServer\domains\test_cbay\application\views\global\frontend.php(43): Kohana_View->__toString()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(61): include('C:\\Servers\\Open...')
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\Servers\\Open...', Array)
#7 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\template.php(62): Kohana_View->render()
#8 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(113): Controller_System_Template->after()
#9 [internal function]: Controller_System_Page->after()
#10 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#11 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#14 {main}
2015-02-21 15:05:26 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Advert as array ~ APPPATH\views\backend\adverts\enabled.php [ 18 ]
2015-02-21 15:05:26 --- STRACE: ErrorException [ 1 ]: Cannot use object of type Model_Advert as array ~ APPPATH\views\backend\adverts\enabled.php [ 18 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 15:20:12 --- ERROR: ErrorException [ 1 ]: Call to a member function labels() on a non-object ~ APPPATH\classes\controller\user.php [ 176 ]
2015-02-21 15:20:12 --- STRACE: ErrorException [ 1 ]: Call to a member function labels() on a non-object ~ APPPATH\classes\controller\user.php [ 176 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 17:39:18 --- ERROR: Database_Exception [ 1241 ]: Operand should contain 1 column(s) [ SELECT `advert_parts`.`title`, `advert_parts`.`description`, `user_profiles`.`name` AS `user`, `users`.`status` AS `user_status`, `advert`.* FROM `adverts` AS `advert` LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`user_profiles`.`id` = `users`.`profile_id`) WHERE `advert`.`moderated` != 0 AND `advert`.`status` = (1, 4) AND `advert_parts`.`locale` = 'ru' ORDER BY `finished` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 17:39:18 --- STRACE: Database_Exception [ 1241 ]: Operand should contain 1 column(s) [ SELECT `advert_parts`.`title`, `advert_parts`.`description`, `user_profiles`.`name` AS `user`, `users`.`status` AS `user_status`, `advert`.* FROM `adverts` AS `advert` LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`user_profiles`.`id` = `users`.`profile_id`) WHERE `advert`.`moderated` != 0 AND `advert`.`status` = (1, 4) AND `advert_parts`.`locale` = 'ru' ORDER BY `finished` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT `advert_...', 'Model_Advert', Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(963): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(922): Kohana_ORM->_load_result(true)
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\backend\adverts.php(43): Kohana_ORM->find_all()
#4 [internal function]: Controller_Backend_Adverts->action_enabled()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 17:39:55 --- ERROR: Database_Exception [ 1241 ]: Operand should contain 1 column(s) [ SELECT `advert_parts`.`title`, `advert_parts`.`description`, `user_profiles`.`name` AS `user`, `users`.`status` AS `user_status`, `advert`.* FROM `adverts` AS `advert` LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`user_profiles`.`id` = `users`.`profile_id`) WHERE `advert`.`moderated` != 0 OR `advert`.`status` = (1, 4) AND `advert_parts`.`locale` = 'ru' ORDER BY `finished` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 17:39:55 --- STRACE: Database_Exception [ 1241 ]: Operand should contain 1 column(s) [ SELECT `advert_parts`.`title`, `advert_parts`.`description`, `user_profiles`.`name` AS `user`, `users`.`status` AS `user_status`, `advert`.* FROM `adverts` AS `advert` LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`user_profiles`.`id` = `users`.`profile_id`) WHERE `advert`.`moderated` != 0 OR `advert`.`status` = (1, 4) AND `advert_parts`.`locale` = 'ru' ORDER BY `finished` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT `advert_...', 'Model_Advert', Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(963): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(922): Kohana_ORM->_load_result(true)
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\backend\adverts.php(43): Kohana_ORM->find_all()
#4 [internal function]: Controller_Backend_Adverts->action_enabled()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 17:49:11 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'HAVING ) ORDER BY `finished` ASC' at line 1 [ SELECT `advert_parts`.`title`, `advert_parts`.`description`, `user_profiles`.`name` AS `user`, `users`.`status` AS `user_status`, `advert`.* FROM `adverts` AS `advert` LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`user_profiles`.`id` = `users`.`profile_id`) WHERE `advert`.`moderated` != 0 AND ((`advert`.`status` = 1) AND `advert_parts`.`locale` = 'ru' HAVING ) ORDER BY `finished` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-21 17:49:11 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'HAVING ) ORDER BY `finished` ASC' at line 1 [ SELECT `advert_parts`.`title`, `advert_parts`.`description`, `user_profiles`.`name` AS `user`, `users`.`status` AS `user_status`, `advert`.* FROM `adverts` AS `advert` LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`user_profiles`.`id` = `users`.`profile_id`) WHERE `advert`.`moderated` != 0 AND ((`advert`.`status` = 1) AND `advert_parts`.`locale` = 'ru' HAVING ) ORDER BY `finished` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT `advert_...', 'Model_Advert', Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(963): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(922): Kohana_ORM->_load_result(true)
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\backend\adverts.php(48): Kohana_ORM->find_all()
#4 [internal function]: Controller_Backend_Adverts->action_enabled()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Backend_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-21 18:32:58 --- ERROR: ErrorException [ 1 ]: Call to a member function get_options() on a non-object ~ APPPATH\classes\controller\packages.php [ 18 ]
2015-02-21 18:32:58 --- STRACE: ErrorException [ 1 ]: Call to a member function get_options() on a non-object ~ APPPATH\classes\controller\packages.php [ 18 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-02-21 18:33:53 --- ERROR: ErrorException [ 1 ]: Call to a member function get_options() on a non-object ~ APPPATH\classes\controller\packages.php [ 18 ]
2015-02-21 18:33:53 --- STRACE: ErrorException [ 1 ]: Call to a member function get_options() on a non-object ~ APPPATH\classes\controller\packages.php [ 18 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}