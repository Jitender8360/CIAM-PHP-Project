<?php require_once 'header.php'; ?>
        <div class="section-main section-minimal">
            <center>
                <div class="container-small lr-profile-viewer" style="height: 300px;">
                    <span class="lr-image-frame">
                        <img src="../images/user-blank.png" height="150"/>
                    </span>
                    <div class="lr-heading">Hello, <span class="lr-user-name"> </span><br/>
                        <div class="lr-profile-info">           
                            <div class="lr-email-info">
                                <span class="lr-value lr-em emailid"></span>
                            </div>              
                            <div class="lr-uid-info">
                                <span class="lr-label" style="font-size: 12px;">Uid: </span>
                                <span class="lr-value useruid" style="font-size: 12px;"></span>
                            </div>
                            <div class="lr-uid-info">
                                <span class="lr-label" style="font-size: 12px;">Last Login: </span>
                                <span class="lr-value lastlogin" style="font-size: 12px;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </center>                
        </div>       
<?php require_once 'footer.php'; ?>