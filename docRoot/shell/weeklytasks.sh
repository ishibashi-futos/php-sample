#!/bin/bash
# 基準日を月曜にリセットするシェルスクリプト

# カレントに移動
cd $(dirname $0)

WEEK=$(date "+%u")

if [ "${WEEK}" -ne "1" ] ; then
  exit 0;
fi

date "+%Y-%m-%d" > ../conf/refDate.ini