-- MySQL for Nagger Web Mobile Application
-- Database Name: nagger261


SET FOREIGN_KEY_CHECKS = 0;


-- USER TABLE
DROP TABLE IF EXISTS user;
CREATE TABLE user
(
  user_id		varchar(23) PRIMARY KEY NOT NULL COMMENT 'UUID Primary Key'
, username		VARCHAR(100) NOT NULL
, password		VARCHAR(200) NOT NULL
, join_date 	DATE NOT NULL
);


-- RATE TABLE
DROP TABLE IF EXISTS rate;
CREATE TABLE rate
(
  rate_id		INT AUTO_INCREMENT PRIMARY KEY NOT NULL
, rate			INT(1) 	NOT NULL
);
INSERT INTO rate (rate) VALUES (1);
INSERT INTO rate (rate) VALUES (2);
INSERT INTO rate (rate) VALUES (3);
INSERT INTO rate (rate) VALUES (4);
INSERT INTO rate (rate) VALUES (5);


-- TAG TABLE
DROP TABLE IF EXISTS tag;
CREATE TABLE tag
(
  tag_id		VARCHAR(23) PRIMARY KEY NOT NULL COMMENT 'UUID Primary Key'
, tag			VARCHAR(50) NOT NULL
);


-- TAGCOUNT TABLE
DROP TABLE IF EXISTS tagCount;
CREATE TABLE tagCount
(
  count_id			VARCHAR(23) PRIMARY KEY NOT NULL COMMENT 'UUID Primary Key'
, user_id			VARCHAR(23) NOT NULL COMMENT 'UUID foreign Key'
, tag_id			VARCHAR(23) NOT NULL COMMENT 'UUID foreign Key'
, tag_count		INT(11) NOT NULL
, last_updated		DATE
, FOREIGN KEY (user_id) REFERENCES user(user_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
, FOREIGN KEY (tag_id) REFERENCES tag(tag_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);


-- ITEM TABLE
DROP TABLE IF EXISTS item;
CREATE TABLE item
(
  item_id			VARCHAR(23) PRIMARY KEY NOT NULL COMMENT 'UUID Primary Key'
, user_id			VARCHAR(23) NOT NULL COMMENT 'UUID foreign Key'
, rate_id			INT(1) NOT NULL COMMENT 'UUID foreign Key'
, item_name				VARCHAR(200) NOT NULL
, completed		VARCHAR(1) NOT NULL
, date_created		DATE NOT NULL
, rate_date		DATE NOT NULL
, FOREIGN KEY (user_id) REFERENCES user(user_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
, FOREIGN KEY (rate_id) REFERENCES rate(rate_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);


-- SUB-ITEM TABLE
DROP TABLE IF EXISTS subItem;
CREATE TABLE subItem
(
  sub_id			VARCHAR(23) PRIMARY KEY NOT NULL COMMENT 'UUID Primary Key'
, user_id			VARCHAR(23) NOT NULL COMMENT 'UUID foreign Key'
, item_id			VARCHAR(23) NOT NULL COMMENT 'UUID foreign Key'
, subItem			VARCHAR(200) NOT NULL
, completed		VARCHAR(1) NOT NULL
, FOREIGN KEY (user_id) REFERENCES user(user_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
, FOREIGN KEY (item_id) REFERENCES item(item_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);


SET FOREIGN_KEY_CHECKS = 1;

-- Insert TESTING or ADMIN data

-- USER ONE
-- INSERT INTO USER
INSERT INTO user (user_id, username, password, join_date)
VALUES (
  '239487g234y32g4i2376g4i'
, 'Sarah'
, 'testing'
, UTC_DATE());

-- INSERT INTO item
INSERT INTO item (item_id, user_id, rate_id, item_name, completed, date_created, rate_date)
VALUES (
  '32o84g32uy32u4yg32'
, '239487g234y32g4i2376g4i'
, '3'
, 'My First Item'
, 'N'
, UTC_DATE()
, UTC_DATE()
);

-- INSERT INTO ITEM AGAIN
INSERT INTO item (item_id, user_id, rate_id, item_name, completed, date_created, rate_date)
VALUES (
  '8843h5345h34u5h435hh345'
, '239487g234y32g4i2376g4i'
, '1'
, 'Grocery Shopping'
, 'N'
, UTC_DATE()
, UTC_DATE()
);

-- INSERT SUBITEM 1 FOR ITEM 2 USER 1
INSERT INTO subItem (sub_id, user_id, item_id, subItem, completed)
VALUES (
  '884hj332iu4h32i4uh32'
, '239487g234y32g4i2376g4i'
, '8843h5345h34u5h435hh345'
, 'Milk'
, 'N'
);

-- INSERT SUBITEM 2 FOR ITEM 2 USER 1
INSERT INTO subItem (sub_id, user_id, item_id, subItem, completed)
VALUES (
  '009eiruewrkuehwrwerhnnn'
, '239487g234y32g4i2376g4i'
, '8843h5345h34u5h435hh345'
, 'Bread'
, 'N'
);

-- INSERT TAG ITEMS FOR USER 1 ITEMS SO FAR
INSERT INTO tag (tag_id, tag) VALUES ('vbvbvbvbvbugr7234gr3', 'My');
INSERT INTO tag (tag_id, tag) VALUES ('vbvbfdvbvbugr7234gr3', 'First');
INSERT INTO tag (tag_id, tag) VALUES ('vbvbfdvasdugr7234gr3', 'Item');
INSERT INTO tag (tag_id, tag) VALUES ('234jjjh34j234h234hh3', 'Grocery');
INSERT INTO tag (tag_id, tag) VALUES ('poiuytrewqasdfghjkdd', 'Shopping');

-- INSERT Tag Counts
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  '09876543212345678123190'
, '239487g234y32g4i2376g4i'
, 'vbvbvbvbvbugr7234gr3'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  '09876543212345678123213'
, '239487g234y32g4i2376g4i'
, 'vbvbfdvbvbugr7234gr3'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  '09876543212342231jh213j'
, '239487g234y32g4i2376g4i'
, 'vbvbfdvasdugr7234gr3'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  'nmnsmdnsdmnsdmnsdmnsdmn'
, '239487g234y32g4i2376g4i'
, '234jjjh34j234h234hh3'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  '13iuy234iuy234ygu234iyu'
, '239487g234y32g4i2376g4i'
, 'poiuytrewqasdfghjkdd'
, '1'
, UTC_DATE()
);

-- USER TWO
-- INSERT INTO USER
INSERT INTO user (user_id, username, password, join_date)
VALUES (
  'JOHN32032943204923488'
, 'John'
, 'testing'
, UTC_DATE());

-- INSERT INTO item
INSERT INTO item (item_id, user_id, rate_id, item_name, completed, date_created, rate_date)
VALUES (
  'JOHN32o84g32uy32u4yg3'
, 'JOHN32032943204923488'
, '3'
, 'Fix Front Door'
, 'N'
, UTC_DATE()
, UTC_DATE()
);

-- INSERT INTO ITEM AGAIN
INSERT INTO item (item_id, user_id, rate_id, item_name, completed, date_created, rate_date)
VALUES (
  'JOHN8843h5345h34u5h43'
, 'JOHN32032943204923488'
, '1'
, 'Pickup Parts'
, 'N'
, UTC_DATE()
, UTC_DATE()
);

-- INSERT SUBITEM 1 FOR ITEM 2 USER 1
INSERT INTO subItem (sub_id, user_id, item_id, subItem, completed)
VALUES (
  'JOHN884hj332iu4h32i4'
, 'JOHN32032943204923488'
, 'JOHN8843h5345h34u5h43'
, 'Fuel Cap'
, 'N'
);

-- INSERT SUBITEM 2 FOR ITEM 2 USER 1
INSERT INTO subItem (sub_id, user_id, item_id, subItem, completed)
VALUES (
  'JOHN009eiruewrkuehwrwer'
, 'JOHN32032943204923488'
, 'JOHN8843h5345h34u5h43'
, 'Tire Jack'
, 'N'
);

-- INSERT TAG ITEMS FOR USER 1 ITEMS SO FAR
INSERT INTO tag (tag_id, tag) VALUES ('JOHNvbvbvbvbvbugr721', 'Fix');
INSERT INTO tag (tag_id, tag) VALUES ('JOHNvbvbfdvbvbugr722', 'Front');
INSERT INTO tag (tag_id, tag) VALUES ('JOHNvbvbfdvasdugr723', 'Door');
INSERT INTO tag (tag_id, tag) VALUES ('JOHN234jjjh34j234h23', 'Pickup');
INSERT INTO tag (tag_id, tag) VALUES ('JOHNpoiuytrewqasdfgh', 'Parts');

-- INSERT Tag Counts
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  'JOHN0987654321234567812'
, 'JOHN32032943204923488'
, 'JOHNvbvbvbvbvbugr721'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  'JOHN09876543212341232'
, 'JOHN32032943204923488'
, 'JOHNvbvbfdvbvbugr722'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  'JOHN09876543212342231jh'
, 'JOHN32032943204923488'
, 'JOHNvbvbfdvasdugr723'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  'JOHNnmnsmdnsdmnsdmnsdmn'
, 'JOHN32032943204923488'
, 'JOHN234jjjh34j234h23'
, '1'
, UTC_DATE()
);
INSERT INTO tagCount (count_id, user_id, tag_id, tag_count, last_updated)
VALUES (
  'JOHN13iuy234iuy234ygu23'
, 'JOHN32032943204923488'
, 'JOHNpoiuytrewqasdfgh'
, '1'
, UTC_DATE()
);