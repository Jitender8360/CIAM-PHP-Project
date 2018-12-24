<?php ?>

<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      
       <link href="../style.css" rel="stylesheet" />
          <!--Bootstrap CSS File -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
      <script  src="https://code.jquery.com/jquery-3.3.1.js"  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="  crossorigin="anonymous"></script>
  
         <!-- <script src="../js/jquery.min.js"></script>--> 
        <script src="https://auth.lrcontent.com/v2/js/LoginRadiusV2.js"></script> 
        <script src="../js/options.js"></script>  
        <script src="../js/index.js"></script>  
        <script src="../js/sociallogin.js"></script> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

      
    </head>
    <body>
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">CIAM Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav" id = "Hideprofile" style="  justify-content: flex-end;">           
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="editProfile.php">Edit Profile</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="changepassword.php">Change Password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-warning" href=""  id="menu-user-logout">Logout</a>
            </li>
            </ul>
		<ul class="navbar-nav" id = "Hidelogin" >
          
            <li class="nav-item ">
              <a class="nav-link" href="forgot.php">Forgot Password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="login.php">login</a>
            </li>
 			<li class="nav-item ">
              <a class="nav-link" href="signup.php">Signup</a>
            </li>


          </ul>
        </div>
	</nav>
