INSERT INTO `master`.`tournament`
(`id`,`name`,`tournamentTypeId`,`cupId`)
VALUES
(0, "A class tournament", 0, 0);


INSERT INTO `master`.`tournamenttype`
(`id`,`name`)
VALUES
(0, "Knock-out");

INSERT INTO `master`.`tournamenttype`
(`id`,`name`)
VALUES
(1, "Group");


INSERT INTO `master`.`gametype`
(`id`,`name`)
VALUES
(0, "Shogi");

INSERT INTO `master`.`gametype`
(`id`,`name`)
VALUES
(1, "Badminton");

