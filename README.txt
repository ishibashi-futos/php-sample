# はじめにお読みください（セットアップ）

## セットアップ方法

- apache / phpをセットアップする（セットアップ済みの場合はスキップ）
- document.tar.gzをApacheのDocumentRootに解凍する
- Apacheのユーザに、以下のpermissionを設定する
  - conf/* --> 604
  - data/* --> 604
  - shell/*.sh --> 704
  - shell/*.dat --> 604
  - bootstrap-datapicker/* --> 604
  - js/* --> 604
  - *.php --> 604
  - api/*.php --> 604
- cronに以下のコマンドを設定する
  - ${DocumentRoot}/shell/weeklytasks.sh --> 月曜日の0時
  - ${DocumentRoot}/shell/sendmail.sh --> メール送信を行うタイミング（毎日、23時など）
  ※cronの設定方法などは（https://qiita.com/hikouki/items/e744b3a4d356d2af12cf）が参考になるかと思います。

## 初期設定（初回設定時のみ必要）

- conf/refDate.iniを編集する
  現在の週の月曜日の日付をYYYY-MM-DD形式で入力する

- workSchedule.csvを編集する
  csvファイルは1列目0~6が月~日に対応、2列目が1=完了、0=未完了、-が作業不要を表しています。
  上記に従い設定してください。（こちらは画面からも変更可能です）

- js/common.jsを編集する
  59行目の、"/pages"となっている部分を、現在利用しているサーバのコンテキストパスに変更する
  https://www.example.com/pages/admin.html
                          ↑この部分（/pages）がコンテキストパス
