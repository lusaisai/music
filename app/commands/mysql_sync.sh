#!/usr/bin/env bash

FILE=~/tmp/music.sql
>$FILE
TABLES="albums artists images songs"
OTHER_TABLES=""
if [[ $1 == 'all' ]]; then
	OTHER_TABLES="playlists playlogs poems"
fi

echo "dumping tables ..."
for table in $TABLES $OTHER_TABLES
do
	mysqldump music $table -u music -pmusic >> $FILE
done

echo "sending to remote ..."
scp $FILE im633.com:~/tmp

echo "remote importing ..."
ssh im633.com "cd ~/tmp; mysql -u music -pmusic633 --database=music < `basename $FILE`"

echo "done"
