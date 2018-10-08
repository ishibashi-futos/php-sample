#!/bin/bash
# メールの送信チェック、送信処理を行う

# カレントに移動
cd $(dirname $0)
source ../data/alertControl.ini
# 送信が必要かチェックする
refDate=$(echo "${refDate}" 23:59:59)
if [ $(date -d "${refDate}" "+%s") -gt $(date "+%s") ]; then
  if [ "${alertControl}" -eq "1" ]; then
    echo 送信不要
    exit 0
  fi
fi

# スケジュールを読み取る
for line in $(cat ../data/workSchedule.csv) ; do
  col1=$(echo $line | cut -d ',' -f 1 | xargs -I %a expr %a + 1)
  col2=$(echo $line | cut -d ',' -f 2)
  # 曜日が一致し、かつcol2が0以外の場合は送信不要としてexit
  if [ "${col1}" -eq $(date "+%u") ] ; then
    if [ "${col2}" != "0" ] ; then
      echo 送信不要
      exit 0
    fi
  fi
done

# メールを送る
source ./mail.dat

{
  echo "From: ${FROM_ADDRESS}"
  echo "To: ${TO_ADDRESS}"
  echo "Subject: ${TITLE_TEXT}"
  echo 
  echo "${BODY_TEXT}"
} | sendmail -i -t