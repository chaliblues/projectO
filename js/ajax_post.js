$(document).ready(function(){

  $("#opinion_category").click( 
    function(){
       alert("hello"); 
    });
  
  $("#ab_login_submit").click( 
  
    function(){
    
        var username=$("#ab_username").val();
        var password=$("#ab_password").val();
      alert ("hello");
        $.ajax({
        type: "POST",
        url: "http://localhost/opinions/index.php/home/post_action",
        dataType: "json",
        data: "username="+username+"&password="+password,
        cache:false,
        success: 
          function(data){
            $("#ab_form_message").html(data.message).css({'background-color' : data.bg_color}).fadeIn('slow'); 
          }
        
        });

      return false;

    });
  

});