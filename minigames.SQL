CREATE TABLE `Users`
(
  `id` Int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` Varchar(50) NOT NULL,
  `surname` Varchar(50) NOT NULL,
  `email` Varchar(150) NOT NULL,
  `pass_hash` Varchar(500) NOT NULL,
  `isAdmin` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)
;

CREATE TABLE `GamesPlayed`
(
  `player_id` Int UNSIGNED NOT NULL,
  `ticTacToe` Int UNSIGNED NOT NULL DEFAULT 0,
  `memoryGame` Int UNSIGNED NOT NULL DEFAULT 0
)
;

ALTER TABLE `GamesPlayed` ADD PRIMARY KEY (`player_id`)
;

ALTER TABLE `GamesPlayed` ADD CONSTRAINT `HasPlayed(Times x)` FOREIGN KEY (`player_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
;