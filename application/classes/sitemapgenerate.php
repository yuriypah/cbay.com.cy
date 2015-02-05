<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Sitemapgenerate extends Kohana_Sitemap
{
	public static function build()
	{
                $links = array();
                
		// Создаем экземпляр класса Sitemap.
		$sitemap = new Sitemap;

		// Через этот объект мы будем добавлять все УРЛы к нашей карте.
		$url = new Sitemap_URL;

		// Добавляем необходимые УРЛы к нашей карте сайта

            $adverts = DB::select('id')
                    ->from('adverts')
                    ->where('status','IN', array(Model_Advert::MAILS_ALLOW,  Model_Advert::STATUS_BLOCKED_REPOST))
                    ->execute();
            $static_links = DB::select('url')
                    ->from('sitemap')
                    ->execute();
            foreach ($static_links as $link){
                $links[] = $link['url'];
            }
            foreach ($adverts as $advert){
                $links[] = 'advert/'.$advert['id'];
            }
            
		foreach ($links as $v) // для каждой ссылки в цикле
		{
            $langs = Model_Lang_Part::$languages;
            foreach($langs as $lang => $name){
                $priority = '0.9';
                // Выставляем приоритет индексирования. У меня - для главной страницы - 1, для остальных - 0.9.
                if ($v== '') $priority = '1.0';
                $url->set_loc('http://cbay.com.cy/'.$v.'?lang='.$lang) // Добавляем саму ссылку. У меня в БД они относительные, поэтому я вставляю домен перед ссылкой
                            ->set_last_mod(time()) // Устанавливаем время последнего редактирования. У меня временем последнего редактирования страницы всегда ставится текущее время, чтобы поисковики всегда обновляли индекс
                            ->set_change_frequency('always') // Показываем, что страницу нужно индексировать всегда
                            ->set_priority($priority);
                $sitemap->add($url); // Добавляем ссылку
            }
		}

		// Генерируем xml
		$response = urldecode($sitemap->render());

		//Записываем в файл sitemap.xml в корне сайта
		file_put_contents('sitemap.xml', $response);
	}     
}
?>
