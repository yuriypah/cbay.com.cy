<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Kohana_Exception extends Kohana_Kohana_Exception {

	public static function handler( Exception $e )
	{
                if (Kohana::DEVELOPMENT === Kohana::$environment)
                {
                    parent::handler($e);
                }
                else
                {
                    try
                    {
                        // Пишем в лог
                        Kohana::$log->add(Log::ERROR, parent::text($e));

                        $attributes = array
                        (
                            'action'  => 500, // Ошибка по умолчанию
                            'message' => rawurlencode($e->getMessage())
                        );
                        // Получаем код ошибки, как название экшена
                        if ($e instanceof HTTP_Exception)
                        {
                            $attributes['action'] = $e->getCode();
                            if($e->getCode() == 404 AND Request::initial()->controller() == 'adverts'){
                                Messages::errors(__('message.abuse.not_found'));
                                Request::initial()->redirect('/adverts');
                            }
                        }
                        // Выполняем запрос, обращаясь к роутеру для обработки ошибок
                        echo Request::factory(Route::get('error')->uri($attributes))
                            ->execute()
                            ->send_headers()
                            ->body();
                    }
                    catch (Exception $e)
                    {
                        // Чистим буфер и выводим текст ошибки
                        ob_get_level() and ob_clean();
                        echo parent::text($e);
                        exit(1);
                    }
                }

		if ( Request::initial() !== NULL AND Request::initial()->is_ajax() )
		{
			$attributes = array(
				'directory' => 'ajax',
				'controller' => 'error',
				'action' => 'index',
				'id' => rawurlencode( $e->getMessage() )
			);

			self::_show_error( $e, $attributes, 'system' );
		}
		elseif ( Model_Setting::get('display_errors') == 'on' OR Kohana::$is_cli )
		{
			parent::handler( $e );
		}
		else
		{
			//parent::handler( $e );
			$attributes = array(
				'message' => rawurlencode( $e->getMessage() )
			);

			self::_show_error( $e, $attributes );
		}
	}

	protected static function _show_error( $error, $attributes, $route = 'error' )
	{
		// Log error
		Kohana::$log->add( Log::ERROR, parent::text( $error ) )->write();

//		try
//		{
			echo Request::factory( Route::url( $route, $attributes ) )
					->execute()
					->send_headers()
					->body();
//		}
//		catch ( Exception $e )
//		{
//			// Clean the output buffer if one exists
//			ob_get_level() and ob_clean();
//
//			// Display the exception text
//			echo parent::text( $e );
//
//			// Log error
//			Kohana::$log->add( Log::ERROR, parent::text( $e ) )->write();
//			// Exit with an error status
//			exit( 1 );
//		}
	}

}