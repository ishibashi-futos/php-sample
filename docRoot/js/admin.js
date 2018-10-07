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
    "0" : $('#update [name=work0] option:selected').val(),
    "1" : $('#update [name=work1] option:selected').val(),
    "2" : $('#update [name=work2] option:selected').val(),
    "3" : $('#update [name=work3] option:selected').val(),
    "4" : $('#update [name=work4] option:selected').val(),
    "5" : $('#update [name=work5] option:selected').val(),
    "6" : $('#update [name=work6] option:selected').val(),
    "checked" : $('#update [name=alertMailFlag]:ckecked').val(),
    "calender" : $('#update [name=calender]').val()
  };
  console.log(param);
}