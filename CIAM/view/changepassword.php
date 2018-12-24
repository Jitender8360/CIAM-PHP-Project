<?php require_once 'header.php'; ?>
      
 <div class="section-main section-minimal">
            <center>
                <div class="container-small lr-change-password">
                    <center><table>
                      <h4>Please change your password</h4>
                            <tr><td>Old Password: </td><td><input name="email" type='password' id='user-changepassword-oldpassword'/></td></tr>
                            <tr><td>New Password: </td><td><input name="email" type='password' id='user-changepassword-newpassword'/></td></tr>
                        </table>
                    <button class = "btn btn-primary" id="btn-user-changepassword">Change Password</button><br/>
                    <span style="color:red" id="user-changepassword-errorMsg"></span>
                    <span style="color:green" id="user-changepassword-successMsg"></span>
                      </center>
                </div>
            </center>                
        </div>       
<?php require_once 'footer.php'; ?>