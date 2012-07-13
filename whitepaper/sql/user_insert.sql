INSERT INTO `master`.`user`
(`name`,`password`,`emailAccountId`)
VALUES
("yeele", "yeele", -1);

INSERT INTO `master`.`user`
(`name`,`password`,`emailAccountId`)
VALUES
("habu", "habu", -1);

INSERT INTO `master`.`user`
(`name`,`password`,`emailAccountId`)
VALUES
("moriuchi", "moriuchi", -1);

delete from `user` where name = "yeele";


select * from `user`;