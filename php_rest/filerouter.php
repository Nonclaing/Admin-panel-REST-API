<?php

use Silex\Application;

/**
 * Загрузка файла
 * @param Application $app
 * @return void
 */
function uploadFile(Application $app): void
{
    // Пост метод
	$app->post('/rest/file/upload', function() use ($app)
	{
        // Если не нашли названия файла выдаём ошибку
		if (!isset($_FILES['file']['name']))
		{
			return $app->json([
				'error' => [
					'error' => true,
					'error_message' => 'Файл не был отправлен'
				]
			])->setStatusCode(400);
		}

        // Создаём новый путь к файлу

        $fileType = explode('.', $_FILES['file']['name']);
		$filePath = '/files/' . md5($_FILES['file']['name'] . time()) . '.' . array_pop($fileType);

        // Загружаем файл
		if (mb_strlen($_FILES['file']['name']) && move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $filePath))
		{
            // Возвращаем запрос
			return $app->json([
				'item' => [
					'file_path' => $filePath,
					'full_file_path' => "http://" . $_SERVER['HTTP_HOST'] . $filePath
				],
				'error' => [
					'error' => false,
					'error_message' => ''
				]
			]);
		}

        // Выдаём ошибку
		return $app->json([
			'error' => [
				'error' => true,
				'error_message' => 'Ошибка загрузки файла'
			]
		])->setStatusCode(415);
	});
}