<?php require_once 'header.php'; ?>        <div class="section-main section-minimal">
            <center>
                <div class="container">
                  <center><table><h5>Signup using your email address</h5>
                    		<tr><td>Fist Name: </td><td><input name="FirstName" type='text' id='minimal-signup-FirstName'/></td></tr>
                            <tr><td>Last Name: </td><td><input name="LastName" type='text' id='minimal-signup-LastName'/></td></tr>
                            <tr><td>Email Address: </td><td><input name="email" type='text' id='minimal-signup-email'/></td></tr>
                            <tr><td>Password: </td><td><input name="password" type='password' id='minimal-signup-password'/></td></tr>
                            <tr><td>Confirm password: </td><td><input name="password" type='password' id='minimal-signup-confirmpassword'/></td></tr>
                        </table>
                  <button  class = "btn btn-primary" id="btn-minimal-signup">Register</button><br/>
                    <span style="color:red" id="minimal-signup-errorMsg"></span>
                    <span style="color:green" id="minimal-signup-successMsg"></span>
                  </center>
                    
                </div>
            </center>                
        </div>       
<?php require_once 'footer.php'; ?>