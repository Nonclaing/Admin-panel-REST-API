SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `sportsmans` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Имя',
  `photo` varchar(524) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_sport_id` int NOT NULL,
  `biography` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `year` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `type_sport` (`type_sport_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

INSERT INTO `sportsmans` (`id`, `name`, `photo`, `type_sport_id`, `biography`, `year`) VALUES
(32, 'Ледванова Анастасия Юрьевна', '/files/72ebf2fc1a7b92f55a5e1040eb8282c5.jpg', 19, 'Мега футболист, 10 из 10', '2019-06-13'),
(39, 'Щедрин Александр Владиславович', '/files/6bfcb37c6021d8f4739a4bf2b5ea74ce.jpg', 21, 'Начал свою карьеру в 2018 году в составе команды школы №56 города Волгограда.\nПосле своего дебюта, с 2021 года, активно принимал участие в открытых чемпионатах с новой смешанной командой.', '2018-10-04'),
(42, 'Кто-то ещё', '/files/2b55dd8eabb0cb3e5aea28387ee6155a.jpg', 19, 'Ага      точно', '2022-05-11'),
(43, 'Ну и ещё', '/files/aa97b555a5909bb88e26c3e86d43c13a.png', 22, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aspernatur delectus ducimus eligendi explicabo facilis fuga fugit labore maiores minima nemo nesciunt praesentium, quidem, ratione voluptatibus! Asperiores autem id iste nesciunt, nisi repellendus tenetur. Adipisci at commodi deserunt dicta doloremque doloribus, ducimus in ipsam laudantium magnam nisi nulla odio quaerat quidem saepe tempora ullam. A, alias at dolores eligendi eos eveniet hic, illum ipsum laboriosam provident quam sapiente sint sunt tenetur ullam unde voluptatum! Beatae dolorem eum reprehenderit voluptatem voluptatum. Accusantium ad, animi dolorem eligendi enim error in, laborum libero modi mollitia nihil, officiis pariatur perferendis porro possimus similique tempora.', '2022-05-12'),
(46, 'hgfhg', '/files/bfa9c4dd5b444f07581339671c31d2c4.jpg', 21, 'hjhgj', '2022-05-20');

CREATE TABLE IF NOT EXISTS `type_sports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO `type_sports` (`id`, `name`) VALUES
(19, 'Футбол'),
(21, 'Волейбол'),
(22, 'Баскетбол'),
(23, '&lt;b&gt;текст&lt;/b&gt;');


ALTER TABLE `sportsmans`
  ADD CONSTRAINT `sportsmans_ibfk_1` FOREIGN KEY (`type_sport_id`) REFERENCES `type_sports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
