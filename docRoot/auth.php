<!DOCTYPE HTML>
<html lang="ja">
<head>
<?php
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
      if($userName == $email && $userPassword == $password && $role == "admin") {
        $auth = true;
        //print '<meta http-equiv="refresh" content="0;URL=\'https://www.google.co.jp/\'" />';
        print 'Welcome administrator!';
	      print base64_encode($userName . ',' . $userPassword . ',' . "admin");
        break;
      } else if ($userName == $email && $userPassword == $password && $role == "user") {
        $auth = true;
        //print '<meta http-equiv="refresh" content="0;URL=\'https://www.yahoo.co.jp/\'" />';
	      print base64_encode($userName . ',' . $userPassword . ',' . "user");
        print 'Welcome user!';
        break;
      }
    }
  }
  if(!$auth) {
    print '<meta http-equiv="refresh" content="0;URL=\'./error.php?error=login\'" />';
  }
?>
</head>
<body></body>
</html>
