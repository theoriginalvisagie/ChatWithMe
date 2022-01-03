<?php
    // include_once();
    include_once("../Home_class.php");

    $class = new Home();
    if($_POST['action'] == "searchPublicContact"){
        $where = "WHERE is_public='1' AND  (first_name LIKE '%{$_POST['value']}%' OR last_name LIKE '%{$_POST['value']}%')";
        $class->displayPublicContacts($where);
    }else if($_POST['action'] == "addToMyCircle"){
        $checkExists = getValues("my_circle","contact","user = '{$_SESSION['userID']}' AND contact='{$_POST['id']}'");

        if(!$checkExists){
            $sql = "INSERT INTO my_circle(user,contact) VALUES('{$_SESSION['userID']}', '{$_POST['id']}')";

            $response = sqlINSERT($sql);

            if($response){
                echo "true";
            }else{
                echo "false";
            }
        }else{
            echo "contact exists";
        }
        
    }else if($_POST['action'] == "refreshPublicContactsList"){
        $class->displayPublicContacts($where);
    }
?>