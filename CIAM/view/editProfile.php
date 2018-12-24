<?php require_once 'header.php'; ?>

<div class="section-main section-minimal">
            <center>
                <div class="container lr-profile-editor">
                    <center><table>
                            <tr><td>First Name: </td><td><input name="firstname" type='text' id='user-updateaccount-firstname'/></td></tr>
                            <tr><td>Last Name: </td><td><input name="lastname" type='text' id='user-updateaccount-lastname'/></td></tr>
                            <tr><td>About: </td><td><input name="about" type='text' id='user-updateaccount-about'/></td></tr>
                        </table>
                    <button  class = "btn btn-primary" id="btn-user-updateaccount">Update</button><br/>
                    <span style="color:red" id="user-updateaccount-errorMsg"></span>
                    <span style="color:green" id="user-updateaccount-successMsg"></span>
                      </center>
                </div>
            </center>                
        </div>   
<?php require_once 'footer.php'; ?>
   