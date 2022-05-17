<?php

use App\Tables\TypeSportsTable;
use Silex\Application;

/**
 * Получение таблицы
 * @param Application $app
 * @return void
 */
function getTypeSports(Application $app, $json): void
{
    // Гет запрос с путём
	$app->get('/rest/typeofsports/get-list.json', function() use ($app, $json)
	{
        // Пытаемся получить таблицы
		try
		{
            // Получение таблицы типов спорта
			$data = TypeSportsTable::getDTO(
				[
					'id', 'name'
				],
				$_GET['filter'] ?? []
			);

			return $app->json($data);
		} catch (Throwable $e) // Если не получилось, возвращаем ошибку
		{
			return $app->json([
                'error' => [
                    'error' => true,
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile() . ':' . $e->getLine(),
                    'error_trace' => $e->getTraceAsString(),
                ]
			])->setStatusCode(500);
		}
	});
}

/**
 * Добавление в таблицу
 * @param Application $app
 * @return void
 */
function addTypeSport(Application $app, $json): void
{
    // Пост запрос с добавлением
	$app->post('/rest/typeofsports/add.json', function() use ($app, $json)
	{
        // Пытаемся добавить
		try
		{
            //Если имя пустое ошибка заполнения
			if (!mb_strlen(trim($json['name'])))
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Не все поля заполнены"
					]
				])->setStatusCode(400);
			}

            // Получаем все типы спорта для проверки
			$data = TypeSportsTable::get(
				['name'],
				[
					'name' => $json['name']
				]
			);

            // Если такой существует, возвращаем ошибку
			if (isset($data->fetch(PDO::FETCH_ASSOC)['name']))
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Такой вид спорта уже существует"
					]
				])->setStatusCode(400);
			}

            // Добавляем тип спорта
			TypeSportsTable::add(['name' => $json['name']]);

            // Получаем последний элемент для возвращения
			$lestItem = TypeSportsTable::getLastItem();

            // Возвращаем запрос
			return $app->json([
				'item' => $lestItem,
				'error' => [
					'error' => false,
					'error_message' => ''
				]
			]);
		} catch (Throwable $e) // Если не получилось возвращаем ошибку
		{
			return $app->json([
                'error' => [
                    'error' => true,
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile() . ':' . $e->getLine(),
                    'error_trace' => $e->getTraceAsString(),
                ]
			])->setStatusCode(500);
		}
	});
}


/**
 * @param Application $app
 * @return void
 */

// Удаление типа спорта
function deleteTypeSport(Application $app, $json): void
{
    // Пост запрос удаления
	$app->post('/rest/typeofsports/delete.json', function() use ($app, $json)
	{
        // Пытаемся удалить
		try
		{
            // Если id создаём ошибку
			if (!mb_strlen(trim($json['id'])))
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Пустой id"
					]
				])->setStatusCode(400);
			}

            // Получаем тип спорта для проверки
			$data = TypeSportsTable::get(
				['id'],
				[
					'id' => $json['id']
				]
			);

            // Если такого нет вернём ошибку
			if (!isset($data->fetch(PDO::FETCH_ASSOC)['id']))
			{

				$type_sportId = $json['id'];

				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Вид спорта c id = ${type_sportId} не существует"
					]
				])->setStatusCode(400);
			}

            // Удаляем элемент
			TypeSportsTable::delete(intval($json['id']));

            // Возвращаем запрос
			return $app->json([
				'error' => [
					'error' => false,
					'error_message' => ''
				]
			]);
		} catch (Throwable $e) // Ловим ошибки и выводим их
		{
			return $app->json([
                'error' => [
                    'error' => true,
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile() . ':' . $e->getLine(),
                    'error_trace' => $e->getTraceAsString(),
                ]
			])->setStatusCode(500);
		}
	});
}

/**
 * Изменение
 * @param Application $app
 * @return void
 */
function updateTypeSport(Application $app, $json): void
{
    // Пост запрос изменения
	$app->post('/rest/typeofsports/update.json', function() use ($app, $json)
	{
        // Пробуем
		try
		{
            // Проверка на пустые данные
			if (!mb_strlen(trim($json['id'])) && !mb_strlen(trim($json['name'])))
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Пустые данные"
					]
				])->setStatusCode(400);
			}

            // Получаем объект для проверки
			$data = TypeSportsTable::get(
				['name'],
				[
					'name' => $json['name']
				]
			);

            // Проверка на существующий
			if (isset($data->fetch(PDO::FETCH_ASSOC)['name']))
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Вы пытаетесь изменить имя на уже существующее"
					]
				])->setStatusCode(400);
			}

            // Апдейтим
			TypeSportsTable::update(
				$json['id'],
				['name' => $json['name']]
			);

            $item = TypeSportsTable::get(
                [
                    'id' => 'type_sports.id',
                    'name' => 'type_sports.name'
                ],
                [
                    'name' => $json['name']
                ]
            )->fetch(PDO::FETCH_ASSOC);

            // Возвращаем запрос
			return $app->json([
				'item' => $item,
				'error' => [
					'error' => false,
					'error_message' => ''
				]
			]);
		} catch (Throwable $e) // Ловим ошибку
		{
			return $app->json([
                'error' => [
                    'error' => true,
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile() . ':' . $e->getLine(),
                    'error_trace' => $e->getTraceAsString(),
                ]
			])->setStatusCode(500);
		}
	});
}