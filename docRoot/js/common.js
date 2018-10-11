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

const contextPath = "/pages";
