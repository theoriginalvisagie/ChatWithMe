

<?php
    require_once(dirname(__FILE__,4)."/admin/Models/Home/Home_class.php");
    // require_once("../Home/Home_class.php");
    include_once(dirname(__FILE__,4)."/Utilities/sqlClass.php");

    class UserProfile extends Home{
        function __construct(){}

        function init(){
            $loginAmount = getValues("users","login_amount","id='{$_SESSION['userID']}'");
            if(!empty($loginAmount) && $loginAmount <= 1){
               $this->setUpUserTables($_SESSION['userID']);
            }

            if(!empty($_SESSION['userID']) && !empty($_SESSION['access_rights']) && $_SESSION['logedIn']==="Yes"){
                $this->displayHome($_SESSION['userID']);
            } 
        }

        function myProfile(){
            // $this->displaySettings($_SESSION['userID']);
        }

        function displaySettings($user){
            $arr = getTableColumns("user_profile","id");
            $sql = "SELECT * FROM user_profile";
            $value = exeSQL($sql);
              echo "<pre>".print_r($_POST,true)."</pre>";
            echo "<center>";
            echo "<h2>".getValues("users","first_name","id='$user'")." ".getValues("users","last_name","id='$user'")."</h2>";
            echo "<form method='post'>";
            echo "<table>";
            foreach($arr as $a){
                echo "<tr>";
                echo "<td>".ucwords(str_replace("_"," ",$a['column'])).":</td>";
                echo "<td></td>";
                echo "<td>";
                if($a['type']=="varchar(3)"){
                    echo "<select name='{$a['column']}' id='{$a['column']}'>";
                    echo "<option></option>";
                    echo "<option value='Yes'";
                    if($value[0][$a['column']] == "Yes"){
                        echo "selected";
                    }
                    echo ">Yes</option>";
                    echo "<option value='No'";
                    if($value[0][$a['column']] == "No"){
                        echo "selected";
                    }
                    echo ">No</option>"; 
                }else{  
                    echo "<input type='text' name='{$a['column']}' id='{$a['column']}' value='{$value[0][$a['column']]}'>";
                }
                
                echo "</td>";

                echo "</tr>";

            }
            echo "</table>";
            echo "<input type='hidden' value='$user'  name='userID' id='userID'>";
            echo "<input type='hidden' value='user_profile'  name='db' id='db'>";
            echo "<input type='submit' value='Save' class='btn btn-success' name='save' id='save'>";
            echo "</form>";
            echo "</center>";

        }

        function setUpUserTables($user){
            $userName = getValues("users","first_name","id='$user'")."_".getValues("users","last_name","id='$user'");
            $user_profile = "CREATE TABLE user_profile_{$user}_{$userName} (
                                id int NOT NULL AUTO_INCREMENT,
                                is_public varchar(3),
                                PRIMARY KEY (id)
                            )";
            $my_circle = "CREATE TABLE my_circle_{$user}_{$userName} (
                            id int NOT NULL AUTO_INCREMENT,
                            user INT(11),
                            contact INT(11),
                            PRIMARY KEY (id)
                        )";

            $my_chat = "CREATE TABLE my_chat_{$user}_{$userName} (
                            id int NOT NULL AUTO_INCREMENT,
                            user INT(11),
                            contact INT(11),
                            messages text,
                            dateSent TIMESTAMP,
                            PRIMARY KEY (id)
                        )";
            // echo $user_profile;
            $success = 0;
            $response = createTable($user_profile);
            if($response){
                $success ++;
            }

            $response = createTable($my_circle);
            if($response){
                $success ++;
            }

            $response = createTable($my_chat);
            if($response){
                $success ++;
            }

            if($success == 3){
                $loginAmount = getValues("users","login_amount","id='$user'");
                $loginAmount ++;
                updateData("UPDATE users SET login_amount='$loginAmount' WHERE id='$user'");
            }

            
        }
    }
?>