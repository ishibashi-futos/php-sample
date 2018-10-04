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
                <th class="col-sm-6">実施予定日</th>
                <th class="col-sm-3">曜日</th>
                <th class="col-sm-3">完了</th>
              </tr>
            </thead>
            <tbody>
              <?php
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
                  print "{$key} => ${value}</br>";
                }
              ?>
              <tr>
                <td>2018/10/1</td>
                <td>月</td>
                <td>
                  <button class="btn btn-lg btn-primary btn-block" type="submit">完了</button>
                </td>
              </tr>
              <tr>
                <td>2018/10/2</td>
                <td>火</td>
                <td>
                  <button class="btn btn-lg btn-primary btn-block" type="submit">完了</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>