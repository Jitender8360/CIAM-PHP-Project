var stringVariable = window.location.href;
domainName = stringVariable.substring(0, stringVariable.lastIndexOf('/'));

$(function () {
  var url = window.location;
   $('ul.navbar-nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.navbar-nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
  
  
  	var accesstoken = localStorage.getItem("LRTokenKey");
    var lruid= localStorage.getItem("LRUserID");
   if(stringVariable.includes("editProfile")||stringVariable.includes("changepassword")||stringVariable.includes("profile")){
                if (accesstoken != "" && accesstoken != null && lruid != "" && lruid != null) {  
                  $("#Hidelogin").hide();
                   $("#Hideprofile").show();
                         if (stringVariable.includes("profile")){
                           var emailId = localStorage.getItem("EmailId");
                           var username = localStorage.getItem("UserName");
                           var lastlogintime = localStorage.getItem("LastLoginTime");
                           var ImageURL = localStorage.getItem("ImageUrl");
                           var about = localStorage.getItem("about");
                           if(username!= "" && username != null){
                                jQuery('.lr-user-name').text(username);
                           }
                           if(ImageURL!= "" && ImageURL != null){
                                $( '.ProfileImg').attr("src",ImageURL);
                           }
                           if(about!= "" && about != null){
                                jQuery('.lr-about').text(about);
                           }
                           jQuery('.emailid').text(emailId);
                           jQuery('.useruid').text(lruid);
                           jQuery('.lastlogin').text(lastlogintime);          

                         }   
               }else{
                 window.location.href = "login.php";
               }
      }else{
         			$("#Hidelogin").show();
                   $("#Hideprofile").hide();
              if (getUrlParameter("vtype") == "emailverification") {

                    $("#emailverification-message").text("");
                    $.ajax({
                                    url: domainName+"../actions.php",
                                    type: 'POST',
                                    dataType: "json",
                                    data: $.param({
                                        vtoken: getUrlParameter("vtoken"),
                                        action: "emailVerify"
                                    }),			
                        success: function(res) {    

                                            if (res.status == 'success') {
                                               $("#emailverification-message").attr('style', 'color:green');  
                                               $("#emailverification-message").text(res.message);
                                            } else if (res.status == 'error') {
                                                $("#emailverification-message").attr('style', 'color:red');                      
                                                $("#emailverification-message").text(res.message);
                                            }                            
                        },
                        error: function(xhr, status, error) {

                                            console.log(xhr.responseText);
                                            $("#emailverification-message").attr('style', 'color:red');  
                            $("#emailverification-message").text("Email verification failed");
                        }
                    });
                }
     
  	 }
  
  
    
   
  	handleLogout(); 
 	getProfileByUid();
    handleUpdateAccount(); 
    handleLogin();
  	handleChangePassword();
    handleSignup();
    handleForgotPassword();
    var vtype = getUrlParameter("vtype");
    if (vtype == 'reset') {
        jQuery('.lrforgotpassword').hide();
       
    }
    
});

function handleChangePassword() {
    $('#btn-user-changepassword').on('click', function () {
        $("#user-changepassword-errorMsg").text("");
        $("#user-changepassword-successMsg").text("");
        if ($('#user-changepassword-oldpassword').val().trim() == '' || $('#user-changepassword-newpassword').val().trim() == '') {
            $("#user-changepassword-errorMsg").text("The password field is required.");
            return;
        } else if ($('#user-changepassword-newpassword').val().trim().length < '6') {
            $("#user-changepassword-errorMsg").text("The New Password field must be at least 6 characters in length.");
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "../actions.php",
            dataType: "json",
            data: $.param({
                token: localStorage.getItem("LRTokenKey"),
                oldpassword: $("#user-changepassword-oldpassword").val(),
                newpassword: $("#user-changepassword-newpassword").val(),
                action: "changePassword"
            }),
            success: function (res) {
                
                if (res.status == 'error') {
                    $("#user-changepassword-errorMsg").text(res.message);
                } else if (res.status == 'success') {
                    $("#user-changepassword-oldpassword").val("");
                    $("#user-changepassword-newpassword").val("");
                    $("#user-changepassword-successMsg").text(res.message);
                }
            },
            error: function (xhr, status, error) {
               
                $("#user-changepassword-errorMsg").text(xhr.responseText);
            }
        });
    });
}


function getProfileByUid() {
    var uid = localStorage.getItem("LRUserID");
    $.ajax({
        url: "../actions.php",
        type: 'POST',
        dataType: "json",
        data: $.param({
            uid: uid,   
            action: "getProfileByUid"
        }),
        success: function (response) {
          console.log(response);
            if (response.status == "success") {
                if (typeof (response.data.FirstName) != "undefined" && response.data.FirstName !== null) {
                   $("#user-updateaccount-firstname").val(response.data.FirstName);  
                    localStorage.setItem('UserName', response.data.FullName);
                }
                if (typeof (response.data.LastName) != "undefined" && response.data.LastName !== null) {
                   $("#user-updateaccount-lastname").val(response.data.LastName);   
                    localStorage.setItem('UserName', response.data.FullName);
                }
                if (typeof (response.data.About) != "undefined" && response.data.About !== null) {
                   $("#user-updateaccount-about").val(response.data.About);      
                  localStorage.setItem('about', response.data.About);
                }
                if (typeof (response.data.ImageUrl) != "undefined" && response.data.ImageUrl !== null) {
                   $("#user-updateaccount-ImageURL").val(response.data.ImageUrl);  
                  localStorage.setItem('ImageUrl', response.data.ImageUrl);
                }
            } 
        }
    });
}

function handleUpdateAccount() {
    $('#btn-user-updateaccount').on('click', function () {
        $("#user-updateaccount-errorMsg").text("");
        $("#user-updateaccount-successMsg").text("");
//alert($("#user-updateaccount-ImageURL").val());
       
        $.ajax({
            type: "POST",
            url: "../actions.php",
            dataType: "json",
            data: $.param({
                token: localStorage.getItem("LRTokenKey"),
                firstname: $("#user-updateaccount-firstname").val(),
                lastname: $("#user-updateaccount-lastname").val(),
                about: $("#user-updateaccount-about").val(),
              ImageUrl: $("#user-updateaccount-ImageURL").val(),
                action: "updateAccount"
            }),
            success: function (res) {
               
                if (res.status == 'error') {
                    $("#user-updateaccount-errorMsg").text(res.message);            
                } else if (res.status == 'success') {
                    $("#user-updateaccount-successMsg").text(res.message);
                    getProfileByUid();
                   
                }
            },
            error: function (xhr, status, error) {
               
                $("#user-updateaccount-errorMsg").text(xhr.responseText);
            }
        });
    });
}





function getProfile(access_token, profile_uid) {
    localStorage.setItem('LRTokenKey', access_token);
    localStorage.setItem('LRUserID', profile_uid);

    $.ajax({
        url: "../actions.php",
        type: 'POST',
        dataType: "json",
        data: $.param({
            token: access_token,   
            action: "getProfile"
        }),
        success: function (response) {
            if (response.status == "success") {
                localStorage.setItem('EmailId', response.data.Email[0].Value);
                if (typeof (response.data.FullName) != "undefined" && response.data.FullName !== null) {
                    localStorage.setItem('UserName', response.data.FullName);
                }
                localStorage.setItem('ImageUrl', response.data.ImageUrl);
                localStorage.setItem('LastLoginTime', response.data.LastLoginDate);
                window.location.href = "profile.php";
            } else {
                $("#minimal-login-errorMsg").text(response.message);
            }
        }
    });
}

function handleLogin() {
    $('#btn-minimal-login').on('click', function () {
        $("#minimal-login-errorMsg").text("");
        if ($('#minimal-login-email').val().trim() == '') {
            $("#minimal-login-errorMsg").text("The Email Id field is required.");
            return;
        } else if ($('#minimal-login-password').val().trim() == '') {
            $("#minimal-login-errorMsg").text("The Password field is required.");
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "../actions.php",
            dataType: "json",
            data: $.param({
                email: $("#minimal-login-email").val(),
                password: $("#minimal-login-password").val(),
                action: "loginByEmail"
            }),

            success: function (response) {
                if (response.status == 'error') {           
                    $("#minimal-login-errorMsg").text(response.message);
                } else if (response.status == 'success') {
                 
                    $("#minimal-login-email").val("");
                    $("#minimal-login-password").val("");
                    getProfile(response.data.access_token, response.data.Profile.Uid);
                 }
                
            },
            error: function (xhr, status, error) {
                
                console.log("Login err::", xhr.responseText);
                $("#minimal-login-errorMsg").text("an error occurred");
            }
        });
    });
}


function handleSignup() {
    $('#btn-minimal-signup').on('click', function () {        
        $("#minimal-signup-successMsg").text("");
        $("#minimal-signup-errorMsg").text("");
        if ($('#minimal-signup-email').val().trim() == '') {
            $("#minimal-signup-errorMsg").text("The Email Id field is required.");
            return;
        } else if ($('#minimal-signup-password').val().trim() == '') {
            $("#minimal-signup-errorMsg").text("The Password field is required.");
            return;
        } else if ($('#minimal-signup-password').val().trim().length < '6') {
            $("#minimal-signup-errorMsg").text("The Password field must be at least 6 characters in length.");
            return;
        } else if ($("#minimal-signup-password").val() != $("#minimal-signup-confirmpassword").val()) {
            $("#minimal-signup-errorMsg").text("Passwords do not match.");
            return;
        }
        $.ajax({
            type: "POST",
            url: "../actions.php",
            dataType: "json",
            data: $.param({
              	FirstName: $("#minimal-signup-FirstName").val(),
                LastName: $("#minimal-signup-LastName").val(),
                email: $("#minimal-signup-email").val(),
                password: $("#minimal-signup-password").val(),
                verificationurl: domainName,
                action: "registration",
            }),
            success: function (res) {
                if (res.status == 'registered') {
                    $("#minimal-signup-successMsg").text(res.message);
                     $("#minimal-signup-email").val('');
                     $("#minimal-signup-password").val('');
                     $("#minimal-signup-confirmpassword").val('');
                } else if (res.status == 'success') {
                     $("#minimal-signup-email").val('');
                     $("#minimal-signup-password").val('');
                     $("#minimal-signup-confirmpassword").val('');
                  $("#minimal-signup-FirstName").val('');
                  $("#minimal-signup-LastName").val('');
                    getProfile(res.result.Data.access_token, res.result.Data.Profile.Uid);
                } else if (res.status == 'error') {              
                    $("#minimal-signup-errorMsg").text(res.message);
                }
            },
            error: function (xhr, status, error) {
                $("#minimal-signup-errorMsg").text(xhr.responseText);     
            }
        });
    });
}

function handleForgotPassword() {
    $('#btn-minimal-forgotpassword').on('click', function () {
        $("#minimal-forgotpassword-successMsg").text("");
        $("#minimal-forgotpassword-errorMsg").text("");
        if ($('#minimal-forgotpassword-email').val().trim() == '') {
            $("#minimal-forgotpassword-errorMsg").text("The Email Id field is required.");
            return;
        }
        $.ajax({
            type: "POST",
            url: "../actions.php",
            dataType: "json",
            data: $.param({
                email: $("#minimal-forgotpassword-email").val(),
                resetPasswordUrl: domainName + "../view/forgot.php",
                action: "forgotPassword"
            }),
            success: function (response) {
                if (response.status == 'success') {   
                    $("#minimal-forgotpassword-email").val("");
                    $("#minimal-forgotpassword-successMsg").text(response.message);
                } else if (response.status == 'error') {           
                    $("#minimal-forgotpassword-errorMsg").text(response.message);
                }
            },
            error: function (xhr, status, error) {
                $("#minimal-forgotpassword-errorMsg").text(xhr.responseText);       
            }
        });
    });
}


function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function handleLogout() {
    $('#menu-user-logout').on('click', function () {
        localStorage.setItem("LRTokenKey", "");
        localStorage.setItem("LRUserID", "");
        localStorage.setItem("EmailId", "");
        localStorage.setItem("UserName", "");
        localStorage.setItem("ImageUrl", "");
        localStorage.setItem("LastLoginTime", "");
              localStorage.setItem("about", "");
    });
}

