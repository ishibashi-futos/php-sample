function doneWork(week) {
  var cookie = getCookieArray();
  var authKey = cookie["authKey"];

  var param = {
    "week": week
  };

  $.ajax({
    type: "POST",
    headers:  {
      "authKey" : authKey
    },
    url: "/api/done.php",
    data: param
  }).done(function(){
    window.location.reload();
  }).fail(function(error){
    // エラーが発生した時
    notification("エラーが発生しました。管理者に問い合わせてください。");
    console.log(error);
    window.location.href("/login.php");
  });
}