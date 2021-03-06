function registerNewUser(){    
    var data = $('#registerUserForm').serialize();
    data = data.replace("%40","@");

    console.log("password " + confirmPasswordMatch());
    console.log("Fields " + checkAllFields());
    console.log("Strength " + checkStrength());
    console.log("Username " + checkUsername());
    console.log("email " + checkEmail());
    if(confirmPasswordMatch()==true && checkAllFields()==true && checkStrength()==true){ //&& checkUsername()==true && checkEmail()==true){
        $.ajax({
            url: "ajax/ajaxData.php",
            type: 'post',
            data: ({'action':"registerNewUser",data:data}),
            success: function (response) {
                // Swal.fire(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Welcome',
                    text: response + ' ,click to login to your new account'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        // location.reload();
                        window.location.href = "http://localhost/ChatWithMe/login.php";
                    }
                  })
            }
        });
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please check that all information is correct!'
          })
    }
}

function checkAllFields(){
    var registerButton = document.getElementById("registerUser");
    var emptyInputs = 5;
    var elements = document.getElementById("registerUserForm").elements;

    for (var i = 0; i < elements.length; i++) {
        if (elements[i].value === ""){
            emptyInputs--;
        }
    }

    if(emptyInputs >=5){
        return true;
    }
}

function confirmPasswordMatch(){
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if(password === confirmPassword){
        document.getElementById("confirmPasswordLabel").style.display = "none";
        return true;
    }else{
        document.getElementById("confirmPasswordLabel").style.display = "block";
        return false;
    }
}

function checkUsername(){
    username = document.getElementById("username").value;
    $.ajax({
        url: "ajax/ajaxData.php",
        type: 'post',
        data: ({'action':"checkUsername",username:username}),
        success: function (response) {
            if(response == "true"){
                document.getElementById("email").style.color = "red";
                document.getElementById("checkUsernameExists").style.display = "block";
            }else{
                document.getElementById("checkUsernameExists").style.display = "none";
                document.getElementById("email").style.color = "black";
            }
        }
    });
}

function checkEmail(){
    email = document.getElementById("email").value;
    $.ajax({
        url: "ajax/ajaxData.php",
        type: 'post',
        data: ({'action':"checkEmail",email:email}),
        success: function (response) {
            if(response == "true"){
                document.getElementById("email").style.color = "red";
                document.getElementById("checkEmailExists").style.display = "block";
            }else{
                document.getElementById("checkEmailExists").style.display = "none";
                document.getElementById("email").style.color = "black";
            }
        }
    });
}

function checkStrength(){
    password = document.getElementById("password").value;
    var checkSpecial = /[*@!#%&()^~{}]+/.test(password),
        checkUpper = /[A-Z]+/.test(password),
        checkNumber = /[0-9]+/.test(password);

    if(checkSpecial){
        document.getElementById("specialChar").style.color = "green";
        document.getElementById("specialChar").className = "fas fa-check";
    }else{
        document.getElementById("specialChar").style.color = "red";
        document.getElementById("specialChar").className = "fas fa-times";
    }

    if(checkUpper){
        document.getElementById("upperCase").style.color = "green";
        document.getElementById("upperCase").className = "fas fa-check";
    }else{
        document.getElementById("upperCase").style.color = "red";
        document.getElementById("upperCase").className = "fas fa-times"; 
    }

    if(checkNumber){
        document.getElementById("numberCount").style.color = "green";
        document.getElementById("numberCount").className = "fas fa-check";
    }else{
        document.getElementById("numberCount").style.color = "red";
        document.getElementById("numberCount").className = "fas fa-times";
    }

    if(password.length>=8){
        document.getElementById("numberChar").style.color = "green";
        document.getElementById("numberChar").className = "fas fa-check";
    }else{
        document.getElementById("numberChar").style.color = "red";
        document.getElementById("numberChar").className = "fas fa-times";
    }

    if(checkSpecial && checkUpper && checkNumber && password.length>=8){
        return true;
    }else{
        document.getElementById("passwordStrength").style.display = "block";
    }
}

function checkUserExsists(){
    // alert("HI");
    var username = document.getElementById("username").value;
    $.ajax({
        url: "ajax/ajaxData.php",
        type: 'post',
        data: ({'action':"checkUser",username:username}),
        success: function (response) {
            if(response == "true"){
                // document.getElementById("changePassword").value = "Save";  
                document.getElementById("changePassword").style.display = "block";
                document.getElementById("checkPassword").style.display = "none";             
                document.getElementById("confirmPassword").style.display = "block";
                document.getElementById("password").style.display = "block";
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'User does not exist'
                  })
            }
           console.log(response)
        }
    });

    
}

function changUserPassword(){
    var username = document.getElementById("username").value;
    var data = username+"|";
    if(confirmPasswordMatch() == true && checkStrength() == true){
        newPassword = document.getElementById("password").value;
        data = data + newPassword;
        $.ajax({
            url: "ajax/ajaxData.php",
            type: 'post',
            data: ({"action":"changeUserPassword","data":data}),
            success: function (response) {
                console.log(response);
                if(response == "true"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Password changed succesfully, please log in again.'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            // location.reload();
                            window.location.href = "http://localhost/ChatWithMe/login.php";
                        }
                      })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occured, please try again.'
                      })
                }
            }
        });
    }
}

function userLoginError(){
    document.getElementById("logInError").style.display="block";
}