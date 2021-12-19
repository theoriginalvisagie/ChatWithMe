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
            // document.getElementById(elements[i].id).style.border = "3px solid red";
            // console.log("it's an empty textfield");
            emptyInputs--;
            // console.log(elements[i].name + " empty");
        }
    }
    console.log(emptyInputs);
    if(emptyInputs >= 5){
        registerButton.disabled = false;
    }
}