<!DOCTYPE HTML>
<html lang="ja">
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
    @media screen and (min-width: 1280px) {
        .card {
            max-width: 350px;
            padding: 40px 40px;
        }
        .container {
            max-width: 430px;
            margin-right: auto;
            margin-left : auto;
        }
    }
    @media screen and (min-width: 640px) {
        .card {
            padding: 40px 40px;
        }
        .container {
            margin-right: auto;
            margin-left : auto;
        }
    }
    .page-header {
        border-bottom: double 1px #f0f0f0;
        margin-bottom: 10px;
    }
    .form-control {
        margin-bottom: 10px;
    }
    </style>
</head>
<body>
  <div class="container">
    <div class="page-header text-center">
        <h1>Login</h1>
    </div>
    <div class="card card-container">
      <form  action="/auth.php" method="post" class="form-signin mb10">
        <input type="email" name="email" class="form-control mb10" placeholder="Email Address" requied autofocus />
        <input type="password" name="password" class="form-control" placeholder="Password" required />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </div>
</body>
</html>
