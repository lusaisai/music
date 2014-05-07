#!/usr/bin/env bash

FILE=~/tmp/music.sql
>$FILE

for table in albums artists images songs
do
	mysqldump music $table -u music -pmusic >> $FILE
done

echo "Please import $FILE use phpmyadmin of godaddy"
