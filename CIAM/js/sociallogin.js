var custom_interface_option = {};
custom_interface_option.templateName = 'loginradiuscustom_tmpl';
LRObject.util.ready(function () {
    LRObject.customInterface(".interfacecontainerdiv", custom_interface_option);
});
var sl_options = {};
sl_options.onSuccess = function (res) {
        if(res.access_token){
            getProfile(res.access_token, res.Profile.Uid);
        }
};
sl_options.onError = function (errors) {
    $("#emailverification-message").attr('style', 'color:red');    
    $("#emailverification-message").text(errors[0].Description);
};
sl_options.container = "sociallogin-container";

LRObject.util.ready(function () {
    LRObject.init('socialLogin', sl_options);
});