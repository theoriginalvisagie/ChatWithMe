<?php
    // include_once();
    include_once("../Home_class.php");

    $class = new Home();
    if($_POST['action']=="searchPublicContact"){
        $where = "WHERE first_name LIKE '%{$_POST['value']}%' OR last_name LIKE '%{$_POST['value']}%'";
        // $sql = "SELECT id,first_name,last_name FROM users WHERE ";

        // $response = exeSQl($sql);

        // if($response){
            // echo dirname(__FILE__)."/Utilities/sqlClass.php";
            // echo $where;
             $class->displayPublicContacts($where);
        // }
    }
?>