<?php
$_SERVER["DOCUMENT_ROOT"] = __DIR__;
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

// Таблицы для миграции
$tables = [
	'create table if not exists type_sports(
    id   int auto_increment primary key,
    name varchar(50) null
);',
	'create table if not exists sportsmans(
    id              int auto_increment primary key,
    name           varchar(100) null,
    photo           varchar(100) null,
    biography    varchar(100) null,
    year date null,
    type_sport_id       int          null,
    constraint sportsmans_type_sports_id_fk
        foreign key (type_sport_id) references type_sports (id)
            on delete cascade
);'
];

// Создаём таблицы
foreach ($tables as $table)
{
	\App\DataBase\DB::getInstance()->getConnection()->query($table);
}