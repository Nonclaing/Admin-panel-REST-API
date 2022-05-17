<?php

namespace App\DataBase;

use PDO;

// Клас базы данных
class DB
{
	private static ?DB $instance = null;

	private ?PDO $link;

	private string $hostName = '';
	private string $userName = '';
	private string $password = '';
	private string $database = '';

    // Конструктор
	private function __construct()
	{
		$this->parseFileDataForDb();

		$this->connect();
	}

	/**
	 * Вытаскивает информацию о доступах к БД
	 *
	 * @return void
	 */
	private function parseFileDataForDb()
	{
		$arEnv = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/.env'));

		$arEnv = array_filter($arEnv);

		$env = [];

		foreach ($arEnv as $item)
		{
			$temp = explode('=', $item);

			if ($temp[1])
			{
				$env[trim($temp[0])] = trim($temp[1]);
			}
		}

		$this->hostName = $env['db-host'];
		$this->userName = $env['db-user'];
		$this->password = $env['db-password'];
		$this->database = $env['db-name'];
	}

	/**
	 * Создаёт подключение к БД
	 *
	 * @return void
	 */
	private function connect()
	{
		try
		{
			$this->link = new PDO(
				'mysql:dbname=' . $this->database . ';host=' . $this->hostName,
				$this->userName,
				$this->password
			);
			$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e)
		{
			echo 'Подключение не удалось: ' . $e->getMessage();
			die();
		}
	}

	/**
	 * Получение объекта класса
	 * @return DB|null
	 */
	public static function getInstance(): ?DB
	{
		if (!self::$instance)
		{
			self::$instance = new DB();
		}

		return self::$instance;
	}

	/**
	 * Получение подключения
	 * @return PDO|null
	 */
	public function getConnection(): ?PDO
	{
		return $this->link;
	}
}