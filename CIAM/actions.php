<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'phpfunction.php';
// print_r($_POST);

if(array_key_exists("action",$_POST)){
  

    if(trim($_POST["action"])=="getProfile"){
     echo $response = getProfile($_POST);
    }

    if(trim($_POST["action"])=="loginByEmail"){
     echo $response = loginByEmail($_POST);
    }

   if(trim($_POST["action"])=="emailVerify"){
     echo $response = emailVerify($_POST);
    }
   if(trim($_POST["action"])=="getProfileByUid"){
     
     echo $response = getProfileByUid($_POST);
    }
   if(trim($_POST["action"])=="updateAccount"){
     echo $response = updateAccount($_POST);
    }
   if(trim($_POST["action"])=="registration"){
     
     echo $response = registration($_POST);
    }
  if(trim($_POST["action"])=="forgotPassword"){
     echo $response = forgotPassword($_POST);
    }
  if(trim($_POST["action"])=="changePassword"){
     echo $response = changePassword($_POST);
    }
  
  
}