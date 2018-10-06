<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th class="col-md-6">実施予定日</th>
                <th class="col-md-3">曜日</th>
                <th class="col-md-3">完了</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $now = new DateTime();
                // 設定ファイルから基準日を取得する
                $refDate = '';
                $refFile = fopen('./conf/refDate.ini', 'r');
                if($refFile) {
                  $refDate = new DateTime(rtrim(fgets($refFile), "\r"));
                }
                $arrays = array(
                  0 => "月",
                  1 => "火",
                  2 => "水",
                  3 => "木",
                  4 => "金",
                  5 => "土",
                  6 => "日"
                );
                foreach($arrays as $key => $value) {
                  print "<tr>";
                  print "<td>{$refDate->format('Y年m月d日')}</td>";
                  print "<td>{$value}</td>";
                  print "<td><button class='btn btn-lg btn-primary btn-block' type='submit'>完了</button></td>";
                  print "</tr>";
                  $refDate->modify('+1 days');
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
