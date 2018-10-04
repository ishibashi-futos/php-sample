<!DOCTYPE HTML>
<html lang="ja">
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Error Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div>
      <div class="page-header text-center">
          <h1>
            <?php
              $ISSUE = $_GET["error"];
              if($ISSUE == "login") {
                print "loginに失敗しました.</br>";
              }
            ?>
              ログインページに戻ってください。
          </h1>
      </div>
      <a href="/index.php">戻る</a>
    </div>
  </div>
</body>
</html>
