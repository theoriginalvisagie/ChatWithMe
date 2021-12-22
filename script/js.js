function registerNewUser(){
    
    var data = $('#registerUserForm').serialize();
    data = data.replace("%40","@");

    console.log(confirmPasswordMatch());
    console.log(checkAllFields());
    if(confirmPasswordMatch()==true && checkAllFields()==true){
        $.ajax({
            url: "ajax/ajaxData.php",
            type: 'post',
            data: ({'action':"registerNewUser",data:data}),
            success: function (response) {
                Swal.fire(response);
            }
        });
    }else{
        Swal.fire("Please check that all information is correct!");
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
