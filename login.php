<!DOCTYPE html>
    <head></head>
        <link rel="stylesheet" href="Libraries/Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css"/>
        <script src="Libraries/Bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
        <link href="Libraries/FontAwesome/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
        <script src="script/js.js?v=3"></script>
        <script src="script/jquery.js?v=3"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <body>
    <?php
        include_once("Utilities/sqlClass.php");

        if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
            checkLogIn($_POST['username'],$_POST['password']);           
        }else if(isset($_POST['cancel'])){
            displayLogIn();
        }else if(isset($_POST['register'])){
            displayRegister();
        }else if(isset($_POST['forgotPassword'])){
            displayForgotPassword();
        }else{
            displayLogIn();
        }

        function displayLogIn(){
            echo "<div class='container' style='margin-top:10%'>   
                                
            <div class='row align-items-center justify-content-center'>";
            echo "<div class='col-6'>";
                echo "<div class='card'>
                        <div class='card-header'> 
                            Login
                        </div>
                        <div class='card-body'>
                            <form method='post'>
                                <h5 class='card-title'>Please log into your account</h5>
                                <label name='logInError' id='logInError' style='color:red; display:none;'>Incorrect Log In Credentials, please try again.</label>
                                <input type='text' name='username' id='username' class='form-control' placeholder='username'><br>
                                <input type='text' name='password' id='password' class='form-control' placeholder='password'><br>
                                <input type='submit' name='login' id='login' value='Log In' class='btn btn-info'>
                                <input type='submit' name='register' id='register' value='Register' class='btn btn-default'>
                                <input type='submit' name='forgotPassword' id='forgotPassword' value='Forgot Password?' class='btn btn-default' style='float:right;'>
                            </form>
                        </div>
                    </div>";
            echo"</div></div></div>";
        }

        function displayRegister(){
            $result = getTableColumns("users","id,dateCreated,access_rights");//onchange=checkAllFields()
            $js = "";

            echo "<div class='container' style='margin-top:10%'>   
                                
            <div class='row align-items-center justify-content-center'>";
            echo "<div class='col-6'>";
                echo "<div class='card'>
                        <div class='card-header'> 
                            Register
                        </div>
                        <div class='card-body'>
                            <form method='post' id='registerUserForm' name='registerUserForm' >
                                <h5 class='card-title'>Register New Account</h5>";

                                foreach($result as $key=>$v){
                                    $placeholder = ucwords(str_replace("_"," ",$v['column']));

                                    if($v['column'] == "email"){
                                        $type = "email";
                                    }else if($v['column'] == "password"){
                                        $type = "password";
                                    }else if($v['column'] == "username"){
                                        $type = "username";}
                                    else{
                                        $type = "text";
                                    }

                                    if($type == "password"){
                                        echo "<div style='display:none;' name='passwordStrength' id='passwordStrength'>
                                                <p style='font-size:10px; margin-bottom:0;'>Password must contain at least:</p>
                                                <ul style='font-size:10px; list-style:none'>                                               
                                                    <li><i class='fas fa-times' style='color:red;' id='upperCase'></i> One Uppercase</li>
                                                    <li><i class='fas fa-times' style='color:red;' id='numberCount'></i> One Number</li>
                                                    <li><i class='fas fa-times' style='color:red;' id='specialChar'></i> One Special Character</li>
                                                    <li><i class='fas fa-times' style='color:red;' id='numberChar'></i> 8 Characters</li>
                                                </ul>
                                              </div>";
                                        $js = "onkeyup='checkStrength(this.value)'";
                                    }else if($type == "email"){
                                        $js = "onkeyup='checkEmail()'";
                                        echo "<label style='display:none; color:red;' name='checkEmailExists' id='checkEmailExists'>Email all ready in use</label>";
                                    }else if($type == "username"){
                                        $js = "onkeyup='checkUsername()'";
                                        echo "<label style='display:none; color:red;' name='checkUsernameExists' id='checkUsernameExists'>Username exsits</label>";
                                    }
                                    echo "<input type='$type' name='{$v['column']}' id='{$v['column']}' class='form-control' placeholder='$placeholder' $js><br>";
                                }
                                echo "<label style='display:none; color:red;' name='confirmPasswordLabel' id='confirmPasswordLabel'>Passwords don't match</label>";
                                echo "<input type='password' name='confirmPassword' id='confirmPassword' class='form-control' placeholder='Confirm Password' onkeyup='confirmPasswordMatch()'><br>";

                           echo"<input type='button' name='registerUser' id='registerUser' value='Register' class='btn btn-success' onclick='registerNewUser()'>
                                <input type='submit' name='cancel' id='cancel' value='Cancel' class='btn btn-default'>
                            </form>
                        </div>
                    </div>";
            echo"</div></div></div>";
        }

        function displayForgotPassword(){
            echo "<div class='container' style='margin-top:10%'>   
                                
            <div class='row align-items-center justify-content-center'>";
            echo "<div class='col-6'>";
                echo "<div class='card'>
                        <div class='card-header'> 
                            Forgot Password
                        </div>
                        <div class='card-body'>
                                <h5 class='card-title'>Change password</h5>";
            echo "<form method='post'>
                    <input type='text' name='username' id='username' class='form-control' placeholder='Username/Email'><br>
                    <div style='display:none;' name='passwordStrength' id='passwordStrength'>
                                                <p style='font-size:10px; margin-bottom:0;'>Password must contain at least:</p>
                                                <ul style='font-size:10px; list-style:none'>                                               
                                                    <li><i class='fas fa-times' style='color:red;' id='upperCase'></i> One Uppercase</li>
                                                    <li><i class='fas fa-times' style='color:red;' id='numberCount'></i> One Number</li>
                                                    <li><i class='fas fa-times' style='color:red;' id='specialChar'></i> One Special Character</li>
                                                    <li><i class='fas fa-times' style='color:red;' id='numberChar'></i> 8 Characters</li>
                                                </ul>
                                              </div>
                    <input type='text' name='password' id='password' class='form-control' style='display:none' placeholder='New Password' onkeyup='checkStrength(this.value)'><br>
                    <label style='display:none; color:red;' name='confirmPasswordLabel' id='confirmPasswordLabel'>Passwords don't match</label>
                    <input type='text' name='confirmPassword' id='confirmPassword' class='form-control' style='display:none' placeholder='Confirm Password' onkeyup='confirmPasswordMatch()'><br>
                    <input type='button' name='checkPassword' id='checkPassword' value='Continue' class='btn btn-success' onclick='checkUserExsists()'>
                    <input type='button' name='changePassword' id='changePassword' value='Save' class='btn btn-success' onclick='changUserPassword()' style='display:none'>
                  </form>";

                echo"  </div>
                    </div>";
            echo"</div></div></div>";
        }

        function checkLogIn($username,$password){
            $_SESSION = array();
            
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $response = exeSQL($sql);
            echo "<pre>".print_r($response,true)."</pre>";
            if($response){
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $response[0]['id'];
                $_SESSION['logedIn'] = "Yes";
                $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['time_logged_in'] = date('Y-m-d H:i:s');
                $_SESSION['access_rights'] = getValues("users","access_rights","username='$username' AND id='{$response[0]['id']}'");
                // $_SESSION['HTTP_FORWARD'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
                // header("Location: admin/Models/Home/index.php");
            }else if(!$response){
                displayLogIn();
                echo "<script>                     
                        eval('userLoginError()');
                      </script>";
            }
        }
        // echo "<pre>".print_r($_POST,true)."</pre>";
        // echo "<pre>".print_r($_SESSION,true)."</pre>";

    ?>
    </body>
</html>