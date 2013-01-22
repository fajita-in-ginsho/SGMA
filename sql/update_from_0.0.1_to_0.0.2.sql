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



-- ----------------------------
-- Enabled session id storage
-- http://codeigniter.jp/user_guide_ja/libraries/sessions.html 
-- ----------------------------
BEGIN;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
	session_id VARCHAR(40) DEFAULT '0' NOT NULL,
	ip_address VARCHAR(16) DEFAULT '0' NOT NULL,
	user_agent VARCHAR(120) NOT NULL,
	last_activity INT(10) UNSIGNED DEFAULT 0 NOT NULL,
	user_data TEXT NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);
COMMIT;
