/**
 * cookie値を連想配列として取得する
 */
function getCookieArray(){
  var arr = new Array();
  if(document.cookie != ''){
    var tmp = document.cookie.split('; ');
    for(var i=0;i<tmp.length;i++){
      var data = tmp[i].split('=');
      arr[data[0]] = decodeURIComponent(data[1]);
    }
  }
  return arr;
}

/**
 * Notification
 */
function notification(message) {
  if(window.Notification) {
    if(Notification.permission === 'default') {
      Notification.requestPermission(function(result) {
        if (result === 'default') {
          alert(message);
          return;
        } else if (result === 'denied') {
          alert(message);
          return;
        }
      });
    } else if (Notification.permission === 'granted') {
      var ntf = new Notification(message);
    }
  } else {
    // notificationが使用できない場合、alertを実行
    alert(message);
  }
}

/**
 * remove cookie
 */
function disableCookies() {
  var cookies = $.cookie();
  for(key in cookies) {
    $.cookieRemove(key);
  }
}