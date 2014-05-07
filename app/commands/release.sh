#!/usr/bin/env bash

PROJECT_HOME=/var/www/html/music
TARGET_DIR=~/tmp/music
TARGET_ZIP=~/tmp/music.tar.gz

rm -rf $TARGET_DIR
mkdir $TARGET_DIR
cp -r $PROJECT_HOME/app $TARGET_DIR
cp -r $PROJECT_HOME/bootstrap $TARGET_DIR
cp -r $PROJECT_HOME/vendor $TARGET_DIR
cp -r $PROJECT_HOME/public $TARGET_DIR
cp -r $PROJECT_HOME/provider $TARGET_DIR

rm -f $TARGET_DIR/app/storage/cache/*
rm -f $TARGET_DIR/app/storage/logs/*
rm -f $TARGET_DIR/app/storage/sessions/*
rm -f $TARGET_DIR/app/storage/views/*

cd $TARGET_DIR/..
tar -zcvf $TARGET_ZIP `basename $TARGET_DIR`

echo "Please upload and extract $TARGET_ZIP using file manager of godaddy"
echo "You may want to clear cache"
