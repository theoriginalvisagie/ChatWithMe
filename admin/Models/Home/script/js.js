function searchPublicContact(value){
    $.ajax({
        url: "ajax/ajaxContacts.php",
        type: 'post',
        data: ({"action":"searchPublicContact","value":value}),
        dataType: "html",
        success: function (html) {
            document.getElementById("publicContactsModalContent").innerHTML = html;           
        }
    });
}

/**
 * 
 * @param {*} id:intger 
 */
function addToMyCircle(id,last_name=''){
    var contact = document.getElementById(id+"_"+last_name).value;
    
    $.ajax({
        url: "http://localhost/ChatWithMe/admin/Models/Home/ajax/ajaxContacts.php",
        type: 'post',
        data: ({"action":"addToMyCircle","id":id}),
        success: function (response) {
            console.log(response);
            if(response == "contact exists"){                
                Swal.fire({
                    icon: 'error',
                    title: 'Contact Excists',
                    text: contact + " is allready part of your circle."
                  })
            }else if(response == "true"){
                    console.log("before");
                    refreshPublicContactsList();
                    console.log("After");
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error occured',
                    text: "An error occured, please try again."
                  })
            }           
        }
    });
}

function refreshPublicContactsList(){
    $.ajax({
        url: "http://localhost/ChatWithMe/admin/Models/Home/ajax/ajaxContacts.php",
        type: 'post',
        data: ({"action":"refreshPublicContactsList"}),
        dataType: "html",
        success: function (html) {
            document.getElementById("publicContactsModalContent").innerHTML = html;          
        }
    });
}