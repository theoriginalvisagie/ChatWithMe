function addToTags(){
    tagList = document.getElementById("dropDownTag");
    dropdownTagDiv = document.getElementById("dropDownTagDiv");
    hidden = document.getElementById("dropDownTagInput");

    var addToDivValue = tagList.options[tagList.selectedIndex].value;
    var addToDivText = tagList.options[tagList.selectedIndex].text;

    var btn = document.createElement("button");
    btn.innerHTML = addToDivText;
    btn.className = "btn btn-info btn-sm";
    btn.setAttribute("onclick","addBackToDropDownTag("+addToDivValue+")");
    btn.setAttribute("style","margin-left:2px; margin-right:2px; margin-top:2px;");
    btn.setAttribute("id","btn_"+addToDivValue);

    hidden.setAttribute("value", hidden.value + addToDivValue + ",");

    // document.body.appendChild(btn);

    dropdownTagDiv.append(btn);
    // e. options[e. selectedIndex]. text
    tagList.remove(tagList.selectedIndex);
    // alert(addToDiv
}

function addBackToDropDownTag(id){
    
    addToTagListText = document.getElementById('btn_'+id).innerHTML;
    addToTagList = document.getElementById('btn_'+id);
    tagList = document.getElementById("dropDownTag");
    dropdownTagDiv = document.getElementById("dropDownTagDiv");
    hiddenValue = document.getElementById("dropDownTagInput").value;
    hidden = document.getElementById("dropDownTagInput");

    // console.log("Before "+hiddenValue);
    idString = id.toString();
    // console.log("Before "+idString);
    if(hiddenValue.includes(idString)){
        hiddenValue = hiddenValue.replace(idString+",","");
        // hidden.setAttribute("value", hidden.value - idString);
        // console.log(hiddenValue.indexOf(idString));
    }
    
    // console.log("After" + hiddenValue);
    // console.log(typeof(hiddenValue));

    hidden.setAttribute("value",hiddenValue);

    var option = document.createElement("option");
    option.text = addToTagListText;
    option.setAttribute("value",id);

    tagList.add(option);
    // dropdownTagDiv.remove(addToTagList);
    dropdownTagDiv.removeChild(addToTagList);
}

function addCheckboxToList(value, table){

    var inputs = document.querySelectorAll(".checkBoxClass_"+table);  
    checkboxValues = "";
     
    for (var i = 0; i < inputs.length; i++) {   
        if(inputs[i].checked == true){
            checkboxValues += ","+inputs[i].value+",";
        }
          
    }  
    console.log(checkboxValues);
    document.getElementById("checkBoxList_"+table).value = checkboxValues;

}