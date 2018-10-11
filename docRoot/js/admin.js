$(function(){
  //Default
  $('#datepicker-default .date').datepicker({
      format: "yyyy年mm月dd日",
      language: 'ja',
      autoclose: true
  });
   
});

/**
 * FormDataを取得し、設定を更新する
 */
function update() {
  var param = {
    "0" : $('#updateForm [name=work0] option:selected').val(),
    "1" : $('#updateForm [name=work1] option:selected').val(),
    "2" : $('#updateForm [name=work2] option:selected').val(),
    "3" : $('#updateForm [name=work3] option:selected').val(),
    "4" : $('#updateForm [name=work4] option:selected').val(),
    "5" : $('#updateForm [name=work5] option:selected').val(),
    "6" : $('#updateForm [name=work6] option:selected').val(),
    "checked" : $('#updateForm [name=alertMailFlag]:checked').val(),
    "calender" : $('#updateForm [name=calender]').val()
  };
  $.ajax({
    type: "POST",
    url: getContextPath() + "/api/admin-update.php",
    data: param
  }).done(function(data){
    notification("更新が完了しました");
    window.location.reload();
  }).fail(function(error){
    // エラーが発生した時
    notification("エラーが発生しました。管理者に問い合わせてください。");
    console.log(error);
  });
}