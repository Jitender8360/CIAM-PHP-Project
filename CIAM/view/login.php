<?php require_once 'header.php'; ?>
        
        <div class="section-main section-minimal">       
            <center><span id="emailverification-message"></span>
                <div class="container">
                 
                  
                    <center><table>
                            <tr><th colspan="2" class = "text-center">Traditional Login</th></tr>
                            <tr><td>Email Address: </td><td><input name="email" type='text' id='minimal-login-email'/></td></tr>
                            <tr><td>Password: </td><td><input name="password" type='password' id='minimal-login-password'/></td></tr>
                        </table>
                  <button  class = "btn btn-primary" id="btn-minimal-login">Login</button><br/>
                    <span style="color:red" id="minimal-login-errorMsg"></span>
                                        

                    <b>Social Login</b>                            
                    <script type="text/html" id="loginradiuscustom_tmpl">
                        <a class="lr-provider-label" href="javascript:void(0)" onclick="return LRObject.util.openWindow('<#= Endpoint #>');" title="<#= Name #>" alt="Sign in with <#=Name#>">
                            <span class="lr-ls-icon lr-ls-icon-<#= Name #>"></span>
                        </a>&nbsp;&nbsp;&nbsp;
                        </script>

                        <div id="interfacecontainerdiv" class="interfacecontainerdiv"></div>
                        <div id="sociallogin-container"></div>
                  </center>
                    

                    </div>
                </center>
            </div>
 <?php require_once 'footer.php'; ?>