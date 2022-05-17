<?php

namespace App\Tables;

use App\DataBase\DB;
use App\DTO\TypeSport;
use PDOStatement;

// Клас таблицы типов спорта
class TypeSportsTable extends \App\BaseTable
{
    // Получение имени таблицы
	public static function getTableName(): string
	{
		return 'type_sports';
	}

    // Получение join
	protected static function getJoinInfo(): array
	{
		return [];
	}

    // Получение DTO
	public static function getDTO(array $select = [], array $filter = []): array
	{
		$result = [];

        // Получаем результата запроса
		$ob = parent::get(['id', 'name'], $filter);

        // Создаём массив результата
		while ($itm = $ob->fetch(\PDO::FETCH_ASSOC))
		{
			$result[] = new TypeSport($itm['id'], $itm['name']);
		}

        // Возвращаем результат
		return $result;
	}

    // Получение последнего элемента
	public static function getLastItem(): TypeSport
	{
        // Создание запроса
		$sql = 'select id, name from type_sports order by id desc limit 1';

        // Выполнение
		$ob = DB::getInstance()->getConnection()->query($sql)->fetch(\PDO::FETCH_ASSOC);

        // Возврат результата
		return new TypeSport($ob['id'], $ob['name']);
	}
}