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
    }
    // echo "<pre>".print_r($userInforamtion,true)."</pre>";

?>