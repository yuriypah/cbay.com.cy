<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-02-12 16:03:29 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC' at line 1 [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND (`advert`.`id` = '145' AND `advert`.`id` = '142' AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() AND `advert`.`category_id` IN ('9', '10', '11', '59', '60', '61') ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-12 16:03:29 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC' at line 1 [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND (`advert`.`id` = '145' AND `advert`.`id` = '142' AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() AND `advert`.`category_id` IN ('9', '10', '11', '59', '60', '61') ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(562): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(27): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-12 16:07:11 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC' at line 1 [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND (`advert`.`id` = '145' AND `advert`.`id` = '142' AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() AND `advert`.`category_id` IN ('9', '10', '11', '59', '60', '61') ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-02-12 16:07:11 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC' at line 1 [ SELECT DISTINCT COUNT(*) AS `records_found` FROM `adverts` AS `advert` LEFT JOIN `map` ON (`map`.`id` = `advert`.`city_id`) LEFT JOIN `users` ON (`users`.`id` = `advert`.`user_id`) LEFT JOIN `user_profiles` ON (`users`.`profile_id` = `user_profiles`.`id`) LEFT JOIN `advert_parts` ON (`advert_parts`.`advert_id` = `advert`.`id`) WHERE `advert_parts`.`locale` = 'ru' AND (`advert`.`id` = '145' AND `advert`.`id` = '142' AND `advert`.`status` IN (0, 1) AND `advert`.`finished` >= NOW() AND `advert`.`category_id` IN ('9', '10', '11', '59', '60', '61') ORDER BY `advert`.`premium` DESC, `advert`.`top` DESC, `advert`.`published` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\application\classes\database\query.php(78): Kohana_Database_MySQL->query(1, 'SELECT DISTINCT...', false, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\modules\orm\classes\kohana\orm.php(1484): Database_Query->execute(Object(Database_MySQL))
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\model\advert.php(562): Kohana_ORM->count_all()
#3 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\adverts.php(27): Model_Advert->find_all_by_filter()
#4 [internal function]: Controller_Adverts->action_index()
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Adverts))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#9 {main}
2015-02-12 17:22:19 --- ERROR: ErrorException [ 2 ]: stream_socket_client():  ~ DOCROOT\modules\email\vendor\swiftmailer\lib\classes\Swift\Transport\StreamBuffer.php [ 271 ]
2015-02-12 17:22:19 --- STRACE: ErrorException [ 2 ]: stream_socket_client():  ~ DOCROOT\modules\email\vendor\swiftmailer\lib\classes\Swift\Transport\StreamBuffer.php [ 271 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'stream_socket_c...', 'C:\\Servers\\Open...', 271, Array)
#1 C:\Servers\OpenServer\domains\test_cbay\modules\email\vendor\swiftmailer\lib\classes\Swift\Transport\StreamBuffer.php(271): stream_socket_client('cbay.com.cy:25', 0, 'php_network_get...', 30, 6, Resource id #267)
#2 C:\Servers\OpenServer\domains\test_cbay\modules\email\vendor\swiftmailer\lib\classes\Swift\Transport\StreamBuffer.php(66): Swift_Transport_StreamBuffer->_establishSocketConnection()
#3 C:\Servers\OpenServer\domains\test_cbay\modules\email\vendor\swiftmailer\lib\classes\Swift\Transport\AbstractSmtpTransport.php(116): Swift_Transport_StreamBuffer->initialize(Array)
#4 C:\Servers\OpenServer\domains\test_cbay\modules\email\vendor\swiftmailer\lib\classes\Swift\Mailer.php(79): Swift_Transport_AbstractSmtpTransport->start()
#5 C:\Servers\OpenServer\domains\test_cbay\modules\email\classes\kohana\email.php(382): Swift_Mailer->send(Object(Swift_Message), Array)
#6 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\profile.php(131): Kohana_Email->send()
#7 [internal function]: Controller_Profile->action_changeemail()
#8 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Profile))
#9 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#12 {main}
2015-02-12 17:42:10 --- ERROR: View_Exception [ 0 ]: The requested view profile/changeprofiletype could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2015-02-12 17:42:10 --- STRACE: View_Exception [ 0 ]: The requested view profile/changeprofiletype could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(137): Kohana_View->set_filename('profile/changep...')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(30): Kohana_View->__construct('profile/changep...', NULL)
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(82): Kohana_View::factory('profile/changep...')
#3 [internal function]: Controller_System_Page->before()
#4 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Profile))
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#8 {main}
2015-02-12 17:42:35 --- ERROR: View_Exception [ 0 ]: The requested view profile/changeprofiletype could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2015-02-12 17:42:35 --- STRACE: View_Exception [ 0 ]: The requested view profile/changeprofiletype could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
--
#0 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(137): Kohana_View->set_filename('profile/changep...')
#1 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\view.php(30): Kohana_View->__construct('profile/changep...', NULL)
#2 C:\Servers\OpenServer\domains\test_cbay\application\classes\controller\system\page.php(82): Kohana_View::factory('profile/changep...')
#3 [internal function]: Controller_System_Page->before()
#4 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Profile))
#5 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\Servers\OpenServer\domains\test_cbay\frameworks\kohana-3.2-master-1\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 C:\Servers\OpenServer\domains\test_cbay\index.php(143): Kohana_Request->execute()
#8 {main}
2015-02-12 18:14:02 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ' ~ APPPATH\views\profile\changeprofiletype.php [ 12 ]
2015-02-12 18:14:02 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ' ~ APPPATH\views\profile\changeprofiletype.php [ 12 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}