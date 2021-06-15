//Ajax
function ajax(url, callback){
    $.ajax({
      "url" : url,
      "type" : "GET",
      "dataType" : "json",
    })
    .done(callback); //END AJAX
  }
  function ajax_form(fd, url, callback){
    console.log("submit event");
    var formData = new FormData(document.getElementById(fd));
    formData.append("label", "WEBUPLOAD");
    $.ajax({
      url: url,
      method: 'post',
      dataType: 'json',
      contentType: false,
      processData: false,
      data: formData
    })
    .done(callback); //END AJAX
  }