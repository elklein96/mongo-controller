var json = '';

$(document).ready(function () {
  $.ajax({
    type:   "POST",
    url:    "../scripts/load-data.php",
    data:   {
        data:  "request"
    },
    success: function(data) {
      $('#loading').hide();
      
      if(data.indexOf("Error") > -1){
        $('#data-wrapper').append('<p class="text-danger message"><br><br><br>'+data.replace('Error', '')+'</p>');
      }
      else{
        console.log("success");
        json = $.parseJSON(data);
        for(var i=0; i<json.length; i++){
          console.log(json[i]);
          $("#data-wrapper").append('<div class="data" id="data'+i+'">'+json[i].data+'</div>');
        }
      }
    }
  });
});