var facebook = {
  loggedin: function(){
    var uid = $("#edit-facebook").val(); 
    FB.Facebook.apiClient.users_getInfo(uid, ['uid', 'name', 'locale', 'pic_square', 'profile_url'], facebook.showInfo);
  },

  attach: function(){
    var user = FB.Facebook.apiClient.get_session();  
    $("#edit-facebook").val(user.uid); // checked server-side
    $("#edit").submit();
  },

  showInfo: function(response){ 
    var user = response[0];
    //console.log(user);
    
    var dl = $("<dl/>");
    for (var info in user){
      var dt = $("<dt/>").append(info);
      var dd = $("<dd/>").append(user[info]);
      dl.append(dt).append(dd);
    }
    
    $("#facebook-connect .info").empty().append(dl);
  }
}