function registerNewUser(){
    // alert("yeas");
    var data = $('#registerUser').serialize();

    console.log(queryString);

    $.ajax(   // request url
    {
        url: "ajax/ajaxData.php",
        type: 'post',
        data: ({'action':"registerNewUser",data:"registerNewUser"}),
        success: function (data, status, xhr) {// success callback function
            $('p').append(data);
    }
});
}

function registerNewUser2(){

}