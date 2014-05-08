#!/usr/bin/env bash

PROJECT_HOME=/var/www/html/music
TARGET_DIR=~/tmp/music
TARGET_ZIP=~/tmp/music.tar.gz

echo "cleaning old directory $TARGET_DIR"
rm -rf $TARGET_DIR

echo "copying code to $TARGET_DIR"
mkdir $TARGET_DIR
cp -r $PROJECT_HOME/app $TARGET_DIR



if [[ $1 == 'all' ]]; then
	echo "copying general code to $TARGET_DIR"
	cp -r $PROJECT_HOME/bootstrap $TARGET_DIR
	cp -r $PROJECT_HOME/vendor $TARGET_DIR
	cp -r $PROJECT_HOME/public $TARGET_DIR
	cp -r $PROJECT_HOME/provider $TARGET_DIR
fi

echo "cleanning unncessary files"
rm -rf $TARGET_DIR/app/storage/cache/*
rm -rf $TARGET_DIR/app/storage/logs/*
rm -rf $TARGET_DIR/app/storage/sessions/*
rm -rf $TARGET_DIR/app/storage/views/*
rm -rf $TARGET_DIR/app/LyricSearch

echo "packaging"
cd $TARGET_DIR/..
tar -zcvf $TARGET_ZIP `basename $TARGET_DIR`

echo "send to remote host"

scp $TARGET_ZIP lusaisai@lusaisai.com:~/public_html

echo "unpackaging"
ssh lusaisai@lusaisai.com "cd ~/public_html; tar -xzvf `basename $TARGET_ZIP`"

echo "done"
