<?php
    // include_once();
    include_once("../Home_class.php");

    $class = new Home();
    if($_POST['action'] == "searchPublicContact"){
        $where = "WHERE is_public='1' AND  (first_name LIKE '%{$_POST['value']}%' OR last_name LIKE '%{$_POST['value']}%')";
        $class->displayPublicContacts($where);
    }else if($_POST['action'] == "addToMyCircle"){       
        $userID = $_SESSION['userID'];
        $userName = strtolower(getValues("users","first_name","id='$userID'")."_".getValues("users","last_name","id='$userID'"));
        $db = "my_circle_".$userID."_".$userName;
        $contactID = $_POST['id'];

        $checkExists = getValues($db,"contact","contact='$contactID'");

        if(!$checkExists){ 
            $return = "";         
            $sql = "INSERT INTO $db(user,contact) VALUES('$userID', '$contactID')";
            $response = sqlINSERT($sql);

            if($response){
                $return = "true";
            }else{
                $return = "false";
            }
        }else{
            $return = "contact exists";
        }

        echo $return;
        
    }else if($_POST['action'] == "refreshPublicContactsList"){
        $class->displayPublicContacts($where);
    }
?>