<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="Libraries/Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css"/>
        <script src="Libraries/Bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
    <?php

echo "<div class='container' style='margin-top:10%'>   
                          
<div class='row align-items-center justify-content-center'>
    ";
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

// echo "<div class='container' style='margin-top:20%'>   
                          
// <div class='row align-items-center justify-content-center'>
//     <div class='col-3'></div>
//     <div class='col-6'>
//         <form method='post'>
//             <input type='username' name='username' id='username' class='form-control' placeholder='Username' style='margin-bottom:5px;'>
//             <input type='password' name='password' id='password' class='form-control' placeholder='Password'><br>
//             <input type='submit' name='login' id='login' value='Log In' class='btn btn-info'>
//             <input type='submit' name='register' id='register' value='Register' class='btn btn-default'>
//         </form>
//     </div>
//     <div class='col-3'></div>
// </div>   
// </div>"
    ?>
    </body>
</html>