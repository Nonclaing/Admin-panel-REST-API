<?php

namespace App\Tables;

use App\DataBase\DB;
use App\DTO\TypeSport;
use App\DTO\Sportsman;

// Класс таблицы спортсменов
class SportsmansTable extends \App\BaseTable
{
    // Получение имен таблицы
	public static function getTableName(): string
	{
		return 'sportsmans';
	}

    // Получение инфы для join
	protected static function getJoinInfo(): array
	{
		return [
			'table' => TypeSportsTable::getTableName(),
			'this_key' => 'type_sport_id',
			'remote_key' => 'id'
		];
	}

	/**
     * Получение DTO
	 * @param array $select
	 * @param array $filter
	 * @return array<Sportsman>
	 */
	public static function getDTO(array $select = [], array $filter = []): array
	{
        // Массив результатов
		$result = [];

        // Выполнение запроса получения
		$ob = static::get(
			[
				'SPORTSMANS_ID' => 'sportsmans.id',
				'SPORTSMANS_NAME' => 'sportsmans.name',
				'SPORTSMANS_PHOTO' => 'sportsmans.photo',
				'SPORTSMANS_BIOGRAPHY' => 'sportsmans.biography',
				'SPORTSMANS_YEAR' => 'sportsmans.year',
                'TYPESPORTS_ID' => 'type_sports.id',
                'TYPESPORTS_NAME' => 'type_sports.name',
			],
			$filter
		);

        // Идём по результату
		while ($itm = $ob->fetch(\PDO::FETCH_ASSOC))
		{
            // Создаём массив результата
			$result[] = new Sportsman(
				$itm['SPORTSMANS_ID'],
				$itm['SPORTSMANS_NAME'],
				$itm['SPORTSMANS_PHOTO'],
				$itm['SPORTSMANS_BIOGRAPHY'],
				$itm['SPORTSMANS_YEAR'],
				new TypeSport($itm['TYPESPORTS_ID'], $itm['TYPESPORTS_NAME'])
			);
		}

        // Возвращаем его
		return $result;
	}

    // Получение последнего элемента
	public static function getLastItem(): Sportsman
	{
        // Создание запроса на получение
		$sql = 'select sportsmans.id, sportsmans.name, sportsmans.photo, sportsmans.biography, sportsmans.year, type_sports.id as type_sports_id, type_sports.name as type_sports_name from sportsmans ';
		$sql .= 'join type_sports on type_sports.id = sportsmans.type_sport_id ';
		$sql .= 'order by id desc limit 1';

        // Выполнение
		$ob = DB::getInstance()->getConnection()->query($sql)->fetch(\PDO::FETCH_ASSOC);

        // Создание массива из результата
		return new Sportsman(
			$ob['id'],
			$ob['name'],
			$ob['photo'],
			$ob['biography'],
			$ob['year'],
			new TypeSport($ob['type_sports_id'], $ob['type_sports_name'])
		);
	}

    /**
     * @param int $id
     * @param string $name
     * @return bool
     */
    public static function isNameExists(string $name, int $id = 0): bool
    {
        $sql = 'select id from sportsmans where name = :name';

        $prepare = [
            'name' => $name
        ];

        if ($id)
        {
            $sql .= ' and id != :id';
            $prepare['id'] = $id;
        }

        $ob = DB::getInstance()->getConnection()->prepare($sql);

        $ob->execute($prepare);
        $sportsman = $ob->fetch(\PDO::FETCH_ASSOC);

        return (isset($sportsman['id']) && intval($sportsman['id']));
    }
}