#!/bin/bash
# 基準日を月曜にリセットするシェルスクリプト

# カレントに移動
cd $(dirname $0)

WEEK=$(date "+%u")

# 一応月曜日か確認する
if [ "${WEEK}" -ne "1" ] ; then
  exit 0;
fi

# 基準日を書き換える
date "+%Y-%m-%d" > ../conf/refDate.ini