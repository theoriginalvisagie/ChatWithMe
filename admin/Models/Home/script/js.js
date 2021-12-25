function searchPublicContact(value){
    $.ajax({
        url: "ajax/ajaxContacts.php",
        type: 'post',
        data: ({"action":"searchPublicContact","value":value}),
        dataType: "html",
        success: function (html) {
            // console.log(response);
            document.getElementById("contactsPublic").innerHTML = html;
            
        }
    });
}