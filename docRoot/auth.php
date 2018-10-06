<?php
  // 認証チェック
  $email = $_POST["email"];
  $password = $_POST["password"];
  $authFile = fopen('./data/userlist.csv', 'r');
  $auth = false;
  if($authFile) {
    while($line = fgets($authFile)) {
      $line = rtrim($line, "\n");
      $lines = explode(',', $line);
      $userName = $lines[0];
      $userPassword = $lines[1];
      $role = $lines[2];
      // 認証ユーザ内容チェック
      if($userName == $email && $userPassword == $password && $role == "admin") {
        $auth = true;
        //print '<meta http-equiv="refresh" content="0;URL=\'https://www.google.co.jp/\'" />';
        // cookieをセット、有効期限は1時間
        setcookie('authKey', base64_encode($userName . ',' . $userPassword . ',' . "admin"), time() + 3600);
        break;
      } else if ($userName == $email && $userPassword == $password && $role == "user") {
        $auth = true;
        //print '<meta http-equiv="refresh" content="0;URL=\'https://www.yahoo.co.jp/\'" />';
        // cookieをセット、有効期限は1時間
        setcookie('authKey', base64_encode($userName . ',' . $userPassword . ',' . "user"), time() + 3600);
        break;
      }
    }
  }
  if(!$auth) {
    print '<meta http-equiv="refresh" content="0;URL=\'./error.php?error=login\'" />';
  }
?>
