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
  }).fail(function(){
    // エラーが発生した時
  });
}