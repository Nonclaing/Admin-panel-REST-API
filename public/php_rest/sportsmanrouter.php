<?php

use App\Tables\TypeSportsTable;
use App\Tables\SportsmansTable;
use Silex\Application;

/**
 * Получение
 * @param Application $app
 * @return void
 */
function getSportsmans(Application $app, $json): void
{
    // Гет запрос
	$app->get('/rest/sportsmans/get-list.json', function() use ($app, $json)
	{
        // пытаемся получить
		try
		{
            // Массив фильтра
			$filter = [];

            // Получаем фильтр из запроса
			foreach ($_GET['filter'] as $key => $value)
			{
                // Добавляем фильтр в массив
				$filter['sportsmans.' . $key] = $value;
			}

            // Получаем таблицу спортсменов с фильтром
			$result = SportsmansTable::getDTO(
				[
					'SPORTSMANS_ID' => 'sportsmans.id',
					'SPORTSMANS_NAME' => 'sportsmans.name',
					'SPORTSMANS_PHOTO' => 'sportsmans.photo',
					'SPORTSMANS_BIOGRAPHY' => 'sportsmans.biography',
					'SPORTSMANS_YEAR' => 'sportsmans.year',
					'TYPESPORTS_ID' => 'type_sports.id',
					'TYPESPORTS_NAME' => 'type_sports.name'
				],
				$filter ?? []
			);

            // Возвращаем запрос
			return $app->json($result);
		} catch (Throwable $e) // Ловим ошибки
		{
			return $app->json([
				'error' => [
					'error' => true,
					'error_message' => $e->getMessage()
				]
			])->setStatusCode(500);
		}
	});
}

/**
 * Добавление
 * @param Application $app
 * @return void
 */
function addSportsman(Application $app, $json): void
{
    // Запрос
	$app->post('/rest/sportsmans/add.json', function() use ($app, $json)
	{
        // Пытаемся добавить
		try
		{
            // Если хоть одно поле пустое
			if (
                !mb_strlen(trim($json['name'])) ||
				!mb_strlen(trim($json['photo'])) ||
				!mb_strlen(trim($json['biography'])) ||
				!mb_strlen(trim($json['year'])) ||
				(!mb_strlen(trim($json['type_sport']['id'])) || !intval($json['type_sport']['id']))
			)
			{ // Вернём ошибку
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Не все поля заполнены"
					]
				])->setStatusCode(400);
			}

            // Получаем список
			$data = TypeSportsTable::get(
				['id'],
				[
					'id' => $json['type_sport']['id']
				]
			);

            // Проверяем на существование
			if (!isset($data->fetch(PDO::FETCH_ASSOC)['id']))
			{
				$type_sportId = $json['type_sport']['id'];

				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Спортсмен c id = ${type_sportId} не существует"
					]
				])->setStatusCode(400);
			}

            // Проверяем загружена лиф фотка, которую передаём
			if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $json['photo']))
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Файл не загружен"
					]
				])->setStatusCode(400);
			}

            // Добавляем запись
			SportsmansTable::add([
                'name' => $json['name'],
				'photo' => $json['photo'],
				'biography' => $json['biography'],
				'year' => $json['year'],
				'type_sport_id' => intval($json['type_sport']['id']),
			]);

            // Возвращаем
			return $app->json([
				'item' => SportsmansTable::getLastItem(),
				'error' => [
					'error' => false,
					'error_message' => '',
				]
			]);
		} catch (Throwable $e) // Обработка ошибок
		{
			return $app->json([
				'error' => [
					'error' => true,
					'error_message' => $e->getMessage()
				]
			])->setStatusCode(500);
		}
	});
}

/**
 * Удаление
 * @param Application $app
 * @return void
 */
function deleteSportsman(Application $app, $json): void
{
    // Запрос
	$app->post('/rest/sportsmans/delete.json', function() use ($app, $json)
	{
        // Пытаемся
		try
		{
            // Проверяем на пустой id
			if (!mb_strlen(trim($json['id'])))
			{
				return $app->json([
					'error'=> [
						'error' => true,
						'error_message' => "Пустой id"
					]
				])->setStatusCode(400);
			}

            // Получаем спортсмена
			$data = SportsmansTable::get(
				['ID' => 'sportsmans.id', 'FILE' => 'sportsmans.photo'],
				[
					'sportsmans.id' => $json['id']
				]
			)->fetch(PDO::FETCH_ASSOC);

            // Проверяем на существование спортсмена
			if (!isset($data['ID']) && $data['ID'])
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Такого спортсмена не существует"
					]
				])->setStatusCode(400);
			}

            // Удаляем
			SportsmansTable::delete(intval($json['id']));

            // Проверяем файл и если находим удаляем
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . $data['FILE']))
			{
				unlink($_SERVER['DOCUMENT_ROOT'] . $data['FILE']);
			}

            // Возвращает запрос
			return $app->json([
				'error' => [
					'error' => false,
					'error_message' => ''
				]
			]);
		} catch (Throwable $e) // Обработка ошибок
		{
			return $app->json([
				'error' => [
					'error' => true,
					'error_message' => $e->getMessage()
				]
			])->setStatusCode(500);
		}
	});
}


/**
 * Изменения
 * @param Application $app
 * @return void
 */
function updateSportsman(Application $app, $json): void
{
    // Пост запрос
	$app->post('/rest/sportsmans/update.json', function() use ($app, $json)
	{
        // Пытаемся обновить
		try
		{
            // Если хоть одно поле пустое
			if (
				!mb_strlen(trim($json['id'])) &&
				!mb_strlen(trim($json['name'])) &&
				!mb_strlen(trim($json['photo'])) &&
				!mb_strlen(trim($json['biography'])) &&
				!mb_strlen(trim($json['year'])) &&
				(!mb_strlen(trim($json['type_sport']['id'])) || !intval($json['type_sport']['id']))
			)
			{ // Возвращаем ошибку
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Не все поля заполнены"
					]
				])->setStatusCode(400);
			}

            // Получаем список
			$data = SportsmansTable::get(
				['ID' => 'sportsmans.id', 'FILE' => 'sportsmans.photo'],
				[
					'sportsmans.id' => $json['id']
				]
			)->fetch(PDO::FETCH_ASSOC);

            // Проверяем на существование
			if (!isset($data['ID']) && $data['ID'])
			{
				return $app->json([
					'error' => [
						'error' => true,
						'error_message' => "Вы пытаетесь изменить не существующего спортсмена займ"
					]
				])->setStatusCode(400);
			}

            // Проверяем на существование файла
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . $data['FILE']))
			{
				unlink($_SERVER['DOCUMENT_ROOT'] . $data['FILE']);
			}

            // Обновляем данные
			SportsmansTable::update($json['id'], [
                'name' => $json['name'],
				'photo' => $json['photo'],
				'biography' => $json['biography'],
				'year' => $json['year'],
				'type_sport_id' => intval($json['type_sport']['id'])
			]);

            // Возвращаем запрос
			return $app->json([
				'item' => SportsmansTable::getLastItem(),
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
					'error_message' => $e->getMessage()
				]
			])->setStatusCode(500);
		}
	});
}
