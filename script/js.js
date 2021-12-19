function registerNewUser(){
    
    var data = $('#registerUserForm').serialize();
    data = data.replace("%40","@");

    $.ajax({
        url: "ajax/ajaxData.php",
        type: 'post',
        data: ({'action':"registerNewUser",data:data}),
        success: function (response) {
            Swal.fire(response)
        }
    });
}

function checkAllFields(){
    // alert("Check");
    var registerButton = document.getElementById("registerUser");
    var emptyInputs = 5;
    var elements = document.getElementById("registerUserForm").elements;

    for (var i = 0; i < elements.length; i++) {
        if (elements[i].value === ""){
            emptyInputs--;
        }
    }

    if(emptyInputs >=5){
        registerButton.disabled = false;
    }
}

function confirmPasswordMatch(){
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if(password === confirmPassword){
        document.getElementById("confirmPasswordLabel").style.display = "none";
        // return true;
    }else{
        document.getElementById("confirmPasswordLabel").style.display = "block";
        document.getElementById("registerUser").disabled = true;
        // return false;
    }
}
