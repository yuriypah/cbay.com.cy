<?php
defined ( 'SYSPATH' ) or die ( 'No direct access allowed.' );
return ( array ) json_decode ( file_get_contents ( "application/i18n/data/el.json" ), true );
return array (
		'button' => array (
				'edit' => 'Редактировать',
				'buy_prestig' => 'Престиж',
				'buy_vip' => 'VIP',
				'buy_color' => 'Выделить',
				'buy_up' => 'Поднять' 
		),
		'pagination' => array (
				'next' => 'Следующая',
				'previous' => 'Предыдущая' 
		),
		'currency' => array (
				'euro' => '&euro;',
				'no_set' => 'Не указана' 
		),
		'package' => array (
				'title' => array (
						'time_left' => array (
								'zero' => 'истекло',
								'one' => 'истекает через :days день',
								'few' => 'истекает через :days дня',
								'many' => 'истекает через :days дней' 
						),
						'prolong' => 'Продлить' 
				),
				'option' => array (
						'title' => array (
								'finished' => 'Размещение',
								'selected' => 'Выделение',
								'premium' => 'Престиж',
								'top' => 'Поднятие',
								'vip' => 'VIP' 
						) 
				),
				'description' => array (
						'premium' => '<span style="font-weight:bold">Престиж объявление</span> - Престиж-объявление в течение 7 дней показывается на самом заметном месте сайта — в верхней части страниц результатов поиска и выделяется оранжевым цветом.<br> 3.99 euro',
						'vip' => '<span style="font-weight:bold">VIP</span> - объявления в течение 7 дней показываются в специальном VIP-блоке на страницах результатов поиска. <br> 2.99 euro',
						'selected' => '<span style="font-weight:bold">Выделить объявление</span>  - Выделенное объявление в течение 7 дней показывается на странице результатов поиска на специальном оранжевом фоне. При этом оно поднимется в результатах поиска бесплатно.<br> 1.99 euro',
						'top' => '<span style="font-weight:bold">Поднять в поиске</span> - Поднятое объявление поднимается на первое место в результатах поиска, и остается там в течение суток. <br> 0.99 euro' 
				),
				'pay' => array (
						'title' => 'Покупка пакета услуг',
						'package' => 'Пакет',
						'description' => 'Описание',
						'cost' => 'Стоимость',
						'payment' => 'Способы оплаты',
						'success' => 'Услуга успешно оплачена!',
						'cancel' => 'Оплата отменена!' 
				) 
		),
		'message' => array (
				'abuse' => array (
						'spam' => 'Спам, повторяющееся объявление или реклама',
						'cheating' => 'Мошенничество, противозаконные действия',
						'false' => 'Описание или цена не соответствуют действительности',
						'not_found' => 'Товара не существует, или он уже продан',
						'description_contacts' => 'Контактная информация или ссылки в описании',
						'company' => 'Компания, маскирующаяся под частное лицо',
						'other' => 'Другое' 
				),
				'title' => array (
						'message' => 'Сообщение от пользователя. Объявление ":title"' 
				),
				'send' => array (
						'abuse' => 'Спасибо что помогаете улучшать сервис. Ваша жалоба будет рассмотрена в ближайшее время.',
						'message' => 'Вашо письмо отправлено продавцу',
						'draft' => 'Сообщение отправлено в черновики' 
				) 
		),
		'messages_page' => array (
				'title' => 'У вас нет новых сообщений',
				'text' => array (
						'what_is' => 'В данный раздел будут поступать сообщения от пользователей сайта' 
				),
				'inbox_title' => 'У вас нет исходящих сообщений',
				'inbox_text' => array (
						'what_is' => 'В данный раздел будут поступать сообщения отправленные Вами пользователям сайта' 
				),
				'draft_title' => 'У вас нет сообщений в черновиках',
				'darft_text' => array (
						'what_is' => 'В данный раздел будут поступать сообщения отправленные Вами в черновики' 
				),
				'label' => array (
						'check_all' => 'Выделить все',
						'delete_selected' => 'Удалить выделенные',
						'title' => 'Тема',
						'author' => 'Автор',
						'date' => 'Дата',
						'recipient' => 'Получатель',
						'' => '' 
				) 
		),
		'messages' => array (
				'site' => array (
						'sendfriend' => '',
						'message' => '' 
				),
				'email' => array (
						'changeemail' => array (
								'reflink_title' => 'Смена E-mail адреса',
								'reflink' => 'Письмо c информацией по смене E-mail адреса выслано по электронной почте на адрес указанный в профиле',
								'success' => 'E-mail адрес успешно изменен' 
						),
						'forgot_password' => array (
								'title' => 'Восстановление пароля',
								'success' => 'Письмо c информацией по восстановлению пароля выслано по электронной почте на адрес :address',
								'forgotted_title' => 'Новый пароль',
								'forgot_success' => 'Ваш новый пароль выслан по электронной почте на адрес :address' 
						),
						'register' => array (
								'title' => 'От вашего имени подана заявка на регистрацию',
								'registered_title' => 'Вы успешно зарегестрированы',
								'' 
						),
						'name' => 'Cbay - Доска объявлений' 
				),
				'profile' => array (
						'delete' => 'Профиль успешно удален',
						'password_changed' => 'Пароль успешно изменен' 
				),
				'advert' => array (
						'unpublish' => array (
								'title' => 'Вы действительно хотите снять с продажи объявления?',
								'info' => 'Закрытые объявления не показываются другим пользователям. Вы можете повторно открыть закрытые объявления в своём Личном кабинете (раздел «Мои объявления»).',
								'reason_text' => 'Нам важно знать, полезен ли сайт AVITO.ru нашим пользователям. Мы будем очень признательны, если Вы отметите причину закрытия объявления:' 
						),
						'publish' => array (
								'title' => 'Объявление активировано',
								'info' => 'Объявление :title успешно активировано.' 
						) 
				) 
		),
		'index_page' => array (
				'text' => array (
						'slogan' => 'Это частные объявления <br />и объявления компаний о продаже.',
						'tags' => 'Разместив объявление о продаже товара на вашем родном языке, сайт автоматически переведет его на 2 других языка, 
чтобы помочь Вам быстрее продать Ваш товар.',
						'ads_counter' => 'объявлений на сайте',
						'footer' => 'На доске бесплатных объявлений cbay.com.cy продают и покупают самые разные товары. Комнаты и квартиры, стоянки и гаражи, земельные участки и дачи, мотоциклы и автомобили, бытовая техника и мебель, электроника, ноутбуки и компьютеры, фотоаппараты и телефоны, обувь и одежда, кошки и собаки, журналы и книги, велосипеды, лодки, виллы, музыкальные инструменты и многое другое.' 
				) 
		),
		'search' => array (
				'label' => array (
						'keyword' => 'Что ищем?',
						'all_categories' => 'Во всех категориях',
						'only_title' => 'Искать только в названиях',
						'only_with_images' => 'С фото',
						'search_show' => 'расширенный поиск',
						'search_hide' => 'скрыть расширенный поиск',
						'' => '',
						'' => '',
						'' => '',
						'' => '',
						'' => '' 
				) 
		),
		'map' => array (
				'label' => array (
						'city' => 'Город',
						'adverts_in_city' => 'Все объявления в :city',
						'all_adverts' => 'Весь Кипр' 
				),
				'city' => array (
						'nicosia' => 'Никосия',
						'limassol' => 'Лимасол',
						'larnaca' => 'Ларнака',
						'paphos' => 'Пафос',
						'agia_napa' => 'Айя-Напа',
						'kyrenia' => 'Кирения',
						'famagusta' => 'Фамагуста',
						'polis' => 'Полис',
						'protaras' => 'Протарас',
						'paralimni' => 'Паралимни',
						'everywere' => 'Весь Кипр' 
				) 
		),
		'labels' => array (
				'optional' => 'необязательно' 
		),
		'adverts_page' => array (
				'empty' => array (
						'title' => 'Не найдено ни одного объявления',
						'what_is' => 'Не нашли нужное объявление?<br>
Попробуйте поменять условия поиска или посмотрите похожие объявления в  другом городе.' 
				),
				'filter' => array (
						'all' => 'Все',
						'private' => 'Частные',
						'company' => 'Компании',
						'by_price' => 'По цене',
						'by_date' => 'По дате' 
				) 
		),
		'advert' => array (
				'tooltip' => array (
						'password' => 'Введите пароль для  входа в личный кабинет и управления вашими объявлениями (не менее :num символов)',
						'name' => 'Как к Вам обращаться?',
						'email' => 'Ваш e-mail не будет виден другим пользователям, вы будете использовать этот e-mail адрес для входа на сайт',
						'phone' => 'Вы можете ввести несколько номеров, разделив их запятой',
						'allow_mails' => 'Отметьте это поле галочкой, если вы не хотите получать отзывы на ваше объявление на ваш e-mail.
(если ставим галочку в этом поле, напротив телефона загорается слово обязательно)',
						'city' => 'Выберите ваш город',
						'category' => 'Выберите категорию объявления',
						'title' => 'Введите понятный и подробный заголовок, чтобы привлечь внимание к объявлению. Не пишите в название цену и контактную информацию и не используйте слово “продам”.',
						'description' => 'Как можно подроднее опишите  Ваш товар или услугу, во избежание лишних вопросов. Не указывайте в описание телефон, e-mail, ссылки на сайты - для этого есть отдельные поля.',
						'amount' => 'Устанавливайте разумную и не завышенную цену, посмотрите  сколько стоят аналогичные товары. Недорогие товары продаются гораздо быстрее.',
						'language' => 'Выберете язык, на котором будет ваше объявление',
						'images' => 'Добавляйте хорошие, качественные фотографии, которые привлекут больше внимания. Удерживайте “Ctrl” чтобы загрузить несколько фотографий.',
						'premium' => 'Престиж-объявление в течение 7 дней показывается на самом заметном месте сайта — в верхней части страниц результатов поиска и выделяется оранжевым цветом. 3.99 euro',
						'vip' => 'VIP-объявления в течение 7 дней показываются в специальном VIP-блоке на страницах результатов поиска. 2.99 euro',
						'selected' => 'Выделить объявление  - Выделенное объявление в течение 7 дней показывается на странице результатов поиска на специальном оранжевом фоне. При этом оно поднимется в результатах поиска бесплатно. 1.99 euro',
						'top' => 'Поднятое объявление поднимается на первое место в результатах поиска, и остается там в течение суток. 0.99 euro' 
				),
				'label' => array (
						'next' => 'Следующее >',
						'previous' => '< Предыдущее',
						'related' => 'Похожие объявления:',
						'price' => 'Цена: :amount' 
				),
				'form' => array (
						'your_name' => 'Ваше имя',
						'friend_name' => 'Имя друга',
						'friend_email' => 'E-mail друга',
						'your_email' => 'Ваш E-mail',
						'comment' => 'Сообщение',
						'comment_help' => '* не забудьте указать Ваши контактные данные, чтобы автор объявления мог с Вами связаться',
						'send_copy' => 'Отправить мне копию',
						'send' => 'Отправить',
						'abuse_category' => 'Причина',
						'draft' => 'В черновики' 
				),
				'status' => array (
						'moderation' => 'На модерации',
						'published' => 'Опубликовано',
						'deactivated' => 'Снято с продажи',
						'blocked' => array (
								'repost' => 'Повторное размещение',
								'rules' => 'Нарушение правил' 
						),
						'sold' => array (
								'site' => 'Продано через сайт',
								'other' => 'Продано в другом месте' 
						),
						'off' => 'Снято с размещения пользователем' 
				),
				'title' => array (
						'activate' => 'Активировать',
						'deactivate' => ' Снять с публикации',
						'delete' => 'Удалить навсегда' 
				) 
		),
		'advert_page' => array (
				'label' => array (
						'seller' => 'Продавец',
						'send_email' => 'Написать письмо',
						'phone' => 'Телефон',
						'city' => 'Город',
						'show_number' => 'Показать номер',
						'show_on_map' => 'Показать на карте',
						'number' => 'Номер объявления: :num',
						'published' => 'Опубликовано',
						'description' => 'Описание товара:',
						'category' => 'Вид товара:',
						'today' => 'Сегодня',
						'send_email' => 'Написать продавцу',
						'send_friend' => 'Отправить другу',
						'abuse' => 'Пожаловаться',
						'add_bookmarks' => 'Добавить в закладки',
						'remove_bookmarks' => 'Удалить из закладок',
						'price' => 'Цена',
						'shows' => 'Просмотров',
						'shows_today' => 'За сегодня',
						'sell_faster' => 'Хотите продать быстрее?' 
				) 
		),
		'forgot_page' => array (
				'text' => array (
						'info' => 'Если Вы забыли свой пароль, введите адрес электронной почты, который Вы указывали при регистрации, и нажмите на кнопку «Выслать пароль».' 
				),
				'label' => array (
						'username' => 'Логин/E-mail',
						'to_login' => 'Авторизация',
						'send' => ' Выслать пароль' 
				) 
		),
		'suggest' => array (
				'text' => array (
						'info' => 'Выберите интересующий Вас пакет и обьявление к которому его применить' 
				),
				'button' => array (
						'tobuy' => 'Применить' 
				),
				'error' => array (
						'nopack' => 'Выберите пакет',
						'noadvert' => 'Выберите обьявление' 
				) 
		),
		'place' => array (
				'text' => array (
						'info' => 'Перед добавлением на сайт каждое объявление проверяется на соответствие правилам',
						'check' => 'Проверьте объявление. Если всё правильно, нажмите на кнопку «Готово».',
						'advert_added_info' => 'Объявление :advert добавлено на сайт. Оно появится в результатах поиска в течение 30 минут.',
						'advert_added_manage' => 'Также Вы можете управлять своими объявлениями через :url' 
				),
				'title' => array (
						'personal_information' => 'Персональная информация',
						'advert_information' => 'Объявление',
						'register' => 'Придумайте пароль, чтобы управлять объявлением',
						'logged_in' => 'Вы — зарегистрированный пользователь. Введите свой пароль для входа на сайт: ' 
				),
				'label' => array (
						'email' => 'E-mail',
						'name' => 'Ваше имя',
						'phone' => 'Телефон',
						'private' => 'Частное лицо',
						'company' => 'Компания',
						'category' => 'Категория',
						'options' => 'Опции',
						'selected_options' => 'Выбранные опции',
						'title' => 'Название объявления',
						'description' => 'Описание объявления',
						'amount' => 'Цена',
						'images' => 'Фотографии',
						'allow_mails' => 'Я не хочу получать вопросы от покупателей по e-mail',
						'change_name' => 'Сменить имя',
						'change_email' => 'Сменить E-mail адрес',
						'next' => 'Продолжить',
						'reset' => 'Очистить',
						'back' => 'Редактировать',
						'ready' => 'Готово',
						'password' => 'Пароль',
						'confirm_password' => 'Подтверждение пароля',
						'delete' => 'удалить',
						'main_photo' => 'главное фото',
						'suggestion' => 'Хотите ускорить продажу?',
						'package' => 'Пакет',
						'language' => 'Язык' 
				) 
		),
		'profile_page' => array (
				'adverts' => array (
						'title' => 'Вы пока что не создали ни одного объявления',
						'what_is' => 'На этой странице вы можете управлять объявлениями. Все созданные Вами объявления будут отображаться прямо на этой странице. ' 
				),
				'settings' => array (
						'text' => array (
								'password_info' => 'Введите свой текущий пароль, новый пароль и повторите ввод нового пароля, чтобы исключить возможность опечатки.',
								'messages_info' => 'Отметьте сообщения, которые вы хотите получать по электронной почте',
								'delete_info' => 'Если вы хотите удалить свой ​​аккаунт и все объявления, нажмите на кнопку "Перейти к удалению учетной записи."' 
						),
						'title' => array (
								'personal_information' => 'Персональные данные',
								'data' => 'Дата',
								'contacts_information' => 'Контактныя информация',
								'password_change' => 'Смена пароля',
								'messages' => 'Сообщения',
								'delete_profile' => 'Удаление профиля',
								'roles' => ' Роли пользователя' 
						),
						'label' => array (
								'username' => 'Логин',
								'email' => 'E-mail',
								'change_email' => 'Сменить E-mail адрес',
								'registered' => 'Регистрация',
								'profile_type' => 'Тип профиля',
								'delete' => 'Перейти к удалению учетной записи',
								'adverts' => 'Объявлений',
								'wallet' => 'Кошелек',
								'place_advert' => 'Подать объявление',
								'go_to_wallet' => 'Перейти в кошелек',
								'name' => 'Ваше имя',
								'phone' => 'Телефон',
								'current_password' => 'Текущий пароль',
								'new_password' => 'Новый пароль',
								'confirm_password' => 'Подтверждение',
								'notice' => 'Уведомления',
								'remiders' => 'Напоминания',
								'language' => 'Язык сайта',
								'save' => 'Сохранить',
								'change_password' => 'Сменить пароль',
								'type' => array (
										'private' => 'Частное лицо',
										'company' => 'Компания' 
								) 
						) 
				),
				'delete' => array (
						'title' => 'Удаление профиля',
						'text' => 'Если Вы нажмёте на кнопку «Удалить мою учётную запись», то Ваша учётная запись и все Ваши объявления будут удалены. Восстановить учётную запись и объявления будет невозможно. Повторная регистрация и подача объявлений на Ваш текущий e-mail будет также невозможна.',
						'label' => array (
								'warning' => 'Внимание!',
								'confirm' => 'Удалить мою учётную запись' 
						) 
				),
				'changeemail' => array (
						'title' => 'Введите Ваш новый E-mail',
						'label' => array (
								'email' => 'Ваш новый E-mail',
								'change' => 'Сменить адрес' 
						),
						'text' => array (
								'info' => '<p>Если Вы действительно хотите сменить адрес электронной почты, введите Ваш новый e-mail
и нажмите на кнопку «Сменить адрес».</p><p>На этот адрес будет выслано письмо со ссылкой, перейдя по которой Вы подтвердите
изменение e-mail.</p>',
								'refer' => 'Переход по ссылке нужен для подтверждения того, что Вам действительно принадлежит
указанный Вами e-mail.' 
						) 
				) 
		),
		'login_page' => array (
				'tooltip' => array (
						'forgot' => 'Если Вы забыли свой пароль на :domain, введите адрес электронной почты, который Вы указывали при регистрации, и нажмите на кнопку «Выслать пароль», пароль будет выслан Вам на почту в ближайшее время.' 
				),
				'label' => array (
						'username' => 'Логин/Email',
						'password' => 'Пароль',
						'forgot_password' => 'Забыли пароль?',
						'remember' => 'Запомнить меня',
						'login' => 'Войти',
						'register' => ' Зарегистрироваться' 
				) 
		),
		'register_page' => array (
				'tooltip' => array (
						'password' => 'Введите пароль для  входа в личный кабинет и управления вашими объявлениями (не менее :num символов)',
						'name' => 'Как к Вам обращаться?',
						'email' => 'Ваш e-mail не будет виден другим пользователям, вы будете использовать этот e-mail адрес для входа на сайт',
						'phone' => 'Вы можете ввести несколько номеров, разделив их запятой',
						'language' => 'Выбирете удобный для Вас язык',
						'password_repeat' => 'Введите пароль повторно' 
				),
				'text' => array (
						'info' => 'Пожалуйста, заполните форму, и Вы сразу же сможете подавать объявления.' 
				),
				'label' => array (
						'email' => 'E-mail',
						'name' => 'Ваше имя',
						'phone' => 'Телефон',
						'private' => 'Частное лицо',
						'company' => 'Компания',
						'password' => 'Пароль',
						'confirm_password' => 'Подтверждение пароля',
						'register' => 'Зарегистрироваться',
						'language' => 'Язык' 
				),
				'rules' => array (
						'agree' => 'Регистрируясь на сайте, я принимаю пользовательское соглашение',
						'subscribe' => 'Я согласен получать информационные сообщения' 
				) 
		),
		'layout' => array (
				'text' => array (
						'logo_text' => 'Η μεγαλύτερη ιστοσελίδα για δωρεάν αγγελίες σε Κύπρος',
						'slogan' => 'Это частные объявления и объявления компаний о продаже.',
						'tags' => 'Домашние животные, бытовая техника, электроника, недвижимость, автомобили, одежда и многое другое.',
						'counter' => 'объявлений на сайте' 
				) 
		),
		'help' => array (
				'label' => array (
						'general_information' => 'Общая информация',
						'our_rules' => 'Наши правила',
						'rules_of_submission' => 'Правила подачи объявлений',
						'causes_of_blocking' => 'Причины блокировки',
						'main_reason_for_blocking' => 'Основные причины блокировки объявлений и учётных записей',
						'prohibited_goods_list' => 'Перечень запрещённых товаров',
						'registration' => 'Регистрация',
						'is_registration_necessary' => 'Нужна ли регистрация, чтобы подать объявление?',
						'how_to_register' => 'Как зарегистрироваться?',
						'how_change_personal_info' => 'Как изменить контактную информацию?',
						'registered_users_rights' => 'Что могут делать зарегистрированные пользователи?',
						'unregistered_users_rights' => 'Что могут делать незарегистрированные пользователи?',
						'registration_on_site' => 'Регистрация на сайте' 
				) 
		),
		'menu' => array (
				'label' => array (
						'advert_place' => 'Подать объявление',
						'advert_finish' => 'Объявление успешно добавлено на сайт',
						'advert_update' => 'Объявление успешно обновлено',
						'register' => 'Регистрация',
						'login' => 'Вход',
						'logout' => 'Выход',
						'adverts' => 'Объявления',
						'bookmarks' => 'Закладки',
						'help' => 'Помощь',
						'profile' => array (
								'index' => 'Личный кабинет',
								'adverts' => 'Мои объявления',
								'wallet' => 'Кошелек',
								'settings' => 'Настройки' 
						),
						'user' => ':name',
						'messages' => array (
								'count' => array (
										'one' => ':count сообщение',
										'few' => ':count новых сообщения',
										'many' => ':count новых сообщений' 
								),
								
								'index' => 'Сообщения',
								'view' => 'Просмотр' 
						),
						'forgot' => 'Восстановление пароля',
						'adverts_footer' => 'Объявления о продаже',
						'categories' => 'Карта категорий',
						'about' => 'О проекте',
						'sitemap' => 'Карта сайта',
						'error' => 'Ошибка',
						'backend' => array (
								'admin' => 'Панель администратора',
								'settings' => 'Настройки',
								'adverts' => 'Объявления',
								'categories' => array (
										'index' => 'Категории',
										'add' => 'Добавить',
										'edit' => 'Редактировать' 
								),
								'users' => array (
										'index' => 'Пользователи',
										'view' => 'Просмотр профиля' 
								),
								'plugins' => 'Плагины',
								'search' => array (
										'index' => 'Поиск',
										'indexer' => 'Индексатор' 
								) 
						),
						'packages_pay' => 'Пакеты услуг' 
				) 
		),
		'bookmarks' => array (
				'title' => 'Что такое закладки?',
				'text' => array (
						'what_is' => 'Теперь Вы можете сохранять понравившиеся объявления в закладках. Для этого на странице объявления нажмите на ссылку «Добавить в закладки». Все отобранные Вами объявления будут отображаться прямо на этой странице. Вы всегда сможете вернуться к ним, нажав на вкладку «Закладки» в верхней части любой страницы сайта.',
						'advert' => array (
								'added' => 'Объявление успешно добавлено в закладки',
								'deleted' => 'Объявление убрано из закладок' 
						) 
				),
				'label' => array (
						'count' => array (
								'one' => ':count объявление',
								'few' => ':count объявления',
								'many' => ':count объявления' 
						),
						'check_all' => 'Выделить все',
						'delete_selected' => 'Удалить выделенные из закладок' 
				) 
		),
		
		'error' => array (
				'text' => 'Такой страницы на нашем сайте нет :( Наверное, Вы ошиблись при наборе адреса или перешли по неверной ссылке. 
Не расстраивайтесь, выход есть!',
				'label' => array (
						'reason' => 'Возможная причина',
						'goto_index_page' => 'Перейти на главную страницу',
						'goto_adverts' => 'Посмотреть все объявления о продаже' 
				) 
		) 
);