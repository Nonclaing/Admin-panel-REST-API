<?php

namespace App\DTO;

// Клас видов спорта
class TypeSport
{
	/** @var int ID пользователя */
	public int $id;
	/** @var string Имя */
	public string $name;

    // Конструктор
	public function __construct(
		?int $id = null,
		?string $name = null,
	)
	{
		$this->id = $id;
		$this->name = $name;
	}
}