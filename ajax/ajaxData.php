<?php
    include_once("../Utilities/sqlClass.php");

    if($_POST['action']=="registerNewUser"){

        $columns = "";
        $data = "";
        $userInforamtion = explode("&",$_POST['data']);

        foreach($userInforamtion as $userinfo){
            $columns .= substr($userinfo,0,strpos($userinfo,"=")).",";
            $data .= "'".substr($userinfo,strpos($userinfo,"=")+1)."',";
        }

        $columns = rtrim($columns,",");
        $data = rtrim($data,",");
        $sql = "INSERT INTO users($columns) VALUES($data)";
        
        $response = sqlINSERT($sql);
        if($response){
            echo "New User Created";
        }else{
            echo "Error";
        }
    }


?>