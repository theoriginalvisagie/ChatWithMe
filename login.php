<!DOCTYPE html>
    <head></head>
        <link rel="stylesheet" href="Libraries/Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css"/>
        <script src="Libraries/Bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
        <script src="script/js.js?v=2"></script>
        <script src="script/jquery.js?v=2"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <body>
    <?php
        include_once("Utilities/sqlClass.php");

        if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
            $sql = "SELECT * FROM users WHERE username='{$_POST['username']}' AND password='{$_POST['password']}'";
            // echo $sql;
            $result = exeSQL($sql);

            if(!$result){
                displayRegister();
            }else{
                displayLogIn();
            }
            
        }else if(isset($_POST['cancel'])){
            displayLogIn();
        }else if(isset($_POST['register'])){
            displayRegister();
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
                                <input type='text' name='username' id='username' class='form-control' placeholder='username'><br>
                                <input type='text' name='password' id='password' class='form-control' placeholder='password'><br>
                                <input type='submit' name='login' id='login' value='Log In' class='btn btn-info'>
                                <input type='submit' name='register' id='register' value='Register' class='btn btn-default'>
                            </form>
                        </div>
                    </div>";
            echo"</div></div></div>";
        }

        function displayRegister(){
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
                                $result = getTableColumns("users","id,dateCreated,access_rights");//onchange=checkAllFields()
                                // print_r($result);
                                foreach($result as $key=>$v){
                                    $placeholder = ucwords(str_replace("_"," ",$v['column']));
                                    if($v['column']=="email"){
                                        $type = "email";
                                    }else if($v['column']=="password"){
                                        $type = "password";
                                    }else{
                                        $type = "text";
                                    }
                                    echo "<input type='$type' name='{$v['column']}' id='{$v['column']}' class='form-control' placeholder='$placeholder'><br>";
                                }
                                echo "<label style='display:none; color:red;' name='confirmPasswordLabel' id='confirmPasswordLabel'>Passwords don't match</label>";
                                echo "<input type='password' name='confirmPassword' id='confirmPassword' class='form-control' placeholder='Confirm Password' onchange='confirmPasswordMatch(this.value)'><br>";

                                // echo "<pre>".print_r($result,true)."</pre>";
                           echo"<input type='button' name='registerUser' id='registerUser' value='Register' class='btn btn-success' onclick='registerNewUser()'>
                                <input type='submit' name='cancel' id='cancel' value='Cancel' class='btn btn-default'>
                            </form>
                        </div>
                    </div>";
            echo"</div></div></div>";
        }
                                // echo "<pre>".print_r($_POST,true)."</pre>";

    ?>
    </body>
</html>