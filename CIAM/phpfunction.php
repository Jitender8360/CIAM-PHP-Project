<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

require_once 'config.php';

use \LoginRadiusSDK\Utility\Functions;
use \LoginRadiusSDK\LoginRadiusException;
use \LoginRadiusSDK\Clients\IHttpClient;
use \LoginRadiusSDK\Clients\DefaultHttpClient;
use \LoginRadiusSDK\CustomerRegistration\Authentication\UserAPI;
use \LoginRadiusSDK\CustomerRegistration\Account\AccountAPI;
use \LoginRadiusSDK\CustomerRegistration\Account\CustomObjectAPI;
use \LoginRadiusSDK\CustomerRegistration\Account\RoleAPI;

function getProfileByUid(array $request) {
    $uid = isset($request['uid']) ? trim($request['uid']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
    if (empty($uid)) {
        $response['message'] = 'uid is required field';
    }
    else {
        $accountObj = new AccountAPI(API_KEY, API_SECRET, array('output_format' => 'json', 'api_request_signing' => API_REQUEST_SIGNING));
        try {
            $result = $accountObj->getProfileByUid($uid);
            if ((isset($result->Uid) && $result->Uid != '')) {
                $response['data'] = $result;
                $response['message'] = "fetched profile";
                $response['status'] = 'success';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = "error";
        }
    }
    return json_encode($response);
}

function updateAccount(array $request) {
    $firstname = isset($request['firstname']) ? trim($request['firstname']) : '';
    $lastname = isset($request['lastname']) ? trim($request['lastname']) : '';
    $about = isset($request['about']) ? trim($request['about']) : '';
   $ImageUrl = isset($request['ImageUrl']) ? trim($request['ImageUrl']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
//echo ($request['token']);
    $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json'));
    try {
        $payload = array('ImageUrl' => $ImageUrl,'FirstName' => $firstname, 'LastName' => $lastname, 'About' => $about);
        $result = $authenticationObj->updateProfile($request['token'], $payload,$ImageUrl);
        if (isset($result->IsPosted) && $result->IsPosted) {
            $response['message'] = "Profile has been updated successfully.";
            $response['status'] = 'success';
        }
    }
    catch (LoginRadiusException $e) {
        $response['message'] = $e->error_response->Description;
        $response['status'] = 'error';
    }
    return json_encode($response);
}

function changePassword(array $request) {
    $token = isset($request['token']) ? trim($request['token']) : '';
    $oldpassword = isset($request['oldpassword']) ? trim($request['oldpassword']) : '';
    $newpassword = isset($request['newpassword']) ? trim($request['newpassword']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
    if (empty($oldpassword)) {
        $response['message'] = 'Old password is required';
    }
    elseif (empty($newpassword)) {
        $response['message'] = 'New password is required';
    }
    else {
        $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json'));
        try {
            $result = $authenticationObj->changeAccountPassword($token, $oldpassword, $newpassword);
            if (isset($result->IsPosted) && $result->IsPosted) {
                $response['message'] = "Password has been changed successfully.";
                $response['status'] = 'success';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->error_response->Description;
            $response['status'] = 'error';
        }
    }
    return json_encode($response);
}

function loginByEmail(array $request) {
 
    $email = isset($request['email']) ? trim($request['email']) : '';
    $password = isset($request['password']) ? trim($request['password']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
   
    if (empty($email)) {
        $response['message'] = 'The Email Id field is required.';
    }
    elseif (empty($password)) {
        $response['message'] = 'The Password field is required.';
    }
    else {
        $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json', 'api_request_signing' => API_REQUEST_SIGNING));
     
      
     
        try {
            $payload = array('email' => $email, 'password' => $password);
            $result = $authenticationObj->authLoginByEmail($payload);
            if (isset($result->access_token) && $result->access_token != '') {
                $response['data'] = $result;
                $response['message'] = "Logged in successfully";
                $response['status'] = 'success';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->error_response->Description;
        }
        
    }
  
    return json_encode($response);
}

function getProfile(array $request) {
    $token = isset($request['token']) ? trim($request['token']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
    if (empty($token)) {
        $response['message'] = 'Token is required';
    }
    else {
        $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json', 'api_request_signing' => API_REQUEST_SIGNING));
        try {
            $result = $authenticationObj->getProfile($token);
            if ((isset($result->EmailVerified) && $result->EmailVerified) || AUTH_FLOW == 'optional' || AUTH_FLOW == 'disabled') {
                $response['data'] = $result;
                $response['message'] = "Profile fetched";
                $response['status'] = 'success';
            }
            else {
                $response['message'] = "Email is not verified.";
                $response['status'] = 'error';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->error_response->Description;
            $response['status'] = "error";
        }
    }
    return json_encode($response);
}

function registration(array $request) {
    $email = isset($request['email']) ? trim($request['email']) : '';
  $FirstName = isset($request['FirstName']) ? trim($request['FirstName']) : '';
   $LastName = isset($request['LastName']) ? trim($request['LastName']) : '';
    $password = isset($request['password']) ? trim($request['password']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
    if (empty($email)) {
        $response['message'] = 'The Email Id field is required.';
    }
    elseif (empty($password)) {
        $response['message'] = 'The Password field is required.';
    }
    else {
        $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json', 'api_request_signing' => API_REQUEST_SIGNING));
        try {
            $payload = array('Email' => array(array('Type' => 'Primary', 'Value' => $email)), 'password' => $password, 'FirstName' => $FirstName, 'LastName' => $LastName);
          //print_r($payload);
            $result = $authenticationObj->registerByEmail($payload, $request['verificationurl']);
            if ((isset($result->EmailVerified) && $result->EmailVerified) || AUTH_FLOW == 'optional' || AUTH_FLOW == 'disabled') {
                $response['result'] = $result;
                $response['message'] = "You have successfully registered.";
                $response['status'] = 'success';
            }
            else {
                $response['message'] = "You have successfully registered, Please check your email.";
                $response['status'] = 'registered';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->error_response->Description;
            $response['status'] = "error";
        }
    }
    return json_encode($response);
}

function forgotPassword(array $request) {
    $email = isset($request['email']) ? trim($request['email']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
    if (empty($email)) {
        $response['message'] = 'The Email Id field is required.';
    }
    else {
        $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json', 'api_request_signing' => API_REQUEST_SIGNING));
        try {
            $result = $authenticationObj->forgotPassword($email, $request['resetPasswordUrl']);
            if ((isset($result->IsPosted) && $result->IsPosted)) {
                $response['message'] = "We'll email you an instruction on how to reset your password";
                $response['status'] = 'success';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->error_response->Description;
            $response['status'] = "error";
        }
    }
    return json_encode($response);
}


function emailVerify(array $request) {
    $vtoken = isset($request['vtoken']) ? trim($request['vtoken']) : '';
    $response = array('status' => 'error', 'message' => 'an error occoured');
    if (empty($vtoken)) {
        $response['message'] = 'Verification token is required';
    }
    else {
        $authenticationObj = new UserAPI(API_KEY, API_SECRET, array('output_format' => 'json', 'api_request_signing' => API_REQUEST_SIGNING));
        try {
            $result = $authenticationObj->verifyEmail($vtoken);
            if ((isset($result->IsPosted) && $result->IsPosted)) {
                $response['message'] = "Your email has been verified successfully.";
                $response['status'] = 'success';
            }
        }
        catch (LoginRadiusException $e) {
            $response['message'] = $e->error_response->Description;
            $response['status'] = "error";
        }
    }
    return json_encode($response);
}

