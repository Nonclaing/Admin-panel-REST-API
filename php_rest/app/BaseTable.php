<?php

namespace App;

use App\DataBase\DB;
use PDOStatement;

// Класс таблицы для наследования
abstract class BaseTable
{
    // Получение имени
	abstract public static function getTableName(): string;

    // Получение подключения
	abstract public static function getDTO(): array;

	/**
     * Получение join инфо
	 * @return array{
	 *        table: string,
	 *        this_key: string,
	 *        remote_key: string
	 * }
	 */
	abstract protected static function getJoinInfo(): array;

    // Добавление
	public static function add($values): ?PDOStatement
	{
		$prepare = [];
		$columns = [];

        // Создаём массив значений
		foreach ($values as $column => $value)
		{
			if ($column != 'id')
			{
				$temp = static::getAlias($column);

				$prepare[$temp] = $value;
				$columns[] = $column;
			}
		}

        // Создаём запрос на добавление
		$sql = "insert into " . static::getTableName() . " (" . implode(', ', $columns) . ") values (" . implode(' ,', array_keys($prepare)) . ")";

        // Возвращаем результат выполнения
		return static::exec($sql, $prepare);
	}

    // Получение
	public static function get(array $select = [], array $filter = [])
	{
		$sql = 'select ';
		$prepare = [];

        // Проверяем, есть выбранные поля
		if ($select)
		{
			$countSelect = count($select);
			$counter = 0;

            // Создаём запрос
			foreach ($select as $alias => $column)
			{
				$counter++;
				if (!is_numeric($alias))
				{
					$sql .= " ${column} as ${alias} ";
				}
				else
				{
					$sql .=  " ${column} ";
				}

				if ($counter != $countSelect)
				{
					$sql .= ', ';
				}
			}
		}
		else // Если нет, забираем все поля
		{
			$sql .= "*";
		}

        // Дополняем запрос
		$sql .= " from " . static::getTableName();

        // Если есть join
		if ($join = static::getJoinInfo())
		{
            // Добавляем join к запросу
			$currentTable = static::getTableName();

			$sql .= " join ${join['table']} on ${join['table']}.${join['remote_key']} = ${currentTable}.${join['this_key']}";
		}

        // Если есть фильтр
		if ($filter)
		{
            // Добавляем фильтр
			$sql .= " where ";

			foreach ($filter as $column => $value)
			{
				$temp = static::getAlias($column);

				$prepare[$temp] = $value;

				$sql .= "${column} = ${temp}";
			}
		}

        // Возвращаем результат запроса
		return static::exec($sql, $prepare);
	}

    // Обновление
	public static function update(int $id, array $values): ?PDOStatement
	{
        // Запрос
		$sql = "update " . static::getTableName() . " set ";
		$prepare = [];

		$countSelect = count($values);
		$counter = 0;

        // Создаём запрос из данных
		foreach ($values as $column => $value)
		{
			$counter++;
			$temp = static::getAlias($column);

			$prepare[$temp] = $value;

			$sql .= "${column} = ${temp}";

			if ($counter != $countSelect)
			{
				$sql .= ', ';
			}
		}

		$sql .= " where id = :id";
		$prepare[":id"] = $id;

        // Возвращаем результат запроса
		return static::exec($sql, $prepare);
	}

    // Удаление
	public static function delete(int $id): ?PDOStatement
	{
        // Создаём запрос
		$sql = 'delete from ' . static::getTableName() . ' where id = :id';

        // Возвращаем результат
		return static::exec($sql, [':id' => $id]);
	}

	/**
     * Получение алисаса
	 * @param string $column
	 * @return string
	 */
	protected static function getAlias(string $column): string
	{
		return ':' . str_replace('.', '_', $column);
	}

	/**
     * Выполнение
	 * @param string $sql
	 * @param array $prepare
	 * @return ?PDOStatement
	 */
	public static function exec(string $sql, array $prepare): ?PDOStatement
	{
        // Проходимся по данным и экранируем их от тегов
		foreach ($prepare as &$item)
		{
			$item = htmlspecialchars(trim($item));
		}

        // Создаём подключение
		$ob = DB::getInstance()->getConnection()->prepare($sql);

        // Выполняем его
		$ob->execute($prepare);

        // Возвращаем результат
		return $ob;
	}

}