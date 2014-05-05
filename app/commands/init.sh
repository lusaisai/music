#!/usr/bin/env bash

MYSQL="mysql -u root -p"

$MYSQL <<EOP
CREATE DATABASE IF NOT EXISTS music;
grant all on music.* to 'music'@'localhost' identified by 'music';
FLUSH PRIVILEGES;
EOP



echo "run the following command to load the pinyin data"
cat <<EOP
mysql --local-infile --database=music -u music -p
load data local infile 'utf8_pinyin.csv' into table pinyin_maps CHARACTER SET UTF8 fields terminated by ',' enclosed by '"';
EOP
