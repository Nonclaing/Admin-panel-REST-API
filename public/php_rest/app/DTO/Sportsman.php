<?php

namespace App\DTO;

// Клас спортсменов
class Sportsman
{
    // Свойства класса
	/** @var int*/
	public int $id;

    /** @var string*/
    public string $name;

	/** @var string*/
	public string $photo;

    /** @var string */
	public string $biography;

	/** @var DateTime*/
	public \DateTime $year;

    /** @var Sportsman*/
    public TypeSport $type_sport_id;

    // Конструктор получает данные и передаёт их в свойства
	public function __construct(
		?int $id = null,
		?string $name = null,
		?string $photo = null,
		?string $biography = null,
		?\DateTime $year = null,
        ?TypeSport $type_sport_id = null
	)
	{
		$this->id = $id;
		$this->name = $name;
		$this->photo = $photo;
		$this->biography = $biography;
		$this->year = $year;
        $this->type_sport_id = $type_sport_id;
	}
}