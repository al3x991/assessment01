<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
        <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
            <ul class="cd-switcher">
                <li><a href="#0">Sign in</a></li>
                
            </ul>

            <div id="cd-login"> <!-- log in form -->
                <form class='cd-form' action='' method='post' enctype='multipart/form-data'>

                    <p class="fieldset">
                        <label class="image-replace cd-email" for="signin-email">Username</label>
                        <input class="full-width has-padding has-border" name="u_username" type="text" placeholder="Username">
                       
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-password" for="signin-password">Password</label>
                        <input class="full-width has-padding has-border" name="u_pass" type="password" autocomplete="off"  placeholder="Password">
                        <a href="#0" class="hide-password">Show</a>
                        
                    </p>

                    <p class="fieldset">
                        <input type="checkbox" id="remember-me" checked>
                        <label for="remember-me">Remember me</label>
                    </p>

                    <p class="fieldset">
                        <input class="full-width" type="submit" name="u_login" value="Login">
                    </p>
                </form>
                
                <p class="cd-form-bottom-message pad_forgot"><a href="#0">Forgot your password?</a></p>
                <!-- <a href="#0" class="cd-close-form">Close</a> -->
            </div> <!-- cd-login -->

            
        </div> <!-- cd-user-modal-container -->
    </div> <!-- cd-user-modal -->