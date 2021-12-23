<?php
    include_once("../Utilities/sqlClass.php");

    if($_POST['action']=="registerNewUser"){

        $columns = "";
        $data = "";
        $userInforamtion = explode("&",$_POST['data']);

        foreach($userInforamtion as $key=>$value){
            $newKey = substr($value,0,strpos($value,"="));
            $newValue = substr($value,strpos($value,"=")+1);
            $userInforamtion[$newKey] = $newValue;
            unset($userInforamtion[$key]);
        }

        unset($userInforamtion["confirmPassword"]);

        foreach($userInforamtion as $key=>$value){
            $columns .= $key.",";
            
            if($key=="emial"){
                $value = strtolower($value);
            }

            $data .= "'".$value."',";
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
    }else if($_POST['action']=="checkEmail"){
        $email = strtolower($_POST['email']);
        $sql = "SELECT * FROM users WHERE email='$email'";

        $response = exeSQL($sql);

        if($response){
            echo "true";
        }else{
            echo "false";
        }
    }else if($_POST['action']=="checkUsername"){
        $sql = "SELECT * FROM users WHERE username='{$_POST['username']}'";

        $response = exeSQL($sql);

        if($response){
            echo "true";
        }else{
            echo "false";
        }
    }
    // echo "<pre>".print_r($userInforamtion,true)."</pre>";

?>