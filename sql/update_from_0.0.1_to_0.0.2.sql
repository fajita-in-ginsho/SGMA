/*

Execute this script with your MySQL tool
to update the database in production( which you can not create from the scratch).

This script covers the change from version 0.0.1 to 0.0.2.

In short, migrate your database from 0.0.1 to 0.0.2
by running this script.

*/


-- ----------------------------
-- Add foreign key to player table 
-- ----------------------------
BEGIN;
alter table players add foreign key (gameId) references games(id);
alter table players add foreign key (userId) references users(id);
COMMIT;


