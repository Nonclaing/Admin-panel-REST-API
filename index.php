<?php
error_reporting(null);
ini_set('display_errors', 0);
// Проверка на rest запрос
if (!stristr($_SERVER['REQUEST_URI'], '/rest/'))
{
    // Вёрстка
	include 'index.html';
}
else
{
    // Обработка rest
    // Подключение библиотек
	require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

	// Вынес методы в отдельный файл
	require_once 'php_rest/typesportrouter.php';
	require_once 'php_rest/sportsmanrouter.php';
	require_once 'php_rest/filerouter.php';

	// Проверка на существование папки для файлов
	if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/files'))
	{
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/files');
	}

    // Создание силекса
	$app = new Silex\Application();

	/**
	 * php://input является потоком только для чтения, который позволяет вам читать необработанные данные из тела запроса.
	 */
	$json = json_decode(file_get_contents('php://input'), true);

	getTypeSports($app, $json);
	addTypeSport($app, $json);
	deleteTypeSport($app, $json);
	updateTypeSport($app, $json);

	getSportsmans($app, $json);
	addSportsman($app, $json);
	deleteSportsman($app, $json);
	updateSportsman($app, $json);

	uploadFile($app);

	$app->run();
}