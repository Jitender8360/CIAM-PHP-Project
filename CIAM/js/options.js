var stringVariable = window.location.href;
domainName = stringVariable.substring(0, stringVariable.lastIndexOf('/'));
var commonOptions = {};
commonOptions.apiKey = "";
commonOptions.appName = "lr-candidate-demo1";
commonOptions.hashTemplate = true;
commonOptions.sott = "<SOTT>";
commonOptions.formValidationMessage = true;
commonOptions.verificationUrl = domainName+"/loginscreen.html";
commonOptions.resetPasswordUrl = domainName+"/loginscreen.html";
var LRObject = new LoginRadiusV2(commonOptions);