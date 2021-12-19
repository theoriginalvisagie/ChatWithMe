function registerNewUser(){
    
    var data = $('#registerUser').serialize();
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
    alert("Check");
}